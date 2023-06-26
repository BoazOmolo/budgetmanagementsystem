<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenses_id',
        'amount',
        'fees',
        'file_id',
        'status',
        'createdby',
        'updatedby',
    ];
}
