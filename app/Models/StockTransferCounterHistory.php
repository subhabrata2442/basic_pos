<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StockTransferCounterHistory extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'stock_transfer_counter_history';
	protected $guarded	= [];

}
