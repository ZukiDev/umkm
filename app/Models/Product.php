<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'description',
        'sku',
        'price',
        'stock',
        'weight',
        'dimensions',
        'brand',
        'status',
        'images',
    ];

    /**
     * Relasi ke model Store
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Mutator untuk mengatur SKU menjadi uppercase sebelum disimpan.
     */
    public function setSkuAttribute($value)
    {
        $this->attributes['sku'] = strtoupper($value);
    }

    /**
     * Relasi ke model Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
