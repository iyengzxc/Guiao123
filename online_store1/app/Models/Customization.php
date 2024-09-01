<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'customization_option', 'customization_value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
