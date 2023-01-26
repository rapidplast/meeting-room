<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meeting;
use App\Models\User;
use App\Models\ReservationStatus;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservation';
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'reservation_code',
        'user_id',
        'meeting_id',
    ];
    public function Meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }
    
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // protected $casts = [
    //     'reservation_time' => 'datetime',
    // ];

    // public function reservationStatus()
    // {
    //     return $this->hasOne(ReservationStatus::class, 'reservation_code');
    // }
}
