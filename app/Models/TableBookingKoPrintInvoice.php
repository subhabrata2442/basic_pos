<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TableBookingKoPrintInvoice extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'table_booking_ko_print_invoice';
	protected $guarded	= [];

}
