<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\CategoryService;
use App\Models\Reservation;

class Plant extends Model
{
    use HasFactory;
    protected $table = 'tb_plant';
    protected $primaryKey = 'id_plant';

    protected $guarded = ['id_plant'];

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'id_plant', 'id_plant');
    }
}
