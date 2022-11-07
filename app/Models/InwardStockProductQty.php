<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InwardStockProductQty extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'inward_stock_product_qty';
	protected $guarded	= [];

}
