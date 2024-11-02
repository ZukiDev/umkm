<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'store_name',
        'description',
        'owner_name',
        'address_id',
        'email',
        'phone_number',
        'business_type',
        'status',
        'logo',
        'created_by',
    ];

    /**
     * Relasi ke model User (pemilik toko)
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
     * Relasi ke model User (Super Admin yang membuat toko)
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }
}
