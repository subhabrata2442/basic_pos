<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellInwardStock extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'sell_inward_stock';
	protected $guarded	= [];

    public function supplierDetails(){
        return $this->hasOne(User::class,'id','supplier_id');
    }

    public function supplier(){
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
	
	public function top_selling_products($branch_id){
		print_r($branch_id);exit;
	}
	
	
	

}
