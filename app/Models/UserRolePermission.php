<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserRolePermission extends Model
{
    use HasFactory;
    //use SoftDeletes;
	
	protected $table = 'user_role_permission';
	protected $guarded	= [];

}
