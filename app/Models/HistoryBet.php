<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBet extends Model
{
    use HasFactory;
    protected $fillable= ["id","auction_car_id","user_id","bet","return"];
    public function auctionCars()
    {
        return $this->belongsToMany(AuctionCar::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
