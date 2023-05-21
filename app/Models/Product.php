<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'minimum_bidding_price',
        'deadline',
    ];

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }
}
