<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Expense;

class ExpensesCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'expenses_id',
        'status',
        'createdby',
        'updatedby',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expenses_id');
    }
}
