<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CounterWiseStock extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'branch_product_counter_wise_stock';
	protected $guarded	= [];

}
