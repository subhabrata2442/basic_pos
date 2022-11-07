<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\SubscriptionPlan;
use App\Models\PlanUserSubscriptions;

class CheckSubscription
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
			
       
		$branch_id	= Session::get('branch_id');
		
		$planUserSubscriptionResult=PlanUserSubscriptions::where('branch_id',$branch_id)->first();
		$is_active	= isset($planUserSubscriptionResult->is_active)?$planUserSubscriptionResult->is_active:'N';
		$ends_at	= isset($planUserSubscriptionResult->ends_at)? date('Y-m-d H:i a',strtotime($planUserSubscriptionResult->ends_at)):'';
		
		//dd($planUserSubscriptionResult);
		
		if($is_active=='N'){
			return redirect()->route('auth.subscription_expired');
		}else{
			return $next($request);
		} 
    }
}
