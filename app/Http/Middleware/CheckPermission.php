<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\RoleWisePermission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
		
        //dd($roles);
        if (!Auth::check())
            return redirect()->route('auth.login');
			
        $user = Auth::user();
		
		$is_branch	= Session::get('is_branch');
		$branch_id	= Session::get('branch_id');
		
		if($is_branch=='N'){
			$user_id	= $user->id;
			$role_id	= $user->role;
			
			$current_page_permision_id=isset($roles[0])?$roles[0]:'0';
			
			//echo '<pre>';print_r($current_page_permision_id);exit;
			
			$role_wise_permission_result = RoleWisePermission::where('role_id',$role_id)->where('branch_id',$branch_id)->where('permission_id',$current_page_permision_id)->get();
			if(count($role_wise_permission_result)>0){
				return $next($request);
			}else{
				return redirect()->route('auth.permission_denied');
			}
		}else{
			return $next($request);
		} 
    }
}
