<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable=["brand","model","color","engine","year","description","image_url","price","discount"];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPriceWithDiscount()
    {
        return $this->price-($this->price*$this->discount/100);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function auctionCars()
    {
        return $this->hasMany(AuctionCar::class);
    }
    public function auctionOrders()
    {
        return $this->hasMany(AuctionOrder::class);
    }
}
