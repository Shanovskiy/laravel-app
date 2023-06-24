<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionCar extends Model
{
    use HasFactory;
    protected $fillable= ["id","car_id","auction_price","minimum_step","user_id"];

    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function historyBets()
    {
        return $this->hasMany(HistoryBet::class);
    }
}
