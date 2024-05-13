<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        '_name',
        '_mobile',
        '_email',
        '_district',
        '_location',
        '_eventdate',
        '_totalbill',
        '_transactionid',
        '_paymentstatus'
    ];
}
