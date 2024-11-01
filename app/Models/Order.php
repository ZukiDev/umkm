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
