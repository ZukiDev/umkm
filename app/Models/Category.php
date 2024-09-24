<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',    // Nama kategori
        'slug',     // Slug kategori (unique)
        'icon',     // Ikon kategori
    ];

    /**
     * Mutator untuk memastikan slug selalu diubah menjadi huruf kecil.
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }
}
