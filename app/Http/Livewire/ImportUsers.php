<?php

namespace App\Http\Livewire;

use App\Csv;
use Validator;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;

class ImportUsers extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $upload;
    public $columns;
    public $fieldColumnMap = [
        'name' => '',
        'guard_name' => '',
    ];

    protected $rules = [
        'fieldColumnMap.name' => 'required',
        'fieldColumnMap.email' => 'required',
        'fieldColumnMap.password' => 'required',
    ];

    protected $customAttributes = [
        'fieldColumnMap.name' => 'name',
        'fieldColumnMap.email' => 'guard_name',
        'fieldColumnMap.password' => 'guard_name',
    ];

    public function updatingUpload($value)
    {
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required|mimes:txt,csv'],
        )->validate();
    }

    public function updatedUpload()
    {
        $this->columns = Csv::from($this->upload)->columns();

        $this->guessWhichColumnsMapToWhichFields();
    }

    public function import()
    {
        $this->validate();

        $importCount = 0;

        Csv::from($this->upload)
            ->eachRow(function ($row) use (&$importCount) {
                Transaction::create(
                    $this->extractFieldsFromRow($row)
                );

                $importCount++;
            });

        $this->reset();

        $this->emit('refreshRoles');

        $this->notify('Imported '.$importCount.' roles!');
    }

    public function extractFieldsFromRow($row)
    {
        $attributes = collect($this->fieldColumnMap)
            ->filter()
            ->mapWithKeys(function($heading, $field) use ($row) {
                return [$field => $row[$heading]];
            })
            ->toArray();

        return $attributes;
    }

    public function guessWhichColumnsMapToWhichFields()
    {
        $guesses = [
            'name' => ['name', 'label'],
            'email' => ['email', 'label'],
            'password' => ['password', 'label'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn($options) => in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }
}
