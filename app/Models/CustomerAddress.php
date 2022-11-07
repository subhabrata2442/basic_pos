<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CustomerAddress extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'customer_address';
	protected $guarded	= [];

}
