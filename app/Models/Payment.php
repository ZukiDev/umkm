<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',         
        'payment_method',  
        'total_price',     
        'total_payment',    
        'status',           
        'payment_date',    
    ];

    /**
     * Relasi ke model Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Mengubah status pembayaran menjadi label yang lebih mudah dipahami.
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => 'Pending',
            1 => 'Success',
            2 => 'Failed',
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    /**
     * Mengatur format tanggal pembayaran
     */
    public function getFormattedPaymentDateAttribute()
    {
        return $this->payment_date ? $this->payment_date->format('d M Y H:i') : 'Not Paid';
    }
}
