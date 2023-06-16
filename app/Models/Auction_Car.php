<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction_Car extends Model
{
    use HasFactory;
    protected $fillable= ["id","car_id","auction price"];

    public function Cars()
    {
        return $this->belongsToMany(Car::class);
    }
}
