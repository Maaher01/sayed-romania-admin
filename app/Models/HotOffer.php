<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        '_title',
        '_subtitle',
        '_image',
        '_date',
        '_status'
    ];
}
