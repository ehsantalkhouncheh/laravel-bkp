<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;


class Layout extends Model
{
    use HasFactory,SoftDeletes,VersionableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    protected $keepOldVersions = 3;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

}
