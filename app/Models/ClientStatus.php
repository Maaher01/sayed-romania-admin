<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        '_clientcode',
        '_date',
        '_status'
    ];
}
