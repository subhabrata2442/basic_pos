<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PurchaseInwardStock extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'purchase_inward_stock';
	protected $guarded	= [];

    public function supplier(){
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function warehouse(){
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }

    public function inwardStockProducts(){
        return $this->hasMany(InwardStockProducts::class,'inward_stock_id','id');
    }

}
