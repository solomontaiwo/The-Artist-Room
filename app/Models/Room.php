<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'address',
        'size',
        'available_seats'
    ];

    public static function create(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'address' => $data['address'],
            'size' => $data['size'],
            'available_seats' => $data['available_seats']
        ]);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}