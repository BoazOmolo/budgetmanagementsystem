<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Income;

class Source extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'source',
        'status',
        'updated_at'
    ];

    public function incomes()
    {
        return $this->hasMany(Income::class, 'source_id');
    }
}
