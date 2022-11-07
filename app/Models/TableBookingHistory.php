<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TableBookingHistory extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'table_booking_history';
	protected $guarded	= [];
	
	public function waiter()
    {
		return $this->hasOne(Waiter::class,'id', 'waiter_id'); 
    }
	public function table()
    {
		return $this->hasOne(FloorWiseTable::class,'id', 'table_id'); 
    }

}
