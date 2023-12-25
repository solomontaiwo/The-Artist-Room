<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'date',
        'time',
        'people'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
