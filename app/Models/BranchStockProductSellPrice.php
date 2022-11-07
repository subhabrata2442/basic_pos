<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchStockProductSellPrice extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'branch_stock_product_sell_price';
	protected $guarded	= [];

}
