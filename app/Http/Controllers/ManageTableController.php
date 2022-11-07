<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use App\Models\FloorWiseTable;
use App\Models\RestaurantFloor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
class ManageTableController extends Controller
{
    public function add(Request $request)
    {
        
        try {
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'title' 		=> 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				$room_floor_data=array(
					'title'  		=> $request->title,
				);
				$restaurant_floor = RestaurantFloor::create($room_floor_data);
                if(isset($request->table_name)){
					if(count($request->table_name)>0){
						for($i=0;count($request->table_name)>$i;$i++){
							$table=array(
								'floor_id'  			=> $restaurant_floor->id,
								'table_name'  			=> $request->table_name[$i],
							);
							FloorWiseTable::create($table);
						}
					}

				}
                return redirect()->back()->with('success', 'Room/Table created successfully');
            }
            $data = [];
            $data['heading'] 		= 'Add New Room/Table';
            $data['breadcrumb'] 	= ['Room/Table', 'Add'];
			//print_r($data);exit;
			
            return view('admin.table.add', compact('data'));
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function list(Request $request)
    {
        try {
            if ($request->ajax()) {
                $restaurantFloor = RestaurantFloor::orderBy('id', 'desc')->get();
				
                return DataTables::of($restaurantFloor)
                    ->addColumn('title', function ($row) {
                        return $row->title;
                    })
                    ->addColumn('total_table', function ($row) {
                        return $row->tables->count();
                    })

					->addColumn('action', function ($row) {
                        $dropdown = '<a class="dropdown-item" href="' . route('admin.restaurant.table.edit', [base64_encode($row->id)]) . '">Edit</a>';

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
            $data['heading'] = 'Room/Table List';
            $data['breadcrumb'] = ['Room/Table', 'List'];
            return view('admin.table.list', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        
        try {
            $floor_id = base64_decode($id);
            if ($request->isMethod('post')) {
                //dd($request->all());
                $validator = Validator::make($request->all(), [
                    'title' 		=> 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
				
				
				$room_floor_data=array(
					'title'  		=> $request->title,
				);
                $restaurant_floor = RestaurantFloor::find($floor_id)->update($room_floor_data);
                if(count($request->table_names) > 0){
                    foreach($request->table_names as $key=>$table_name){
                        if(isset($request->table_ids) && count($request->table_ids)){
                            if(in_array($key,$request->table_ids)){
                                //Update
                                FloorWiseTable::where('id',$key)->update(['table_name' => $table_name]);
                            }else{
                                //insert
                                $table=array(
                                    'floor_id'  			=> $floor_id,
                                    'table_name'  			=> $request->table_names[$key],
                                );
                                FloorWiseTable::create($table);
                            }
                        }else{
                            $table=array(
                                'floor_id'  			=> $floor_id,
                                'table_name'  			=> $request->table_names[$key],
                            );
                            FloorWiseTable::create($table);
                        }
                    }
                }
              
                return redirect()->back()->with('success', 'Room/Table updated successfully');
            }
            $data = [];
            $data['heading'] = 'Room/Table Edit';
            $data['breadcrumb'] = ['Room/Table', 'Edit'];
            $data['floor'] = RestaurantFloor::find($floor_id);
            return view('admin.table.edit', compact('data'));
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
