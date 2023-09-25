<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_datetime', 'user_id', 'startAt', 'endAt', 'training_hall_id', 'workspace_id', 'status'
    ];

    protected $casts = [
        'booking_datetime' => 'datetime'
    ];

    protected static function booted()
    {
        static::creating(function (Booking $booking) {
            $booking->status = 'pending';
        });

    }

    public function scopeStatus(Builder $builder)
    {
        $builder->when(request()->has('status'), fn($q) => $q->whereStatus('pending'));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trainingHall()
    {
        return $this->belongsTo(TrainingHall::class, 'training_hall_id')->withDefault();
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class, 'workspace_id')->withDefault();
    }
}
