<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_date',
        'type',
        'category_id',
        'amount',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
