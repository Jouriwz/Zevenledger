<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'due_date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
