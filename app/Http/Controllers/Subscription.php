<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;

use App\Models\SubscriptionPlan;
use App\Models\PlanUserSubscriptions;

class Subscription extends Controller
{
	public function subscription_expired(){
		if (!Auth::check()){
			return redirect()->route('auth.login');
		}
			
		try {
			$branch_id=Session::get('branch_id');
		
			$planUserSubscriptionResult=PlanUserSubscriptions::where('branch_id',$branch_id)->first();
			$is_active	= isset($planUserSubscriptionResult->is_active)?$planUserSubscriptionResult->is_active:'N';
			$ends_at	= isset($planUserSubscriptionResult->ends_at)? date('Y-m-d H:i a',strtotime($planUserSubscriptionResult->ends_at)):'';
			
			//print_r($branch_id);exit;
			
			$data['heading'] 		= 'Subscription expired';
			$data['breadcrumb'] 	= ['Subscription'];
			$data['ends_at'] 		= $ends_at;
			
			//print_r($data);exit;
			
			if($is_active=='N'){
				return view('admin.subscription_expired', compact('data'));
			}else{
				return redirect()->route('admin.dashboard');
			}
		} catch (\Exception $e) {
			return redirect()->route('auth.login')->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
			//return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
	}
}
