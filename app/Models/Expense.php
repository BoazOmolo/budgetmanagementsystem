<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'expenses_id',
        'amount',
        'fees',
        'file_id',
        'status',
        'createdby',
        'updatedby',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];
}
