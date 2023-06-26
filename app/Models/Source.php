<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Income;

class Source extends Model
{
    use HasFactory;
    protected $fillable = [
        'source',
    ];

    public function incomes()
    {
        return $this->hasMany(Income::class, 'source_id');
    }
}
