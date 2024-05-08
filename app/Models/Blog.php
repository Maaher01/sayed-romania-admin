<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        '_title',
        '_subtitle',
        '_description',
        '_slug',
        '_tags',
        '_image',
        '_date',
        '_status'
    ];
}
