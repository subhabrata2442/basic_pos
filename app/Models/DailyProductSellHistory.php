<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DailyProductSellHistory extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'daily_product_sell_history';
	protected $guarded	= [];

}
