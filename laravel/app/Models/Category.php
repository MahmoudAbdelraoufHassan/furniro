<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'description' , 'thumbnail' , 'status'];
    public function products()
    {
        return $this->hasMany(Product::class , 'category_id');
    }

//    public function toArray()
//    {
//        return [
//            'id' => $this->id,
//            'name'=>$this->name,
//            'main_name'=>$this->main_name,
//            'description'=>$this->description,
//            'status'=>$this->status,
//
//        ];
//    }

protected $hidden = ['updated_at' , 'created_at'];



}



