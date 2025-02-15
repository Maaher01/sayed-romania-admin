<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
     protected $fillable = [
        '_title',
        '_metatitle',
        '_url',
        '_parentmenuid',
        '_sort',
        '_metadescription',
        '_status',
    ];
}
