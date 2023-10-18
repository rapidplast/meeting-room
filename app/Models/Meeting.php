<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\CategoryService;
use App\Models\Reservation;

class Meeting extends Model
{
    use HasFactory;
    protected $table = 'meeting';
    protected $primaryKey = 'meeting_id';

    protected $guarded = ['meeting_id'];

    public function categoryService()
    {
        return $this->belongsTo(CategoryService::class, 'category_service_id');
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'service_id');
    }
}
