<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InwardStockProducts extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'inward_stock_products';
	protected $guarded	= [];

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function size(){
        return $this->hasOne(Size::class,'id','size_id');
    }
	public function invoice(){
        return $this->hasOne(PurchaseInwardStock::class,'id','inward_stock_id');
    }
}
