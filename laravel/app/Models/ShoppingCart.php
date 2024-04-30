<?php

namespace App\Models;

use http\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','product_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    protected $hidden = ['updated_at' , 'created_at'];

}

