<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category_id',
        'product_id',
        'name',
        'description'
    ];

    // Relasi ke produk (pastikan model Product sudah ada)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
