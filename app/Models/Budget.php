<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenses_id', 
        'file', 
        'amount'
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expenses_id');
    }
}
