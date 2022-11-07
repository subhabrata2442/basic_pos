<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DailyStockTransferHistory extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'daily_stock_transfer_sell_history';
	protected $guarded	= [];
	
	public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
	
    public function subCategory(){
        return $this->hasOne(Subcategory::class,'id','subcategory_id');
    }
	
	public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
	
    public function size(){
        return $this->hasOne(Size::class,'id','size_id');
    }

}
