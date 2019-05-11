<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function attributeGroups()
    {
        return $this->belongsToMany(AttributeGroup::class,'attributegroup_category','category_id','attributeGroup_id');
    }
}
