<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRemoveTransition extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'product_id', 'total_quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
