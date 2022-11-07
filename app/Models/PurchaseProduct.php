<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function supplier_dtl()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function product_dtl()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
