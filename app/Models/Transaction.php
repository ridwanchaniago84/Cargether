<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'member_id',
        'vehicle_id',
        'rent_date',
        'return_date',
        'period',
        'price',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
