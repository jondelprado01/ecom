<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryPivot extends Model
{
    use HasFactory;

    public function product()
    {
      return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
    }
}
