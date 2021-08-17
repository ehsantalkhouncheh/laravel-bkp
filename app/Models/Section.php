<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpociot\Versionable\VersionableTrait;


class Section extends Model
{
    use HasFactory,SoftDeletes,VersionableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'layout_id'
    ];

    protected $keepOldVersions = 3;

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

}
