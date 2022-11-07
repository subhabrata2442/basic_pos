<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BarInwardStock extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'bar_inward_stock';
	protected $guarded	= [];
	
	

}
