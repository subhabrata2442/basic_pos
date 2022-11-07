<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Helper\Media;
use App\Models\Common;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RoleWisePermission;

use Illuminate\Support\Facades\Session;
use Hash;

class UserController extends Controller
{
    public function list(Request $request)
    {
		//echo route('admin.users.list');exit;
		//echo route('admin.user.list');exit;
		//http://127.0.0.1:8000/admin/users/manage-role/NQ=="
        try {

            if ($request->ajax()) {
                $users = User::with('get_role')->where('parent_id', Auth::user()->id)->orderBy('id', 'desc')->get();
                return DataTables::of($users) 
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('email', function ($row) {
                        return $row->email;
                    })
                    ->addColumn('ph_no', function ($row) {
                        return $row->phone;
                    })
                    ->addColumn('role', function ($row) {
                        return $row->get_role->name;
                    })
                    ->addColumn('status', function ($row) {
                        $status = '';
                        if ($row->status == 0) {
                            $status = '<span class="badge badge-danger">Inactive</span>';
                        }
                        if ($row->status == 1) {
                            $status = '<span class="badge badge-success">Active</span>';
                        }
                        return $status;
                    })
                    ->addColumn('action', function ($row) {
                        $dropdown = '<a class="dropdown-item" href="' . route('admin.user.edit', [base64_encode($row->id)]) . '">Edit</a>
                        <a class="dropdown-item" href="#" id="delete_user" data-url="' . route('admin.user.delete', [base64_encode($row->id)]) . '">Delete</a>
                        <a class="dropdown-item" href="' . route('admin.user.manageUserRole', [base64_encode($row->id)]) . '">Manage Role</a>';
                        if ($row->status == 1) {
                            $dropdown .= '<a class="dropdown-item" id="change_status" href="#" data-status="0"  data-url="' . route('admin.user.changeStatus', [base64_encode($row->id), 0]) . '">Block</a>';
                        } else {
                            $dropdown .= '<a class="dropdown-item" id="change_status" href="#" data-status="1" data-url="' . route('admin.user.changeStatus', [base64_encode($row->id), 1]) . '">Unblock</a>';
                        }
                        $btn = '<div class="dropdown">
                                    <div class="actionList " id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>

                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        ' . $dropdown . '
                                    </div>
                                </div>
                                ';

                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }

            $data = [];
            $data['heading'] = 'Users List';
            $data['breadcrumb'] = ['Users', 'List'];
            return view('admin.users.list', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
    public function profile()
    {
        $data = [];
        $data['heading'] = 'Settings';
        $data['breadcrumb'] = ['Settings'];
		
		$branch_id		= Session::get('branch_id');
        //$supplier_id	= Session::get('adminId');
		
		
		$supplier		= User::find($branch_id);
		$admin_email	= $supplier->email;
		$admin_name		= $supplier->name;
		
		
		$data['company_name'] 		= Common::get_user_settings($where=['option_name'=>'company_name'],$branch_id);
		$data['company_address'] 	= Common::get_user_settings($where=['option_name'=>'company_address'],$branch_id);
		$data['company_address2'] 	= Common::get_user_settings($where=['option_name'=>'company_address2'],$branch_id);
		$data['company_address3'] 	= Common::get_user_settings($where=['option_name'=>'company_address3'],$branch_id);
		$data['customer_city'] 		= Common::get_user_settings($where=['option_name'=>'customer_city'],$branch_id);
		$data['customer_pincode'] 	= Common::get_user_settings($where=['option_name'=>'customer_pincode'],$branch_id);
		
		$data['phone'] 				= Common::get_user_settings($where=['option_name'=>'phone'],$branch_id);
		$data['company_licensee'] 	= Common::get_user_settings($where=['option_name'=>'company_licensee'],$branch_id);
		$data['company_gstin'] 		= Common::get_user_settings($where=['option_name'=>'company_gstin'],$branch_id);
		
		
		
		$data['admin_email'] 		= $admin_email;
		$data['admin_name'] 		= $admin_name;
		
		 
		//echo '<pre>';print_r($data);exit;
		
		
		
        return view('admin.profile.edit', compact('data'));
    }
    public function profile_edit(Request $request)
    {
		
        try {
            if ($request->isMethod('post')) {
				
                // dd($request->all());
                $user_id = Auth::user()->id;
                $validator = Validator::make($request->all(), [
                    //'user_avatar' => 'nullable|mimes:jpeg,jpg,png',
                    'email' 	=> 'required|email|unique:users,email,' . $user_id,
                    'phone' 	=> 'required|numeric|unique:users,phone,' . $user_id,
                    'full_name' => 'required',
					
                ]);
				if($request->password!=''){
					 $validator = Validator::make($request->all(), [
					 'password' => 'min:6|required_with:password_confirm|same:password_confirm',
					]);
				}
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
								
                $array = [
                    'name' 	=> $request->full_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ];
				
				if($request->password!=''){
					$array['password']=Hash::make($request->password_confirm);
				}
				
				//echo '<pre>';print_r($_POST);exit;
				
				
				User::find($user_id)->update($array);
				
				$company_id		= Session::get('branch_id');
				
				//Common::updateData($table="users", "id", $user_id, $data_general);
				Common::updateSiteSettingData($table="site_settings", $company_id, "company_name", array('option_value'=>$request->company_name));
				Common::updateSiteSettingData($table="site_settings", $company_id, "company_address", array('option_value'=>$request->company_address));
				Common::updateSiteSettingData($table="site_settings", $company_id, "company_address2", array('option_value'=>$request->company_address2));
				Common::updateSiteSettingData($table="site_settings", $company_id, "company_address3", array('option_value'=>$request->company_address3));
				//Common::updateSiteSettingData($table="site_settings", $company_id, "company_licensee", array('option_value'=>$request->company_licensee));
				Common::updateSiteSettingData($table="site_settings", $company_id, "company_gstin", array('option_value'=>$request->company_gstin));
				Common::updateSiteSettingData($table="site_settings", $company_id, "customer_city", array('option_value'=>$request->customer_city));
				Common::updateSiteSettingData($table="site_settings", $company_id, "customer_city", array('option_value'=>$request->customer_city));
				Common::updateSiteSettingData($table="site_settings", $company_id, "customer_pincode", array('option_value'=>$request->customer_pincode));
				Common::updateSiteSettingData($table="site_settings", $company_id, "phone", array('option_value'=>$request->phone));
				
						
				
                /*if ($file = $request->file('user_avatar')) {

                    $fileData = Media::uploads($file, 'uploads/avatar');
                    $array['avatar'] = $fileData['filePath'];
                }*/
                
                return redirect()->back()->with('success', 'Profile updated successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function manage_user_role(Request $request, $id)
    {
        try {
            $user_id = base64_decode($id);
            $data = [];
            $data['heading'] = 'Manage Role';
            $data['breadcrumb'] = ['Users', 'Manage Role'];
            $data['users'] = User::find($user_id);
            $data['role'] = Role::whereNotIn('id', [1,3,6])->get();;
			
			//echo '<pre>';print_r($data);exit;
			
           return view('admin.users.manage_role', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function set_role(Request $request, $id, $role_id)
    {
        try {
            User::find($id)->update([
                'role' => $role_id
            ]);
            return redirect()->back()->with('success', 'Role assigned successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'email' 	=> 'required|email|unique:users,email',
                    'phone' 	=> 'required|numeric|unique:users,phone',
                    'full_name' => 'required',
					'roll' 		=> 'required',
					'password' 	=> 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				$branch_id		= Session::get('branch_id');
                $user_data = [
                    'name' 		=> $request->full_name,
                    'email' 	=> $request->email,
                    'phone'		=> $request->phone,
					'role'		=> $request->roll,
					'status'	=> 1,
					'parent_id'	=> $branch_id,
					'password'	=>  Hash::make($request->password)
                ];
				
				//echo '<pre>';print_r($array);exit;
				
				User::create($user_data);
				
				
				
                //User::find($user_id)->update($array);
                return redirect()->back()->with('success', 'Profile updated successfully');
            }
            $data = [];
            $data['heading'] = 'Add';
            $data['breadcrumb'] = ['Users', 'Add'];
			$data['role']= Role::whereNotIn('id', [1,3,6])->orderBy('id', 'desc')->get();
            return view('admin.users.add', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {

        try {
            $user_id = base64_decode($id);
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users,email,' . $user_id,
                    'phone' => 'required|numeric|unique:users,phone,' . $user_id,
                    'full_name' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				
                $array = [
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ];
				if($request->password!=''){
					$array['password']=Hash::make($request->password);
				}
				
                User::find($user_id)->update($array);
                return redirect()->back()->with('success', 'Profile updated successfully');
            }
            $data = [];
            $data['heading'] = 'Edit';
            $data['breadcrumb'] = ['Users', 'Edit'];
            $data['users'] = User::find($user_id);
			$data['role']= Role::whereNotIn('id', [1,3,6])->orderBy('id', 'desc')->get();
            return view('admin.users.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $id = base64_decode($id);
            User::find($id)->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
    public function change_status($id, $status)
    {
        try {
            $id = base64_decode($id);
            User::find($id)->update([
                'status' => $status
            ]);
            if ($status == 0)
                return redirect()->back()->with('success', 'User blocked successfully');
            else
                return redirect()->back()->with('success', 'User unblocked successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	public function manage_role(Request $request)
    {
        try {
            if ($request->ajax()) {
                $users = Role::whereNotIn('id', [1,3,6])->orderBy('id', 'desc')->get();
                return DataTables::of($users) 
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('action', function ($row) {
                        $dropdown = '<a class="dropdown-item" href="' . route('admin.user.roleUpdate', [base64_encode($row->id)]) . '">Set permission</a>'; 
                        $btn = '<div class="dropdown">
                                    <div class="actionList " id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>

                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        ' . $dropdown . '
                                    </div>
                                </div>
                                ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            $data = [];
            $data['heading'] = 'All Roles';
            $data['breadcrumb'] = ['List'];
            return view('admin.users.roles_list', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	
	public function role_save_update(Request $request){
		if ($request->isMethod('post')) {
			$permission	= $request->permission;
			$role_id	= $request->role_id;
			$branch_id	= Session::get('branch_id');
			
			RoleWisePermission::where('role_id',$role_id)->delete();
			
			if(isset($permission)){
				if(count($permission)>0){
					for($i=0;count($permission)>$i;$i++){
						$permission_id=$permission[$i];
						
						$permissionData=array(
							'role_id'  			=> $role_id,
							'permission_id'  	=> $permission_id,
							'branch_id'			=> $branch_id
						);
						$purchaseInwardStock	= RoleWisePermission::create($permissionData);
					}
				}
			}
			
			return redirect()->back()->with('success', 'Updated successfully');
		}
	}
	
	public function role_update(Request $request, $id)
    {
        try {
            $data = [];
            $data['heading'] 	= 'Update Role';
            $data['breadcrumb'] = ['Manage Role', 'Update Role'];
			$role_id 			= base64_decode($id);
            $data['role'] 		= Role::where('id', $role_id)->first();
			$data['permission'] = RolePermission::get();
			$data['role_id'] 	= $role_id;
			$data['role_wise_permission'] = RoleWisePermission::where('role_id',$role_id)->get();
			
			
			//echo '<pre>';print_r($data['role_wise_permission']);exit;
			
			
           return view('admin.users.role_update', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	
	
	
}
