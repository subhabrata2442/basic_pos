<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\SupplierCompanyMobile;
use App\Models\SupplierBank;
use App\Models\SupplierGst;
use App\Models\SupplierContactDetails;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function list(Request $request)
    {
        try {

            if ($request->ajax()) {
                $supplier = Supplier::orderBy('id', 'desc')->get();
				return DataTables::of($supplier)
                    ->addColumn('company_name', function ($row) {
                        return $row->company_name;
                    })
                    ->addColumn('first_name', function ($row) {
                        return $row->owner_name;
                    })
                    ->addColumn('email', function ($row) {
                        return $row->email;
                    })
                    ->addColumn('state', function ($row) {
                        return '';
                    })
					->addColumn('pan', function ($row) {
                        return $row->pan;
                    })
					->addColumn('address', function ($row) {
                        return $row->address;
                    })
					->addColumn('area', function ($row) {
                        return $row->area;
                    })
					->addColumn('city', function ($row) {
                        return $row->city;
                    })
					->addColumn('pin', function ($row) {
                        return $row->pin;
                    })
					
                    ->addColumn('action', function ($row) {
                        $dropdown = '<a class="dropdown-item" href="' . route('admin.supplier.edit', [base64_encode($row->id)]) . '">Edit</a>
                        <a class="dropdown-item delete-item" href="#" id="delete_supplier" data-url="' . route('admin.supplier.delete', [base64_encode($row->id)]) . '">Delete</a>';

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
            $data['heading'] = 'Supplier List';
            $data['breadcrumb'] = ['Supplier', 'List'];
            return view('admin.suppliers.list', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function add(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'supplier_company_name' => 'required',
                ]);
                if ($validator->fails()) {
                    $errors=$validator->errors()->all();
					$error_html='';
					foreach($errors as $er){
						$error_html .='<span>'.$er.'</span></br>';
					}
					$return_data['success'] = 0;
					$return_data['error_message'] = $error_html;
					return response()->json([$return_data]);
                }
				
				
				
				//print_r($_POST);exit;
				
				
				
				$supplier_data=array(
					'company_name'  => $request->supplier_company_name,
					'owner_name'  	=> $request->supplier_owner_name,
					'address'		=> $request->supplier_address1,
					'address2'		=> $request->supplier_address2,
					'area'   		=> $request->supplier_company_area,
					'pin'			=> $request->supplier_company_zipcode,
					'country'		=> $request->supplier_country_id,
					'phone_no'		=> $request->supplier_company_mobile_no,
					'email'			=> $request->supplier_email,
					'business_type'	=> $request->supplier_business_type,
					'gstin'			=> $request->supplier_gstin_no,
					'pan'			=> $request->supplier_pan_no,
					'state'			=> $request->supplier_state_id,
					'city'			=> $request->supplier_company_city,
					'website'		=> $request->supplier_website,
					'created_at'	=> date('Y-m-d')
				);
				//print_r($supplier_data);exit;
				$supplier=Supplier::create($supplier_data);
				$supplier_id=$supplier->id;
				
				if(isset($request->supplier_bank_name)){
					if(count($request->supplier_bank_name)>0){	
						for($i=0;count($request->supplier_bank_name)>$i;$i++){
							$supplier_bank_data=array(
								'supplier_id'  		=> $supplier_id,
								'bank_name'  		=> $request->supplier_bank_name[$i],
								'bank_branch'  		=> $request->supplier_bank_branch_name[$i],
								'bank_account_no'  	=> $request->supplier_bank_account_no[$i],
								'bank_ifsc_code'  	=> $request->supplier_bank_ifsc_code[$i],
								'created_at'		=> date('Y-m-d')
							);
							SupplierBank::create($supplier_bank_data);
						}
					}
				}
				
				$supplier_contact_data=array(
					'supplier_id'  			=> $supplier_id,
					'contact_email'  		=> $request->alternet_email[0],
					'contact_mobile'  		=> $request->alternet_phone[0],
					'created_at'			=> date('Y-m-d')
				);
				//echo '<pre>';print_r($supplier_contact_data);exit;
				
				SupplierContactDetails::create($supplier_contact_data);
				
				$return_data['success'] = 1;
				return response()->json([$return_data]);;
            }
            $data = [];
            $data['heading'] = 'Supplier Add';
            $data['breadcrumb'] = ['Supplier', 'Add'];
            return view('admin.suppliers.add', compact('data'));
        } catch (\Exception $e) {
            $return_data['success'] = 0;
			$return_data['error_message'] = 'Something went wrong. Please try later. ' . $e->getMessage();
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $supplier_id = base64_decode($id);
			if ($request->isMethod('post')) {
				
                $validator = Validator::make($request->all(), [
                    'supplier_company_name' => 'required',
                    'supplier_email' => 'required',
                    'supplier_owner_name' => 'required',
                    'supplier_pan_no' => 'required',
                    'supplier_company_city' => 'required',
                    'supplier_address1' => 'required',
                ]);
				
                if ($validator->fails()) {
                    $errors=$validator->errors()->all();
					$error_html='';
					foreach($errors as $er){
						$error_html .='<span>'.$er.'</span></br>';
					}
					$return_data['success'] = 0;
					$return_data['error_message'] = $error_html;
					return response()->json([$return_data]);
                }
				
				$supplier_data=array(
					'company_name'  => $request->supplier_company_name,
					'owner_name'  	=> $request->supplier_owner_name,
					'address'		=> $request->supplier_address1,
					'address2'		=> $request->supplier_address2,
					'area'   		=> $request->supplier_company_area,
					'pin'			=> $request->supplier_company_zipcode,
					'country'		=> $request->supplier_country_id,
					'phone_no'		=> $request->supplier_company_mobile_no,
					'email'			=> $request->supplier_email,
					'business_type'	=> $request->supplier_business_type,
					'gstin'			=> $request->supplier_gstin_no,
					'pan'			=> $request->supplier_pan_no,
					'state'			=> $request->supplier_state_id,
					'city'			=> $request->supplier_company_city,
					'website'		=> $request->supplier_website,
					'created_at'	=> date('Y-m-d')
				);
				
				
				//$supplier=Supplier::create($supplier_data);
				Supplier::find($supplier_id)->update($supplier_data);
				
				
				SupplierBank::where('supplier_id',$supplier_id)->delete();
				if(isset($request->supplier_bank_name)){
					if(count($request->supplier_bank_name)>0){	
						for($i=0;count($request->supplier_bank_name)>$i;$i++){
							$supplier_bank_data=array(
								'supplier_id'  		=> $supplier_id,
								'bank_name'  		=> $request->supplier_bank_name[$i],
								'bank_branch'  		=> $request->supplier_bank_branch_name[$i],
								'bank_account_no'  	=> $request->supplier_bank_account_no[$i],
								'bank_ifsc_code'  	=> $request->supplier_bank_ifsc_code[$i],
								'created_at'		=> date('Y-m-d')
							);
							SupplierBank::create($supplier_bank_data);
						}
					}
				}
				
				SupplierContactDetails::where('supplier_id',$supplier_id)->delete();
				$supplier_contact_data=array(
					'supplier_id'  			=> $supplier_id,
					'contact_email'  		=> $request->alternet_email[0],
					'contact_mobile'  		=> $request->alternet_phone[0],
					'created_at'			=> date('Y-m-d')
				);
				SupplierContactDetails::create($supplier_contact_data);
				
				$return_data['success'] = 1;
				return response()->json([$return_data]);;
            }
            
            $data = [];
            $data['heading'] = 'Supplier Edit';
            $data['breadcrumb'] = ['Supplier', 'Edit'];
            $data['supplier'] = Supplier::find($supplier_id);
			
			$data['supplierMobile'] 	= SupplierCompanyMobile::where('supplier_id',$supplier_id)->get();
			$data['supplierBank'] 		= SupplierBank::where('supplier_id',$supplier_id)->get();
			$data['supplierGst'] 		= SupplierGst::where('supplier_id',$supplier_id)->get();
			$data['supplierContact'] 	= SupplierContactDetails::where('supplier_id',$supplier_id)->get();
			
			//echo '<pre>';print_r($data);exit;
						
            return view('admin.suppliers.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $id = base64_decode($id);
            Supplier::find($id)->delete();
			SupplierCompanyMobile::where('supplier_id',$id)->delete();
			SupplierBank::where('supplier_id',$id)->delete();
			SupplierGst::where('supplier_id',$id)->delete();
			SupplierContactDetails::where('supplier_id',$id)->delete();
			
            return redirect()->back()->with('success', 'Supplier deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
}
