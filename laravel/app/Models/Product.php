<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title' , 'stock' , 'price' , 'thumbnail' , 'images'];

//    public function toArray()
//    {
//        return [
//            'id' => $this->id,
//            'name'=>$this->name,
//            'main-image'=>$this->main_image,
//            'price'=>$this->price,
//            'quantity'=>$this->quantity,
//            'image'=>$this->images,
//            'category' => $this->category,
//
//        ];
//    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    protected $hidden = ['updated_at' , 'created_at' , 'images' , 'category_id' , 'supplier_id' , 'order_id'];

}
