<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DailyProductPurchaseHistory extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'daily_product_purchase_history';
	protected $guarded	= [];

}
