<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable= ["id","user_id","car_id","created_at"];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
