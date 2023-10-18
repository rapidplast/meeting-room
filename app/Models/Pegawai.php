<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'phone',        
    ];
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'customer_id');
    }
}
