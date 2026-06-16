<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['shop_id', 'name', 'collection', 'category', 'image_url', 'description', 'price', 'stock'];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
