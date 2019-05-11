<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attributesvalue';

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class,'attributeGroup_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'attributeValue_product','attributeValue_id','product_id');
    }
}
