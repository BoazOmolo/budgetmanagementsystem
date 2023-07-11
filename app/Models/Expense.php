<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'parent_id',
        'expensescategory_id',
        'description',
        'amount',
        'fees',
        'file',
        'status',
        'createdby',
        'updatedby',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];
    public function parent()
    {
        return $this->belongsTo(Expense::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Expense::class, 'parent_id');

    }

    public function expensescategory()
    {
        return $this->belongsTo(ExpensesCategory::class, 'expensescategory_id');
    }
}