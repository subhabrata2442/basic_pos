<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StockTransferHistory extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'stock_transfer_history';
	protected $guarded	= [];
	
	public function size(){
		return $this->hasOne(Size::class,'id', 'size_id');
	}
	
	public function product(){
		return $this->hasOne(Product::class,'id','product_id');
	}
	
	public function category(){
		return $this->hasOne(Category::class,'id', 'category_id'); 
    }
	
	public function subcategory(){
		return $this->hasOne(Subcategory::class,'id', 'subcategory_id'); 
    }
	
	public function price(){
		return $this->hasOne(BranchStockProductSellPrice::class,'id', 'price_id'); 
    }
	public function stock_info(){
		return $this->hasOne(BranchStockProducts::class,'id', 'stock_id'); 
    }

}
