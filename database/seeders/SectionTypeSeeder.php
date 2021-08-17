<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionType;

class SectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SectionType::create(['name'=>'Text']);
        SectionType::create(['name'=>'TextArea']);
        SectionType::create(['name'=>'ImageUploader']);
        SectionType::create(['name'=>'TextEditor']);
        SectionType::create(['name'=>'Form']);
    }
}
