<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;

class ExpensesCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'expenses_id',
        'status',
        'createdby',
        'updatedby',
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expenses_id');
    }
}
