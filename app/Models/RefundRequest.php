<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    use HasFactory;
    protected $fillable= ["id","order_id","created_at"];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
