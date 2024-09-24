<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code_order',  
        'product_id',  
        'quantity',    
        'price',       
        'total',       
    ];

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

        static::saving(function ($orderDetail) {
            $orderDetail->total = $orderDetail->quantity * $orderDetail->price;
        });
    }

    /**
     * Relasi ke model Order berdasarkan code_order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'code_order', 'code_order');
    }
}
