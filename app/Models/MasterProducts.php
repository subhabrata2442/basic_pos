<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProducts extends Model
{
	use HasFactory;
	
	protected $table = 'master_products';
	protected $guarded	= [];
	
	
	public function category()
    {
		return $this->hasOne(Category::class,'id', 'category_id'); 
    }
	
	public function size()
    {
		return $this->hasOne(Size::class,'id', 'size_id'); 
    }
	
	public function brand()
    {
		return $this->hasOne(Brand::class,'id', 'brand_id'); 
    }
	
	public function subcategory()
    {
		return $this->hasOne(Subcategory::class,'id', 'subcategory_id'); 
    }
	public function product()
    {
		return $this->hasOne(Product::class,'slug', 'slug'); 
    }
}
