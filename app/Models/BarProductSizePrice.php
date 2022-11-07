<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BarProductSizePrice extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'bar_product_size_price';
	protected $guarded	= [];
	
	public function size()
    {
		return $this->hasOne(Size::class,'id', 'size_id'); 
    }
  
  public function product(){
    return $this->hasOne(Product::class,'id','product_id');
  }  

  public function barProductSizePrice(){
    return $this->hasMany(barProductSizePrice::class,'product_id','product_id');
  }

}
