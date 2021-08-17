<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;


class Page extends Model
{
    use HasFactory,SoftDeletes,VersionableTrait;

    protected $keepOldVersions = 3;

    protected $guarded = [
        'id'
    ];

    public function layout(){
        return $this->belongsTo(Layout::class);
    }
}
