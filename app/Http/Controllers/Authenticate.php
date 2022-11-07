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


class Authenticate extends Controller
{

    public function login(Request $request)
    {
        try {
           
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $email = $request->email;
                $password = $request->password;
				
                $remember = false;
                if ($request->remember_me) {
                    $remember = true;
                }
				
				$authenticated = Auth::attempt([
						 'email' 	=> $email,
						 'password' => $password,
						 'status' 	=> 1,
						 'role' 	=> function ($query) {
							 $query->where('role', '!=', 1);
							}
						],$remember);
						
               /* if (Auth::attempt(['email' => $email, 'password' => $password, 'role !=' => 1, 'status' => 1], $remember)) {
                    return redirect('admin/dashboard');
                } else {
                    return redirect()->back()->with('error', 'Wrong credentials');
                }*/
				
				if ($authenticated) {
					$user = User::where([['email', '=', $email],['status', '=', '1']])->first();
					$userId 	= $user->id;
					$userType 	= $user->role;
					$userEmail 	= $user->email;
					$userName 	= $user->name;
					$branch_id 	= $user->id;
					$is_branch 	= 'Y';
					
					if($userType != 3){
						$branch_id	= $user->parent_id;
						$is_branch 	= 'N';
					}
					
					
					Session::put('branch_id', $branch_id);
					Session::put('is_branch', $is_branch);
					Session::put('adminId', $userId);
					Session::put('admin_type', $userType);
					Session::put('admin_email', $userEmail);
					Session::put('admin_userName', $userName);
					
                    return redirect('admin/dashboard');
                } else {
                    return redirect()->back()->with('error', 'Wrong credentials');
                }
            }
			
			
            return view('auth.authenticate.login');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ');
        }
    }

    public function register(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'ph_no' => 'required|unique:users,phone',
                    'password' => 'required|confirmed',
                ], [
                    'confirmed' => 'The password confirmation not matched.'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $otp = $this->sendMailOtp($request->email);
                // Session::put('email_otp', $otp);
                $arr = $request->all();
                $arr['otp'] = encrypt($otp);
                // dd(encrypt($arr));
                return redirect()->route('auth.email_verification', ['data' => encrypt($arr)]);
                // dd('done');
            }

            // dd($this->generateOtp(6, 4));
            return view('authenticate.register');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
    public function email_verification(Request $request, $data)
    {
        // dd(decrypt($data));

        $data = decrypt($data);
        return view('authenticate.verifyEmail', compact('data'));
    }
    public function verifyAndRegister(Request $request)
    {
        // dd($request->all());
        try {
            if ($request->user_otp != decrypt($request->otp)) {
                return response(['success' => 0, 'error' => 'Otp mismatched !']);
            } else {
                User::create([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'phone' => $request->ph_no,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'password' => Hash::make($request->password),
                    'role' => 7,
                    'status' => 1,
                ]);
                return response(['success' => 1, 'msg' => 'You have resigtered successfully !']);
            }
        } catch (\Exception $e) {
            return response(['success' => 0, 'error' => 'Something went wrong. Please try later ' . $e->getMessage()]);
        }
    }
    public function email_resend_otp(Request $request)
    {

        $otp = $this->sendMailOtp($request->email);
        $arr['otp'] = encrypt($otp);
        return response(['success' => 1, 'data' => $arr]);
    }
    public function generateOtp()
    {
        do {
            $num = sprintf('%06d', mt_rand(100000, 999999));
        } while (preg_match("~^(\d)\\1\\1\\1|(\d)\\2\\2\\2$|0000~", $num));
        return $num;
    }
    public function sendMailOtp($email)
    {
        $otp = $this->generateOtp();
        Mail::to($email)->send(new EmailVerification($otp));
        return $otp;
    }
	
	
	public function permission_denied(){
		return view('auth.authenticate.permission_denied');
	}
	
	
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('auth.login');
    }

    public function forget_password()
    {
        return view('authenticate.forget_pass');
    }
}
