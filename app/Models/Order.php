<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code_order',
        'user_id',
        'address_id',
        'status',
        'total',
    ];

    // Override the setCreatedAt and setUpdatedAt methods to use Carbon
    public function setCreatedAt($value)
    {
        $this->attributes['created_at'] = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['updated_at'] = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');;
    }

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Address
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relasi ke model OrderDetail
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'code_order', 'code_order');
    }

    /**
     * Relasi ke model Payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Mengubah status order menjadi string yang lebih mudah dipahami.
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => 'Pending',
            1 => 'Processed',
            2 => 'Shipped',
            3 => 'Delivered',
            4 => 'Cancelled',
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }
}
