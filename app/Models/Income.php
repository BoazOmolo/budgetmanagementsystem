<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Source;

class Income extends Model
{
    use HasFactory;
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

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }
}
