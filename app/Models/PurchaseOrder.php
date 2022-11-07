<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function supplier_dtl()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function purchase_product()
    {
        return $this->hasMany(PurchaseProduct::class, 'purchase_order_id');
    }
}
