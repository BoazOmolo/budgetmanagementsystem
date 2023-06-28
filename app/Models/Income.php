<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Source;

class Income extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'amount',
        'period',
        'source_id',
        'start_date',
        'end_date',
        'status',
        'createdby',
        'updatedby',
        'file',
    ];

    protected $dates = ['deleted_at'];

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
