<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compensation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_transaction',
        'id_compen_category',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function compen_category()
    {
        return $this->belongsTo(CompenCategory::class);
    }
}
