<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'color_id',
        'supplier_id',
        'buying_price',
        'slug',
        'name',
        'image',
        'sale_price',
        'discount_price',
        'total_quantity',
        'like_count',
        'view_count',
        'description'
    ];
    protected $appends = ['image_url'];

    public function category()
    {
        return $this->belongsToMany(Category::class,);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    public function transition()
    {
        return $this->hasMany(ProductAddTransition::class);
    }

    public function cart()
    {
        return $this->hasMany(ProductCart::class);
    }

    public function order()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }

    public function like()
    {
        return $this->hasMany(ProductLike::class);
    }
}
