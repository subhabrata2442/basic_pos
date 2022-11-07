<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StoreSalesInvoice extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'store_sales_invoice';
	protected $guarded	= [];
}
