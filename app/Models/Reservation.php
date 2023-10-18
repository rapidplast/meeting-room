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

    protected $guarded = ["reservation_id"];
    
    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }
    
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getActiveReservations()
    {   
        // return null;
        return self::where('status', 1)->get();
    }

    protected $casts = [
        'reservation_time' => 'datetime',
    ];

    public function reservationStatus()
    {
        return $this->hasOne(ReservationStatus::class, 'reservation_code');
    }

    public function plant()
    {
        return $this->hasOne(Plant::class, 'id_plant', 'id_plant');
    }
}
