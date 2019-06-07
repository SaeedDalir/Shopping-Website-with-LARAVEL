<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class,'attributeValue_product','product_id','attributeValue_id');
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
