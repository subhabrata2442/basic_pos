<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoleWisePermission extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'role_wise_permission';
	protected $guarded	= [];

}
