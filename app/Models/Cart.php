<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',    
        'product_id', 
        'quantity',   
        'price',     
        'total',      
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Set the total price automatically when quantity or price changes.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($cart) {
            $cart->total = $cart->quantity * $cart->price;
        });
    }
}
