<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OpeningStockProducts extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'opening_stock_products';
	protected $guarded	= [];
	
	public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function size(){
        return $this->hasOne(Size::class,'id','size_id');
    }

}
