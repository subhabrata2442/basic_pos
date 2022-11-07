<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDeliveryAddress;
use App\Models\CustomerAddress;
use App\Models\CustomerChildren;
use App\Helper\Media;


use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class CustomerController extends Controller
{
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'customer_fname' 		=> 'required',
                    'customer_last_name' 	=> 'required',
                    //'sku_code' 		=> 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				
				$delivery_address=$request->delivery_address;
				
				//echo '<pre>';print_r($_POST);exit;
				
				$is_same_delivery_address='N';
				if(isset($delivery_address)){
					if($delivery_address=='yes'){
						$is_same_delivery_address='Y';
					}
				}
				
				$customer_data=array(
					'customer_fname'  		=> $request->customer_fname,
					'customer_last_name'  	=> $request->customer_last_name,
					'customer_email'		=> $request->customer_email,
					'customer_mobile'		=> $request->customer_mobile,
					'gender'				=> $request->gender,
					'customer_gstin'		=> $request->customer_gstin,
					'date_of_birth'			=> $request->customer_date_of_birth,
					'outstanding_duedays'   => $request->outstanding_duedays,
					'source'   				=> $request->source,
					'is_same_delivery_address' => $is_same_delivery_address,
					'created_at'			=> date('Y-m-d')
				);
				$customer=Customer::create($customer_data);
				$customer_id=$customer->id;
				
				$customer_address_data=array(
					'customer_id'  	=> $customer_id,
					'address'  		=> $request->customer_address,
					'area'			=> $request->customer_area,
					'city'			=> $request->customer_city,
					'pincode'		=> $request->customer_pincode,
					'state'			=> $request->customer_state_id,
					'country'		=> $request->customer_country_id,
					'created_at'	=> date('Y-m-d')
				);
				
				CustomerAddress::create($customer_address_data);
				
				
				
				$customer_delivery_address_data=array(
					'customer_id'  	=> $customer_id,
					'address'  		=> $request->customer_delivery_address,
					'area'			=> $request->customer_delivery_area,
					'city'			=> $request->customer_delivery_city,
					'pincode'		=> $request->customer_delivery_pincode,
					'state'			=> $request->customer_delivery_state_id,
					'country'		=> $request->customer_delivery_country_id,
					'created_at'	=> date('Y-m-d')
				);
				
				if($is_same_delivery_address=='Y'){
					CustomerDeliveryAddress::create($customer_address_data);
				}else{
					CustomerDeliveryAddress::create($customer_delivery_address_data);
				}
				
				if(isset($request->child_name)){
					if(count($request->child_name)>0){
						for($i=0;count($request->child_name)>$i;$i++){
							$customer_child=array(
								'customer_id'  			=> $customer_id,
								'child_name'  			=> $request->child_name[$i],
								'child_date_of_birth'  	=> $request->child_date_of_birth[$i],
								'created_at'			=> date('Y-m-d')
							);
							CustomerChildren::create($customer_child);
						}
					}

				}
                return redirect()->back()->with('success', 'Customer created successfully');
            }
            $data = [];
            $data['heading'] 		= 'Add New Customer';
            $data['breadcrumb'] 	= ['Customer', 'Add'];
			//print_r($data);exit;
			
            return view('admin.customer.add', compact('data'));
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function list(Request $request)
    {
        try {
            if ($request->ajax()) {
                $customer = Customer::orderBy('id', 'desc')->get();
				
                return DataTables::of($customer)
                    ->addColumn('customer_fname', function ($row) {
                        return $row->customer_fname.' '.$row->customer_last_name;
                    })
                    ->addColumn('customer_email', function ($row) {
                        return $row->customer_email;
                    })
                    ->addColumn('customer_mobile', function ($row) {
                        return $row->customer_mobile;
                    })
                    ->addColumn('gender', function ($row) {
                        return $row->gender;
                    })
                    ->addColumn('customer_gstin', function ($row) {
                        return $row->customer_gstin;
                    })
                    ->addColumn('date_of_birth', function ($row) {
                        return $row->date_of_birth;
                    })
					->addColumn('action', function ($row) {
                        $dropdown = '<a class="dropdown-item" href="' . route('admin.customer.edit', [base64_encode($row->id)]) . '">Edit</a>
                        <a class="dropdown-item delete-item" href="#" id="delete_product" data-url="' . route('admin.customer.delete', [base64_encode($row->id)]) . '">Delete</a>';

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
					->rawColumns(['action', 'company_name', 'first_name'])
                    ->make(true);
					
            }
            $data = [];
            $data['heading'] = 'Customer List';
            $data['breadcrumb'] = ['Customer', 'List'];
            return view('admin.customer.list', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $customer_id = base64_decode($id);
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
				
				$delivery_address=$request->delivery_address;
				$is_same_delivery_address='N';
				if(isset($delivery_address)){
					if($delivery_address=='yes'){
						$is_same_delivery_address='Y';
					}
				}
				
				//echo '<pre>';print_r($_POST);exit;
				
				$customer_data=array(
					'customer_fname'  		=> $request->customer_fname,
					'customer_last_name'  	=> $request->customer_last_name,
					'customer_email'		=> $request->customer_email,
					'customer_mobile'		=> $request->customer_mobile,
					'gender'				=> $request->gender,
					'customer_gstin'		=> $request->customer_gstin,
					'date_of_birth'			=> $request->customer_date_of_birth,
					'outstanding_duedays'   => $request->outstanding_duedays,
					'source'   				=> $request->source,
					'is_same_delivery_address' => $is_same_delivery_address,
					'created_at'			=> date('Y-m-d')
				);
				Customer::find($customer_id)->update($customer_data);
				
				CustomerAddress::where('customer_id',$customer_id)->delete();
				$customer_address_data=array(
					'customer_id'  	=> $customer_id,
					'address'  		=> $request->customer_address,
					'area'			=> $request->customer_area,
					'city'			=> $request->customer_city,
					'pincode'		=> $request->customer_pincode,
					'state'			=> $request->customer_state_id,
					'country'		=> $request->customer_country_id,
					'created_at'	=> date('Y-m-d')
				);
				CustomerAddress::create($customer_address_data);
				
				
				
				$customer_delivery_address_data=array(
					'customer_id'  	=> $customer_id,
					'address'  		=> $request->customer_delivery_address,
					'area'			=> $request->customer_delivery_area,
					'city'			=> $request->customer_delivery_city,
					'pincode'		=> $request->customer_delivery_pincode,
					'state'			=> $request->customer_delivery_state_id,
					'country'		=> $request->customer_delivery_country_id,
					'created_at'	=> date('Y-m-d')
				);
				CustomerDeliveryAddress::where('customer_id',$customer_id)->delete();
				if($is_same_delivery_address=='Y'){
					CustomerDeliveryAddress::create($customer_address_data);
				}else{
					CustomerDeliveryAddress::create($customer_delivery_address_data);
				}
				
				CustomerChildren::where('customer_id',$customer_id)->delete();
				if(isset($request->child_name)){
					if(count($request->child_name)>0){
						for($i=0;count($request->child_name)>$i;$i++){
							$customer_child=array(
								'customer_id'  			=> $customer_id,
								'child_name'  			=> $request->child_name[$i],
								'child_date_of_birth'  	=> $request->child_date_of_birth[$i],
								'created_at'			=> date('Y-m-d')
							);
							CustomerChildren::create($customer_child);
						}
					}

				}
				
                return redirect()->back()->with('success', 'Customer updated successfully');
            }
            $data = [];
            $data['heading'] = 'Customer Edit';
            $data['breadcrumb'] = ['Customer', 'Edit'];
            $data['customer'] = Customer::find($customer_id);
			$data['customer_address'] = CustomerAddress::where('customer_id',$customer_id)->first();
			$data['children'] = CustomerChildren::where('customer_id',$customer_id)->get();
			$data['delivery_address'] = CustomerDeliveryAddress::where('customer_id',$customer_id)->first();
            return view('admin.customer.edit', compact('data'));
        } catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $id = base64_decode($id);
            Customer::find($id)->delete();
            CustomerAddress::where('customer_id', $id)->delete();
			CustomerDeliveryAddress::where('customer_id', $id)->delete();
			CustomerChildren::where('customer_id', $id)->delete();
            return redirect()->back()->with('success', 'Customer deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
}
