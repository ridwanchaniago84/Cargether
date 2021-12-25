<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'plate_no',
        'brand',
        'brand_type',
        'price_id',
        'is_active',
    ];

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
