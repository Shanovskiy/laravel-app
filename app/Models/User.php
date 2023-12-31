<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone_number',
        'recovery_pin',
        'balance',
        'image',
        'role_id',
        'discount'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->belongsToMany(Order::class,'orders');
    }
    public function refundRequest()
    {
        return $this->belongsTo(RefundRequest::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function favorites()
    {
        return $this->hasMany(User::class);
    }
    public function auctionCars()
    {
        return $this->hasMany(AuctionCar::class);
    }
    public function historyBets()
    {
        return $this->hasMany(HistoryBet::class);
    }
    public function auctionOrders()
    {
        return $this->belongsToMany(AuctionOrder::class,'auction_orders');
    }
}
