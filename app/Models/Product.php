<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;
	
	protected $table = 'products';
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
	
	public function color()
    {
		return $this->hasOne(Color::class,'id', 'color_id'); 
    }
	public function material()
    {
		return $this->hasOne(Material::class,'id', 'material_id'); 
    }
	public function vendor_code()
    {
		return $this->hasOne(VendorCode::class,'id', 'vendor_code_id'); 
    }
	public function abcdefg()
    {
		return $this->hasOne(Abcdefg::class,'id', 'abcdefg_id'); 
    }
	public function service()
    {
		return $this->hasOne(Service::class,'id', 'service_id'); 
    }
	
	
}
