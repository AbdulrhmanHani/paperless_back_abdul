<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id",
        "paper_image",
        "envelope_image",
        "backdrop_image",
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

}
