<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['user_id', 'name', 'mobile', 'email', 'amount', 'transaction_id', 'payment_method', 'status', 'pan_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
