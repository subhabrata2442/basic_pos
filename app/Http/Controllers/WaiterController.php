<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class WaiterController extends Controller
{
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'name' 		=> 'required',
                    //'mobile' 	=> 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				
				$branch_id		= Session::get('branch_id');
				$waiter_data=array(
					'branch_id'  	=> $branch_id,
					'name'  		=> $request->name,
					'gender'  	    => $request->gender,
					'mobile'		=> $request->mobile,
					'email'		    => $request->email,
					'date_of_birth'	=> $request->date_of_birth,
				);
				Waiter::create($waiter_data);
                return redirect()->back()->with('success', 'Waiter created successfully');
            }
            $data = [];
            $data['heading'] 		= 'Add New Waiter';
            $data['breadcrumb'] 	= ['Waiter', 'Add'];
			//print_r($data);exit;
			
            return view('admin.waiter.add', compact('data'));
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function list(Request $request)
    {
        try {
            if ($request->ajax()) {
                $customer = Waiter::orderBy('id', 'desc')->get();
				
                return DataTables::of($customer)
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('email', function ($row) {
                        return $row->email;
                    })
                    ->addColumn('mobile', function ($row) {
                        return $row->mobile;
                    })
                    ->addColumn('gender', function ($row) {
                        return $row->gender;
                    })
                    ->addColumn('date_of_birth', function ($row) {
                        return date('d-m-Y', strtotime($row->date_of_birth));
                    })
					->addColumn('action', function ($row) {
                        $dropdown = '<a class="dropdown-item" href="' . route('admin.restaurant.waiter.edit', [base64_encode($row->id)]) . '">Edit</a>
                        <a class="dropdown-item delete-item" href="#" id="delete_product" data-url="' . route('admin.restaurant.waiter.delete', [base64_encode($row->id)]) . '">Delete</a>';

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
            $data['heading'] = 'Waiter List';
            $data['breadcrumb'] = ['Waiter', 'List'];
            return view('admin.waiter.list', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $waiter_id = base64_decode($id);
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    //'customer_fname' => 'required|unique:products,product_code,' . $product_id,
                    /*'default_purchase_price' => 'required|numeric',
                    'purchase_tax_rate' => 'required|numeric',
                    'min_order_qty' => 'required|numeric',
                    'product_desc' => 'required',
                    'pack_size' => 'required',*/
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				
				
				$waiter_data=array(
					'name'  		=> $request->name,
					'gender'  	    => $request->gender,
					'mobile'		=> $request->mobile,
					'email'		    => $request->email,
					'date_of_birth'	=> $request->date_of_birth,
				);
				Waiter::find($waiter_id)->update($waiter_data);

				
                return redirect()->back()->with('success', 'Waiter updated successfully');
            }
            $data = [];
            $data['heading'] = 'Waiter Edit';
            $data['breadcrumb'] = ['Waiter', 'Edit'];
            $data['waiter'] = Waiter::find($waiter_id);
            return view('admin.waiter.edit', compact('data'));
        } catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $id = base64_decode($id);
            Waiter::find($id)->delete();
            return redirect()->back()->with('success', 'Waiter deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
}
