<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_datetime', 'user_id', 'startAt', 'endAt', 'training_hall_id'
    ];

    protected static function booted()
    {
        static::creating(function (Booking $booking) {
            $booking->status = 'pending';
        });
    }

    public function trainingHall()
    {
        return $this->belongsTo(TrainingHall::class)->withDefault();
    }
}
