<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Abcdefg;
use App\Models\Material;
use App\Models\Service;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\MasterProducts;
use App\Models\VendorCode;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\StockTransferHistory;

use App\Models\Counter;
use App\Models\StockTransferCounterHistory;
use App\Models\CounterWiseStock;


use App\Models\SupplierGst;
use App\Models\ProductRelationshipSize;

use App\Models\PurchaseInwardStock;
use App\Models\InwardStockProducts;

use App\Models\BranchStockProducts;
use App\Models\BranchStockProductSellPrice;

use App\Models\RestaurantFloor;
use App\Models\FloorWiseTable;
use App\Models\TableBookingHistory;
use App\Models\BarProductSizePrice;
use App\Models\Customer;

use App\Models\DailyProductPurchaseHistory;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class AjaxController extends Controller {

	public function ajaxpost(Request $request){
		$action = $request->action;
		$this->{'ajaxpost_' . $action}($request);
	}
	/*BAR POS*/
	public function ajaxpost_get_table($request) {
		$floor_id	= $request->floor_id;

		$table_result	= FloorWiseTable::where('floor_id',$floor_id)->where('status',1)->orderBy('id', 'DESC')->get();

		$result=[];
		foreach($table_result as $key=>$row){
			$waiter_id		= '';
			$waiter_name	= '';
			$items_qty		= '';
			$total_amount	= '';
			$booking_date	= '';
			$booking_time	= '';
			$customer_id	= '';
			$customer_name	= '';
			$customer_phone	= '';
			if($row->booking_status==2){
				$table_info	= TableBookingHistory::where('floor_id',$floor_id)->where('table_id',$row->id)->orderBy('id', 'DESC')->first();

				$waiter_id		= isset($table_info->waiter_id)?$table_info->waiter_id:'';
				$waiter_name	= isset($table_info->waiter->name)?$table_info->waiter->name:'';
				$items_qty		= isset($table_info->items_qty)?$table_info->items_qty:'';
				$total_amount	= isset($table_info->total_amount)?$table_info->total_amount:'';
				$booking_date	= isset($table_info->booking_date)?$table_info->booking_date:'';
				$booking_time	= isset($table_info->booking_time)?$table_info->booking_time:'';
				$customer_id	= isset($table_info->customer_id)?$table_info->customer_id:'';
				$customer_name	= isset($table_info->customer_name)?$table_info->customer_name:'';
				$customer_phone	= isset($table_info->customer_phone)?$table_info->customer_phone:'';
			}
			$result[]=array(
				'floor_id'			=> $row->floor_id,
				'table_id'			=> $row->id,
				'table_name'		=> $row->table_name,
				'status'			=> $row->booking_status,
				'waiter_id'			=> $waiter_id,
				'waiter_name'		=> $waiter_name,
				'items_qty'			=> $items_qty,
				'total_amount'		=> $total_amount,
				'booking_date'		=> $booking_date,
				'booking_time'		=> $booking_time,
				'customer_id'		=> $customer_id,
				'customer_name'		=> $customer_name,
				'customer_phone'	=> $customer_phone,
			);
		}

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}

	public function ajaxpost_get_table_availability($request) {
		$floor_id	= $request->floor_id;
		$tbl_id		= $request->tbl_id;

		$table_result	= FloorWiseTable::where('floor_id',$floor_id)->where('id',$tbl_id)->where('status',1)->orderBy('id', 'DESC')->first();
		$booking_status	= isset($table_result->booking_status)?$table_result->booking_status:'';

		if($booking_status!=''){
			$return_data['table_name']	= $table_result->table_name;
			if($booking_status==2){
				$table_info	= TableBookingHistory::where('floor_id',$floor_id)->where('table_id',$tbl_id)->orderBy('id', 'DESC')->first();
				$booking_url='admin/pos/bar_dine_in_table_booking/create_order/'.base64_encode($table_info->id);
				$return_data['booking_url']	= $booking_url;
			}
		}

		$return_data['status']	= $booking_status;
		echo json_encode($return_data);

	}

	public function ajaxpost_set_table_booking($request) {
		$floor_id	= $request->floor_id;
		$tbl_id		= $request->tbl_id;
		$waiter_id	= $request->waiter_id;

		$customer_name	= $request->customer_name;
		$customer_phone	= $request->customer_phone;

		$customer_id=0;
		if($customer_phone!=''){
			$customer_result=Customer::where('customer_mobile',$customer_phone)->first();
			$customer_id	= isset($customer_result->id)?$customer_result->id:'';
			if($customer_id==''){
				$customerData = Customer::create([
				'customer_mobile' 		=> $customer_phone
			]);
			$customer_id=$customerData->id;
			}
		}

		$table_result	= FloorWiseTable::where('floor_id',$floor_id)->where('id',$tbl_id)->where('status',1)->orderBy('id', 'DESC')->first();
		$booking_status	= isset($table_result->booking_status)?$table_result->booking_status:'';


		$booking_url='';
		if($booking_status!=''){
			if($booking_status==1){
				$branch_id=Session::get('branch_id');
				$n=TableBookingHistory::where('branch_id',$branch_id)->count();
				$order_no=str_pad($n + 1, 5, 0, STR_PAD_LEFT);
				$tableBooking = TableBookingHistory::create([
					'bill_no'		=> $order_no,
					'branch_id'		=> $branch_id,
					'floor_id' 		=> $floor_id,
					'table_id' 		=> $tbl_id,
					'waiter_id'		=> $waiter_id,
					'customer_id'	=> $customer_id,
					'customer_name'	=> $customer_name,
					'customer_phone'=> $customer_phone,
					'booking_date' 	=> date('Y-m-d'),
					'booking_time' 	=> date('H:i:s')
				]);

				$tableBookingId=$tableBooking->id;
				$booking_url='admin/pos/bar_dine_in_table_booking/create_order/'.base64_encode($tableBookingId);
				FloorWiseTable::where('floor_id',$floor_id)->where('id',$tbl_id)->update(['booking_status' => 2]);
			}
		}

		$return_data['booking_url']	= $booking_url;
		echo json_encode($return_data);
	}

	public function ajaxpost_get_food_type_wise_category($request) {
		$food_type	= $request->food_type;

		$food_type_id=1;
		if($food_type=='food'){
			$food_type_id=2;
		}

		$subcategory_result	= Subcategory::where('food_type',$food_type_id)->where('status',1)->orderBy('name', 'ASC')->get();
		
		//print_r($subcategory_result);exit;

		$result=[];
		foreach($subcategory_result as $key=>$row){
			$product_count=Product::select('*')->leftJoin('branch_stock_products', 'products.id', '=', 'branch_stock_products.product_id')->where('branch_stock_products.stock_type','bar')->where('products.subcategory_id',$row->id)->count();

			if($product_count>0){
				$result[]=array(
					'subcategory_id'	=> $row->id,
					'name'				=> $row->name
				);
			}
		}

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}

	public function ajaxpost_get_category_wise_food_items($request) {
		$subcategory_id	= $request->cat_id;
		$food_type		= $request->food_type;
		$branch_id		= Session::get('branch_id');

		$food_type_id=1;
		if($food_type=='food'){
			$food_type_id=2;
		}

		$result=[];

		if($subcategory_id!=''){
			$item_result = Product::where('subcategory_id',$subcategory_id)->get();
			if(count($item_result)>0){
				foreach($item_result as $row){
					$category_id	= $row->category_id;
					$product_id		= $row->id;

					$branch_stock_product_result	= BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('stock_type','bar')->get();

					//print_r($branch_stock_product_result);exit;


					$branch_stock_product_id		= isset($branch_stock_product_result[0]->id)?$branch_stock_product_result[0]->id:'';
					$product_size_id				= isset($branch_stock_product_result[0]->size_id)?$branch_stock_product_result[0]->size_id:'';

					if($branch_stock_product_id!=''){
						$result[]=array(
							'product_id'		=> $row->id,
							'product_barcode'	=> $row->product_barcode,
							'product_name'		=> $row->product_name,
							'size_id'			=> $product_size_id,
							'product_slug'		=> $row->slug,
						);
					}
				}
			}
		}

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}
	
	public function ajaxpost_get_bar_product_mlPrice($request) {
		$product_id	= $request->product_id;
		$food_type	= $request->food_type;
		$branch_id	= Session::get('branch_id');

		$item_result=BarProductSizePrice::where('product_id', $product_id)->get();

		$product_result=[];
		foreach($item_result as $row){
			$product_result[]=array(
				'product_id'				=> $product_id,
				'product_price_id'			=> isset($row->id)?$row->id:0,
				'size'						=> isset($row->size->name)?$row->size->name:'',
				'item_prices'				=> isset($row->product_mrp)?$row->product_mrp:0
			);
		}

		$return_data['product_result']	= $product_result;
		echo json_encode($return_data);
	}

	public function ajaxpost_get_bar_product_byId($request) {
		$product_id	= $request->product_id;
		$food_type	= $request->food_type;
		$branch_id	= Session::get('branch_id');



		$food_type_id=1;
		if($food_type=='food'){
			$food_type_id=2;
		}
		$product_result=[];
		if($product_id!=''){
			$item_result = Product::where('id',$product_id)->get();
			
			//print_r($item_result);exit;
			
			
			if(count($item_result)>0){
				if($food_type_id==2){
					$branch_stock_product_result	= BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->first();
					$branch_stock_product_id		= isset($branch_stock_product_result->id)?$branch_stock_product_result->id:'';
					$size_title						= isset($branch_stock_product_result->size->name)?$branch_stock_product_result->size->name:'';

					//print_r($branch_stock_size);exit;


					if($branch_stock_product_id!=''){
						$branch_product_stock_sell_price_info	= BranchStockProductSellPrice::where('stock_id',$branch_stock_product_id)->where('stock_type','bar')->get();
						if(count($branch_product_stock_sell_price_info)>0){
							$item_prices=[];
							foreach($branch_product_stock_sell_price_info as $row){
								$item_prices[]=array(
									'price_id'		=> $row->id,
									'selling_price'	=> $row->selling_price,
									'offer_price'	=> $row->offer_price,
									'product_mrp'	=> $row->product_mrp,
									'w_qty'			=> $row->w_qty,
									'c_qty'			=> $row->c_qty
								);
							}

							$product_result=array(
								'product_id'				=> $product_id,
								'branch_stock_product_id'	=> $branch_stock_product_id,
								'size_price_id'				=> 0,
								'product_barcode'			=> $item_result[0]->product_barcode,
								'brand_name'				=> trim($item_result[0]->product_name),
								'size'						=> $size_title,
								'item_prices'				=> $item_prices
							);
						}
					}
				}else{
					$branch_stock_product_result	= BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('stock_type','bar')->first();
					
					$branch_stock_product_id		= isset($branch_stock_product_result->id)?$branch_stock_product_result->id:'';

					$size_id			= $request->size_id;
					$item_size_result	= BarProductSizePrice::where('id', $size_id)->first();
					
					$item_size_ml		= isset($item_size_result->size->ml)?$item_size_result->size->ml:'';
					$size_title			= isset($item_size_result->size->name)?$item_size_result->size->name:'';

					$item_total_ml=0;

					if($branch_stock_product_id!=''){
						$branch_product_stock_sell_price_info	= BranchStockProductSellPrice::where('stock_id',$branch_stock_product_id)->where('stock_type','bar')->get();
						$item_total_ml = isset($branch_product_stock_sell_price_info[0]->total_ml)?$branch_product_stock_sell_price_info[0]->total_ml:'';
					}
					
					$item_total_ml=1500;

					if($item_size_ml!=''){
						if($item_total_ml>=$item_size_ml){
							$item_prices=[];
							$item_prices[]=array(
								'price_id'		=> $size_id,
								'selling_price'	=> $item_size_result->product_mrp,
								'offer_price'	=> $item_size_result->product_mrp,
								'product_mrp'	=> $item_size_result->product_mrp,
								'w_qty'			=> 0,
								'c_qty'			=> 0
							);

							$product_result=array(
								'product_id'				=> $product_id,
								'size_price_id'				=> $size_id,
								'branch_stock_product_id'	=> $branch_stock_product_id,
								'product_barcode'			=> $item_result[0]->product_barcode,
								'brand_name'				=> trim($item_result[0]->product_name),
								'size'						=> $size_title,
								'item_prices'				=> $item_prices
							);
						}
					}
					//print_r($product_result);exit;
				}
			}
		}

		$return_data['product_result']	= $product_result;
		echo json_encode($return_data);
	}

	/*END BAR POS*/
	
	/*COUNTER POS*/
	public function ajaxpost_update_stock_product_qty($request) {
		$branch_id	= $request->branch_id;
		$product_id	= $request->product_id;
		$size_id	= $request->size_id;
		$stock_id	= $request->stock_id;
		$qty		= $request->qty;
		
		
		$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
		$product_mrp=isset($productRelationshipSizeResult[0]->cost_rate)?$productRelationshipSizeResult[0]->cost_rate:'';						
		$barcode=isset($productRelationshipSizeResult[0]->product_barcode)?$productRelationshipSizeResult[0]->product_barcode:'';
		$barcode2=isset($productRelationshipSizeResult[0]->barcode2)?$productRelationshipSizeResult[0]->barcode2:'';
		$barcode3=isset($productRelationshipSizeResult[0]->barcode3)?$productRelationshipSizeResult[0]->barcode3:'';
		
		
		
		
		
		$branch_product_stock_info=BranchStockProducts::where('id',$stock_id)->get();
		
		if(count($branch_product_stock_info)>0){
			$branch_product_stock_sell_price_info=BranchStockProductSellPrice::where('stock_id',$branch_product_stock_info[0]->id)->where('selling_price',$product_mrp)->where('stock_type','counter')->get();
			$sell_price_id=isset($branch_product_stock_sell_price_info[0]->id)?$branch_product_stock_sell_price_info[0]->id:'';
			
			if($sell_price_id!=''){
				BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type', 'counter')->update(['c_qty' => $qty]);
			}else{
				$branchProductStockSellPriceData=array(
					'stock_id'		=> $branch_product_stock_info[0]->id,
					'w_qty'  		=> 0,
					'c_qty'  		=> $qty,
					'selling_price'	=> $product_mrp,
					'offer_price'  	=> 0,
					'product_mrp'  	=> $product_mrp,
					'stock_type'  	=> 'counter',
					'created_at'	=> date('Y-m-d')
				);
				
				BranchStockProductSellPrice::create($branchProductStockSellPriceData);
			}
		}
		
		$return_data['status']	= 1;
		echo json_encode($return_data);
		
	}
	/*END COUNTER POS*/
	
	public function ajaxpost_set_update_stock($request) {
		$prev_w_qty		= $request->prev_w_qty;
		$prev_c_qty		= $request->prev_c_qty;
		$new_w_qty		= $request->new_w_qty;
		$new_c_qty		= $request->new_c_qty;
		$stock_id		= $request->stock_id;
		$price_id		= $request->price_id;
		$transfer_to	= $request->transfer_to;
		
		BranchStockProductSellPrice::where('id', $price_id)->where('stock_id', $stock_id)->where('stock_type', 'counter')->update(['w_qty' => $new_w_qty,'c_qty' => $new_c_qty]);
		
		$stocktransferData=array(
			'stock_id'		=> $stock_id,
			'price_id'  	=> $price_id,
			'prev_w_qty'  	=> $prev_w_qty,
			'prev_c_qty'	=> $prev_c_qty,
			'new_w_qty'  	=> $new_w_qty,
			'new_c_qty'  	=> $new_c_qty,
			'transfer_to'  	=> $transfer_to,
		);
		//print_r($stocktransferData);exit;
		StockTransferHistory::create($stocktransferData);
		
		
		$return_data['status']	= 1;
		echo json_encode($return_data);exit;
	}
	
	
	


	public function ajaxpost_get_sell_product_search($request) {
		$search				= $request->search;
		$searchTerm 		= $search;
		$reservedSymbols 	= ['-', '+', '<', '>', '@', '(', ')', '~'];
		$searchTerm 		= str_replace($reservedSymbols, ' ', $searchTerm);
		$searchValues 		= preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

		//print_r($searchValues);exit;

		$res=MasterProducts::query()->where('product_name', 'LIKE', "%{$search}%")->orWhere('product_barcode', $search)->orWhere('barcode2', $search)->orWhere('barcode3', $search)->take(20)->get();
		$result=[];

		foreach($res as $row){
			$result[]=array(
				'id'				=> $row->id,
				'product_barcode'	=> $row->product_barcode,
				'product_name'		=> $row->product_name,
				'product_size'		=> $row->size->name,
			);
		}

		//print_r($result);exit;

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}
	
	public function ajaxpost_get_sell_product_barcode_search($request) {
		$search				= $request->search;
		$result=[];
		if($search!=''){
			$product_barcode=trim($search);
			$res=MasterProducts::query()->where('product_barcode', $search)->orWhere('barcode2', $search)->orWhere('barcode3', $search)->take(1)->get();
			if(count($res)>0){
				$result[]=array(
					'id'				=> isset($res[0]->id)?$res[0]->id:'',
					'product_barcode'	=> isset($res[0]->product_barcode)?trim($res[0]->product_barcode):'',
					'product_name'		=> isset($res[0]->product_name)?trim($res[0]->product_name):'',
					'product_size'		=> isset($res[0]->size->name)?trim($res[0]->size->name):''
				);
			}
		}
		
		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}

	public function ajaxpost_get_sell_product_byId($request) {
		$search_id	= $request->product_id;
		$res = MasterProducts::find($search_id);

		$branch_id=Session::get('branch_id');
		$return_data=[];
		$product_result=[];
		if(isset($res->id)){
			if($res->id!=''){
				$brand_slug		= $res->slug;
				$category_id	= $res->category_id;
				$subcategory_id	= $res->subcategory_id;
				$size_id		= $res->size_id;
				$size_title		= $res->size->name;
				$bottle_case	= $res->qty;
				$product_barcode	= $res->product_barcode;

				$item_result = Product::where('slug',$brand_slug)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->get();
				$product_id	 = isset($item_result[0]->id)?$item_result[0]->id:'';

				$branch_stock_product_result = BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('size_id',$size_id)->where('stock_type','counter')->get();
				$branch_stock_product_id	= isset($branch_stock_product_result[0]->id)?$branch_stock_product_result[0]->id:'';

				if($branch_stock_product_id!=''){
					$branch_product_stock_sell_price_info=BranchStockProductSellPrice::where('stock_id',$branch_stock_product_id)->where('stock_type','counter')->get();
					if(count($branch_product_stock_sell_price_info)>0){
						$item_prices=[];
						foreach($branch_product_stock_sell_price_info as $row){
							$item_prices[]=array(
								'price_id'		=> $row->id,
								'selling_price'	=> $row->selling_price,
								'offer_price'	=> $row->offer_price,
								'product_mrp'	=> $row->product_mrp,
								'w_qty'			=> $row->w_qty,
								'c_qty'			=> $row->c_qty,
							);
						}

						$product_result=array(
							'product_id'				=> $product_id,
							'branch_stock_product_id'	=> $branch_stock_product_id,
							'product_barcode'			=> $product_barcode,
							'brand_name'				=> trim($item_result[0]->product_name).' ('.$size_title.')',
							'item_prices'				=> $item_prices,
						);
						$return_data['status']	= 1;
						$return_data['product_result']	= $product_result;
					}else{
						$return_data['status']	= 0;
					}
				}else{
					$return_data['status']	= 0;
				}
			}else{
				$return_data['status']	= 0;
			}
		}else{
			$return_data['status']	= 0;
		}

		echo json_encode($return_data);
	}

	public function ajaxpost_get_product($request) {
		$search	= $request->search;
		$searchTerm =$search;
		$reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
		$searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);
		$searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

		//print_r($searchValues);exit;

		$res=MasterProducts::query()->where('product_name', 'LIKE', "%{$search}%")->take(20)->get();
		//print_r($size_result);exit;

		/*$res = MasterProducts::where(function ($q) use ($searchValues) {
			foreach ($searchValues as $value) {
				$q->orWhere('product_name', 'like', "%{$value}%");
			}
		})->take(20)->get();*/

		$result=[];

		foreach($res as $row){
			$result[]=array(
				'id'=>$row->id,
				'product_name'=>$row->product_name,
				'product_size'=>$row->size->name,
			);
		}

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}
	public function ajaxpost_get_product_byId($request) {
		$product_id	= $request->product_id;
		$res = MasterProducts::find($product_id);

		$product_result=[];
		if(isset($res->id)){
			if($res->id!=''){
				$brand_slug		= $res->slug;
				$category_id	= $res->category_id;
				$subcategory_id	= $res->subcategory_id;
				$size_id		= $res->size_id;
				$size_title		= $res->size->name;
				$bottle_case	= $res->qty;
				$item_result 	= Product::where('slug',$brand_slug)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->get();
				$product_id	 	= isset($item_result[0]->id)?$item_result[0]->id:'';
				if($product_id!=''){
					$item_size_result=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
					$product_id	 		= isset($item_size_result[0]->id)?$item_size_result[0]->id:'';
					$strength	 		= isset($item_size_result[0]->strength)?$item_size_result[0]->strength:0;
					$retailer_margin	= isset($item_size_result[0]->retailer_margin)?$item_size_result[0]->retailer_margin:0;
					$round_off	 		= isset($item_size_result[0]->round_off)?$item_size_result[0]->round_off:0;
					$sp_fee	 			= isset($item_size_result[0]->special_purpose_fee)?$item_size_result[0]->special_purpose_fee:0;
					$product_mrp	 	= isset($item_size_result[0]->product_mrp)?$item_size_result[0]->product_mrp:0;

					//$size_result=Size::where('id',$size_id)->get();

					//print_r($size_title);exit;

					$product_result=array(
						'product_id'		=> $product_id,
						'product_barcode'	=> $item_result[0]->product_barcode,
						'bottle_case'		=> $bottle_case,
						'category'			=> $item_result[0]->category->name,
						'category_id'		=> $category_id,
						'sub_category'		=> $item_result[0]->subcategory->name,
						'subcategory_id'	=> $subcategory_id,
						'brand_name'		=> trim($item_result[0]->product_name),
						'brand_slug'		=> $brand_slug,
						'measure'			=> $size_title,
						'size_id'			=> $size_id,
						'batch_no'			=> '',
						'strength'			=> trim($strength),
						'retailer_margin'	=> trim($retailer_margin),
						'round_off'			=> trim($round_off),
						'sp_fee'			=> trim($sp_fee),
						'qty'				=> 1,
						'bl'				=> 0,
						'lpl'				=> 0,
						'case_qty'			=> 0,
						'product_mrp'		=> trim($product_mrp),
						'unit_cost'			=> trim($product_mrp),
						'total_cost'		=> trim($product_mrp),
					);
				}
			}
		}
		$status=0;
		if(count($product_result)>0){
			$status=1;
		}
		$return_data['result']	= $product_result;
		$return_data['status']	= $status;
		echo json_encode($return_data);
	}

	public function ajaxpost_get_suppliers($request) {
		$search	= $request->search;
		$searchTerm =$search;
		$reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
		$searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);
		$searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

		//print_r($searchValues);exit;



		$res = Supplier::where(function ($q) use ($searchValues) {
			foreach ($searchValues as $value) {
				$q->orWhere('company_name', 'like', "%{$value}%");
				$q->orWhere('first_name', 'like', "%{$value}%");
				$q->orWhere('last_name', 'like', "%{$value}%");
			}
		})->get();

		$result=[];


		foreach($res as $row){
			$result[]=array(
				'id'=>$row->id,
				'company_name'	=> $row->company_name,
				'first_name'	=> $row->first_name,
				'last_name'		=> $row->last_name,
			);

		}

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		echo json_encode($return_data);
	}

	public function ajaxpost_get_supplier_byId($request) {
		$company_id	= $request->company_id;
		$res = Supplier::find($company_id);
		$supplierGst=SupplierGst::where('supplier_id',$company_id)->get();
		$return_data['supplier']		= $res;
		$return_data['supplier_gst']	= $supplierGst;
		$return_data['status']			= 1;
		echo json_encode($return_data);
	}

	public function ajaxpost_get_warehouse($request) {
		$search	= $request->search;
		$searchTerm =$search;
		$reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
		$searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);
		$searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

		//print_r($searchValues);exit;

		$res = Warehouse::where(function ($q) use ($searchValues) {
			foreach ($searchValues as $value) {
				$q->orWhere('company_name', 'like', "%{$value}%");
			}
		})->get();

		$result=[];


		foreach($res as $row){
			$result[]=array(
				'id'=>$row->id,
				'company_name'	=> $row->company_name,
			);
		}

		$return_data['result']	= $result;
		$return_data['status']	= 1;

		//print_r($return_data);exit;

		echo json_encode($return_data);
	}

	public function ajaxpost_get_warehouse_byId($request) {
		$company_id	= $request->company_id;
		$res = Warehouse::find($company_id);
		$return_data['warehouse']		= $res;
		$return_data['status']			= 1;
		echo json_encode($return_data);
	}



	public function ajaxpost_add_new_product($request) {
		$inward_stock	= $request->inward_stock;

		$product_invoice_items	= [];
		$return_data['result']	= $product_invoice_items;
		$return_data['success']	= 0;
		echo json_encode($return_data);exit;

		if(isset($inward_stock)){
			if(count($inward_stock)>0){
				for($i=0;count($inward_stock)>$i;$i++){
					$barcode		= $inward_stock[$i]['new_product_barcode'];
					$bottle_case	= $inward_stock[$i]['new_product_bottle_case'];
					$in_case		= $inward_stock[$i]['p_new_product_in_case'];
					$category		= $inward_stock[$i]['new_product_category'];
					$sub_category	= $inward_stock[$i]['new_product_sub_category'];
					$brand_name		= $inward_stock[$i]['new_brand_name'];
					$batch_no		= $inward_stock[$i]['new_batch_no'];
					$measure		= $inward_stock[$i]['new_measure'];
					$strength		= $inward_stock[$i]['new_strength'];
					$bl				= $inward_stock[$i]['new_bl'];
					$lpl			= $inward_stock[$i]['new_lpl'];
					$retailer_margin= $inward_stock[$i]['new_retailer_margin'];
					$round_off		= $inward_stock[$i]['new_round_off'];
					$sp_fee			= $inward_stock[$i]['new_sp_fee'];
					$product_mrp	= $inward_stock[$i]['new_product_mrp'];
					$total_cost		= $inward_stock[$i]['new_product_total_cost'];

					$size='';
					if($measure!=''){
						$size=rtrim($measure, '.');
						$size=strtolower($size);
					}

					//echo '<pre>';print_r($size);exit;

					$category_title=trim($category);
					$category_result=Category::where('name',$category_title)->get();
					if(count($category_result)>0){
						$category_id=isset($category_result[0]->id)?$category_result[0]->id:0;
					}else{
						$feature_data=array(
							'name'  		=> $category_title,
							'created_at'	=> date('Y-m-d')
						);
						$feature=Category::create($feature_data);
						$category_id=$feature->id;
					}



					$size_result=Size::where('name',$size)->get();
					if(count($size_result)>0){
						$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
					}else{
						$feature_data=array(
							'name'  		=> $size,
							'created_at'	=> date('Y-m-d')
						);
						$feature=Size::create($feature_data);
						$size_id=$feature->id;
					}

					$type_result=Subcategory::where('name',$sub_category)->get();
					if(count($type_result)>0){
						$subcategory_id=isset($type_result[0]->id)?$type_result[0]->id:0;
					}else{
						$feature_data=array(
							'name'  		=> $sub_category,
							'created_at'	=> date('Y-m-d')
						);
						$feature=Subcategory::create($feature_data);
						$subcategory_id=$feature->id;
					}



					$brand_slug	= Media::create_slug(trim($brand_name));

					$brand_result=Brand::where('slug',$brand_slug)->get();
					if(count($brand_result)>0){
						$brand_id=isset($brand_result[0]->id)?$brand_result[0]->id:0;
					}else{
						$feature_data=array(
							'name'  		=> $brand_name,
							'slug'			=> $brand_slug,
							'created_at'	=> date('Y-m-d')
						);
						$feature=Brand::create($feature_data);
						$brand_id=$feature->id;
					}

					$product_result=Product::where('slug',$brand_slug)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->get();
					$n=Product::count();
					$product_barcode=str_pad($n + 1, 5, 0, STR_PAD_LEFT);

					if($barcode!=''){
						$product_barcode=$barcode;
					}

					if(count($product_result)>0){
						$product_id=$product_result[0]->id;
					}else{
						$product = Product::create([
							'product_name' 		=> $brand_name,
							'slug' 				=> $brand_slug,
							'product_barcode'	=> $product_barcode,
							'default_qty' 		=> 1,
							'category_id' 		=> $category_id,
							'brand_id' 			=> $brand_id,
							'subcategory_id' 	=> $subcategory_id
						]);
						$product_id=$product->id;
						//$product_id=3000+$i;
					}

					$product_size_result=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
					if(count($product_size_result)>0){
					}else{
						$size_cost_data=array(
							'product_id'  			=> $product_id,
							'size_id'  				=> $size_id,
							'cost_rate'  			=> $product_mrp,
							'product_mrp'  			=> $product_mrp,
							'strength'  			=> $strength,
							'retailer_margin'  		=> $retailer_margin,
							'round_off'  			=> $round_off,
							'special_purpose_fee'  	=> $sp_fee,
							'free_discount_percent' => 0,
							'free_discount_amount'  => 0,
							'created_at'			=> date('Y-m-d')
						);
						ProductRelationshipSize::create($size_cost_data);
					}

					$total_qty=$bottle_case*$in_case;

					$product_invoice_items[]=array(
						'product_id'		=> $product_id,
						'product_barcode'	=> $product_barcode,
						'category'			=> $category_title,
						'category_id'		=> $category_id,
						'sub_category'		=> $sub_category,
						'subcategory_id'	=> $subcategory_id,
						'brand_name'		=> trim($brand_name),
						'brand_slug'		=> $brand_slug,
						'measure'			=> $size,
						'size_id'			=> $size_id,
						'batch_no'			=> trim($batch_no),
						'strength'			=> trim($strength),
						'retailer_margin'	=> trim($retailer_margin),
						'round_off'			=> trim($round_off),
						'sp_fee'			=> trim($sp_fee),
						'total_cases'		=> $in_case,
						'in_cases'			=> $bottle_case,
						'qty'				=> $total_qty,
						'bl'				=> $bl,
						'lpl'				=> $lpl,
						'product_mrp'		=> trim($product_mrp),
						'unit_cost'			=> trim($product_mrp),
						'total_cost'		=> trim($total_cost)
					);






					$current_year=date('Y');
					$product_result=MasterProducts::where('product_name',$brand_name)->where('year',$current_year)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->get();

					if(count($product_result)>0){
					}else{
						$master_data=array(
							'product_barcode'  		=> $product_barcode,
							'product_name'  		=> $brand_name,
							'slug'					=> $brand_slug,
							'mrp'  					=> $product_mrp,
							'category_id'  			=> $category_id,
							'size_id'  				=> $size_id,
							'brand_id'  			=> $brand_id,
							'subcategory_id'  		=> $subcategory_id,
							'strength'  			=> $strength,
							'retailer_margin'  		=> $retailer_margin,
							'round_off'  			=> $round_off,
							'special_purpose_fee'  	=> $sp_fee,
							'qty'  					=> $in_case,
							'year'  				=> $current_year,
							'created_at'			=> date('Y-m-d')
						);

						MasterProducts::create($master_data);
					}

				}
			}
		}

		$return_data['result']	= $product_invoice_items;
		$return_data['success']	= 0;
		echo json_encode($return_data);

	}

	public function ajaxpost_add_inward_stock($request) {
		$inward_stock	= $request->inward_stock;
		$company_id		= Session::get('branch_id');
		
		$counter_id='';
		$counter_result=counter::where('branch_id',$company_id)->where('stock_type','bar')->get();
		if(count($counter_result)>0){
			$counter_id=$counter_result[0]->id;
		}
		
		
		
		

		$purchaseStockData=array(
		
			'company_id'  		=> $company_id,
			'supplier_id'  		=> $inward_stock['supplier_id'],
			'warehouse_id'  	=> $inward_stock['warehouse_id'],
			'invoice_no'  		=> $inward_stock['invoice_no'],
			'tp_no'  			=> $inward_stock['tp_no'],
			'purchase_date'  	=> $inward_stock['invoice_purchase_date'],
			'inward_date'  		=> $inward_stock['invoice_inward_date'],
			'payment_method'  	=> $inward_stock['payment_method'],
			'payment_date'  	=> $inward_stock['payment_date'],
			'payment_ref_no'  	=> $inward_stock['payment_ref_no'],
			'invoice_stock'  	=> $inward_stock['invoice_stock'],
			'invoice_stock_type'  	=> $inward_stock['invoice_stock_type'],
			//'tax_type'  		=> isset($inward_stock['stock_inward_tax_type'])?$inward_stock['stock_inward_tax_type']:'',
			//'due_days'  		=> isset($inward_stock['due_days'])?$inward_stock['due_days']:'',
			//'due_date'  		=> isset($inward_stock['due_date'])?$inward_stock['due_date']:'',
			'total_qty'  		=> $inward_stock['total_qty'],
			'gross_amount'  	=> $inward_stock['sub_total'],
			'tax_amount'  		=> $inward_stock['tax_amount'],
			'sub_total'  		=> $inward_stock['sub_total'],
			'extra_cost'  		=> $inward_stock['extra_cost'],
			'shipping_note'  	=> $inward_stock['shipping_note'],
			'additional_note'  	=> $inward_stock['additional_note'],
			'tcs_amt'  			=> $inward_stock['tcs_amt'],
			's_p_fee_amt'  		=> $inward_stock['special_purpose_fee_amt'],
			'round_off_amt'  	=> $inward_stock['round_off_value_amt'],
			'total_amount'  	=> $inward_stock['total_amount'],
			'created_at'		=> date('Y-m-d')
		);

		

		if($inward_stock['invoice_stock_type']=='warehouse'){
			$purchaseStockData['w_qty']=$inward_stock['total_qty'];
		}else{
			$purchaseStockData['c_qty']=$inward_stock['total_qty'];
		}
		
		//print_r($purchaseStockData);exit;

		
		$purchaseInwardStock	= PurchaseInwardStock::create($purchaseStockData);
		$purchaseInwardStockId	= $purchaseInwardStock->id;

		

		//$purchaseInwardStockId=1;
		
		
		
		
		
		
		if($inward_stock['invoice_stock']=='bar'){
			if(isset($inward_stock['product_detail'])){
				if(count($inward_stock['product_detail'])>0){
					for($i=0;count($inward_stock['product_detail'])>$i;$i++){

					$product_id=$inward_stock['product_detail'][$i]['product_id'];
					$product_info=Product::find($inward_stock['product_detail'][$i]['product_id']);

					$prev_stock=isset($product_info->stock_qty)?$product_info->stock_qty:0;
					$current_stock=0;
					$current_stock += $prev_stock;
					$current_stock += $inward_stock['product_detail'][$i]['product_qty'];
					$current_stock += $inward_stock['product_detail'][$i]['free_qty'];

					$measure=$inward_stock['product_detail'][$i]['measure'];
					$size_arr=explode(' ',$measure);
					$size_result=Size::query()->where('name', 'LIKE', "%{$size_arr[0]}%")->get();
					$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
					$size_ml=isset($size_result[0]->ml)?$size_result[0]->ml:0;

					$product_mrp		= isset($inward_stock['product_detail'][$i]['product_mrp'])?$inward_stock['product_detail'][$i]['product_mrp']:0;
					$product_offer_mrp	= isset($inward_stock['product_detail'][$i]['offer_price'])?$inward_stock['product_detail'][$i]['offer_price']:0;
					$product_qty		= isset($inward_stock['product_detail'][$i]['product_qty'])?$inward_stock['product_detail'][$i]['product_qty']:0;


					//print_r($size_ml);exit;

					$branch_id=Session::get('branch_id');
					$branch_product_stock_info=BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('stock_type','bar')->get();
					if(count($branch_product_stock_info)>0){
						$branch_product_stock_sell_price_info=BranchStockProductSellPrice::where('stock_id',$branch_product_stock_info[0]->id)->where('stock_type',$inward_stock['invoice_stock'])->get();
						//print_r($branch_product_stock_sell_price_info);exit;
						$sell_price_id=isset($branch_product_stock_sell_price_info[0]->id)?$branch_product_stock_sell_price_info[0]->id:'';

						if($sell_price_id!=''){
							$sell_price_w_qty = 0;
							$sell_price_c_qty = 0;
							$total_ml		  = 0;

							$product_total_ml=$size_ml*$product_qty;
							$total_ml +=isset($branch_product_stock_sell_price_info[0]->total_ml)?$branch_product_stock_sell_price_info[0]->total_ml:0;
							$total_ml +=$product_total_ml;

							BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['total_ml' => $total_ml]);
							if($inward_stock['invoice_stock_type']=='warehouse'){
								$sell_price_w_qty +=isset($branch_product_stock_sell_price_info[0]->w_qty)?$branch_product_stock_sell_price_info[0]->w_qty:0;
								$sell_price_w_qty +=$product_qty;
								BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['w_qty' => $sell_price_w_qty]);
							}else{
								$sell_price_c_qty +=isset($branch_product_stock_sell_price_info[0]->c_qty)?$branch_product_stock_sell_price_info[0]->c_qty:'';
								$sell_price_c_qty +=$product_qty;
								BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['c_qty' => $sell_price_c_qty]);
							}
						}else{
							$sell_price_w_qty = 0;
							$sell_price_c_qty = 0;
							$total_ml=0;
							if($inward_stock['invoice_stock_type']=='warehouse'){
								$sell_price_w_qty=$product_qty;
								$total_ml=$size_ml*$sell_price_w_qty;
							}else{
								$sell_price_c_qty=$product_qty;
								$total_ml=$size_ml*$sell_price_c_qty;
							}

							$branchProductStockSellPriceData=array(
								'stock_id'		=> $branch_product_stock_info[0]->id,
								'w_qty'  		=> $sell_price_w_qty,
								'c_qty'  		=> $sell_price_c_qty,
								'total_ml'		=> $total_ml,
								'selling_price'	=> $product_mrp,
								'offer_price'  	=> $product_offer_mrp,
								'product_mrp'  	=> $product_mrp,
								'stock_type'  	=> $inward_stock['invoice_stock'],
								'created_at'	=> date('Y-m-d')
							);
							BranchStockProductSellPrice::create($branchProductStockSellPriceData);
						}
					}else{
						$branchProductStockData=array(
							'branch_id'		=> $branch_id,
							'product_id'  	=> $product_id,
							'size_id'  		=> 0,
							'stock_type'  	=> $inward_stock['invoice_stock'],
							'created_at'	=> date('Y-m-d')
						);

						//print_r($branchProductStockData);exit;

						$branchStockProducts=BranchStockProducts::create($branchProductStockData);
						$stock_id=$branchStockProducts->id;

						$sell_price_w_qty = 0;
						$sell_price_c_qty = 0;
						$total_ml=0;
						if($inward_stock['invoice_stock_type']=='warehouse'){
							$sell_price_w_qty=$product_qty;
							$total_ml=$size_ml*$sell_price_w_qty;
						}else{
							$sell_price_c_qty=$product_qty;
							$total_ml=$size_ml*$sell_price_c_qty;
						}



						$branchProductStockSellPriceData=array(
							'stock_id'		=> $stock_id,
							'w_qty'  		=> $sell_price_w_qty,
							'c_qty'  		=> $sell_price_c_qty,
							'total_ml'		=> $total_ml,
							'selling_price'	=> $product_mrp,
							'offer_price'  	=> $product_offer_mrp,
							'product_mrp'  	=> $product_mrp,
							'stock_type'  	=> $inward_stock['invoice_stock'],
							'created_at'	=> date('Y-m-d')
						);

						//print_r($branchProductStockSellPriceData);exit;

						BranchStockProductSellPrice::create($branchProductStockSellPriceData);
					}



					//Product::where('id', $product_id)->update(['stock_qty' => $current_stock]);

					$inward_stock_product=array(
						'inward_stock_id'			=> $purchaseInwardStockId,
						'product_id'  				=> $inward_stock['product_detail'][$i]['product_id'],
						'size_id'  					=> $size_id,
						'case_qty'  				=> $inward_stock['product_detail'][$i]['product_case_qty'],
						'bottle_case'  				=> $inward_stock['product_detail'][$i]['product_bottle_case'],
						'loose_qty'  				=> $inward_stock['product_detail'][$i]['product_loose_qty'],
						'product_qty'  				=> $inward_stock['product_detail'][$i]['product_qty'],
						'free_qty'  				=> $inward_stock['product_detail'][$i]['free_qty'],
						'strength'  				=> $inward_stock['product_detail'][$i]['strength'],
						'bl'  						=> $inward_stock['product_detail'][$i]['bl'],
						'lpl'  						=> $inward_stock['product_detail'][$i]['lpl'],
						'retailer_margin'  			=> $inward_stock['product_detail'][$i]['retailer_margin'],
						'round_off'  				=> $inward_stock['product_detail'][$i]['round_off'],
						'sp_fee'  					=> $inward_stock['product_detail'][$i]['sp_fee'],
						'batch_no'  				=> $inward_stock['product_detail'][$i]['batch_no'],
						'base_price'  				=> isset($inward_stock['product_detail'][$i]['base_price'])?$inward_stock['product_detail'][$i]['base_price']:0,
						'base_discount_percent'  	=> isset($inward_stock['product_detail'][$i]['base_discount_percent'])?$inward_stock['product_detail'][$i]['base_discount_percent']:0,
						'base_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['base_discount_amount'])?$inward_stock['product_detail'][$i]['base_discount_amount']:0,

						'scheme_discount_percent'  	=> isset($inward_stock['product_detail'][$i]['scheme_discount_percent'])?$inward_stock['product_detail'][$i]['scheme_discount_percent']:0,

						'scheme_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['scheme_discount_amount'])?$inward_stock['product_detail'][$i]['scheme_discount_amount']:0,

						'free_discount_percent'  	=> isset($inward_stock['product_detail'][$i]['free_discount_percent'])?$inward_stock['product_detail'][$i]['free_discount_percent']:0,

						'free_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['free_discount_amount'])?$inward_stock['product_detail'][$i]['free_discount_amount']:0,

						'free_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['free_discount_amount'])?$inward_stock['product_detail'][$i]['free_discount_amount']:0,

						'cost_rate'  				=> isset($inward_stock['product_detail'][$i]['cost_rate'])?$inward_stock['product_detail'][$i]['cost_rate']:0,
						'total_cost_rate'  			=> isset($inward_stock['product_detail'][$i]['total_cost_rate'])?$inward_stock['product_detail'][$i]['total_cost_rate']:0,
						'gst_percent'  				=> isset($inward_stock['product_detail'][$i]['gst_percent'])?$inward_stock['product_detail'][$i]['gst_percent']:0,
						'gst_amount'  				=> isset($inward_stock['product_detail'][$i]['gst_amount'])?$inward_stock['product_detail'][$i]['gst_amount']:0,

						'extra_charge'  			=> isset($inward_stock['product_detail'][$i]['extra_charge'])?$inward_stock['product_detail'][$i]['extra_charge']:0,
						'profit_percent'  			=> isset($inward_stock['product_detail'][$i]['profit_percent'])?$inward_stock['product_detail'][$i]['profit_percent']:0,
						'profit_amount'  			=> isset($inward_stock['product_detail'][$i]['profit_amount'])?$inward_stock['product_detail'][$i]['profit_amount']:0,
						'sell_price'  				=> isset($inward_stock['product_detail'][$i]['sell_price'])?$inward_stock['product_detail'][$i]['sell_price']:0,

						'selling_gst_percent'  		=> isset($inward_stock['product_detail'][$i]['selling_gst_percent'])?$inward_stock['product_detail'][$i]['selling_gst_percent']:0,
						'selling_gst_amount'  		=> isset($inward_stock['product_detail'][$i]['selling_gst_amount'])?$inward_stock['product_detail'][$i]['selling_gst_amount']:0,
						'offer_price'  				=> $inward_stock['product_detail'][$i]['offer_price'],
						'product_mrp'  				=> $inward_stock['product_detail'][$i]['product_mrp'],
						'wholesale_price'  			=> 0,
						'mfg_date'  				=> '',
						'expiry_date'  				=> '',
						'total_cost'  				=> $inward_stock['product_detail'][$i]['total_cost'],
						'created_at'				=> date('Y-m-d')
					);
					InwardStockProducts::create($inward_stock_product);
					//print_r($inward_stock_product);exit;
				}
					
					$branch_id=Session::get('branch_id');
					for($i=0;count($inward_stock['product_detail'])>$i;$i++){
						$product_id=$inward_stock['product_detail'][$i]['product_id'];
						$product_qty		= isset($inward_stock['product_detail'][$i]['product_qty'])?$inward_stock['product_detail'][$i]['product_qty']:0;
						$measure=$inward_stock['product_detail'][$i]['measure'];
						$size_arr=explode(' ',$measure);
						$size_result=Size::query()->where('name', 'LIKE', "%{$size_arr[0]}%")->get();
						$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
						$size_ml=isset($size_result[0]->ml)?$size_result[0]->ml:0;
						
						$branch_product_stock_info=BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('stock_type',$inward_stock['invoice_stock'])->get();
						if(count($branch_product_stock_info)>0){
							$branch_product_counter_stock_info=CounterWiseStock::where('stock_id',$branch_product_stock_info[0]->id)->where('counter_id',$counter_id)->where('stock_type',$inward_stock['invoice_stock'])->get();
							
							$product_counter_id=isset($branch_product_counter_stock_info[0]->id)?$branch_product_counter_stock_info[0]->id:'';
							
							if($counter_id!=''){
								$c_qty		= 0;
								$total_ml	= 0;
								if($inward_stock['invoice_stock_type']=='counter'){
									$c_qty=$product_qty;
									$total_ml=$size_ml*$c_qty;
								}
								if($product_counter_id!=''){
									$product_total_ml=0;
									$product_total_ml +=isset($branch_product_counter_stock_info[0]->total_ml)?$branch_product_counter_stock_info[0]->total_ml:0;
									$product_total_ml +=$total_ml;
									$product_total_qty=0;
									$product_total_qty +=isset($branch_product_counter_stock_info[0]->c_qty)?$branch_product_counter_stock_info[0]->c_qty:0;
									$product_total_qty +=$c_qty;
									CounterWiseStock::where('id', $product_counter_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['c_qty' => $product_total_qty,'total_ml' => $product_total_ml]);
								}else{
									$counterWiseStockData=array(
										'stock_id'		=> $branch_product_stock_info[0]->id,
										'counter_id'  	=> $counter_id,
										'c_qty'  		=> $c_qty,
										'total_ml'		=> $total_ml,
										'stock_type'  	=> $inward_stock['invoice_stock']
									);
									CounterWiseStock::create($counterWiseStockData);
								}
							}
						}
					}
				}
			}
		}else{
			if(isset($inward_stock['product_detail'])){
				if(count($inward_stock['product_detail'])>0){
					for($i=0;count($inward_stock['product_detail'])>$i;$i++){
	
						$product_id=$inward_stock['product_detail'][$i]['product_id'];
						$product_info=Product::find($inward_stock['product_detail'][$i]['product_id']);
	
						$prev_stock=isset($product_info->stock_qty)?$product_info->stock_qty:0;
						$current_stock=0;
						$current_stock += $prev_stock;
						$current_stock += $inward_stock['product_detail'][$i]['product_qty'];
						$current_stock += $inward_stock['product_detail'][$i]['free_qty'];
	
						$measure=$inward_stock['product_detail'][$i]['measure'];
						$size_arr=explode(' ',$measure);
						$size_result=Size::query()->where('name', 'LIKE', "%{$size_arr[0]}%")->get();
						$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
						
						
						$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
						$barcode1=isset($productRelationshipSizeResult[0]->product_barcode)?$productRelationshipSizeResult[0]->product_barcode:'';
						$barcode2=isset($productRelationshipSizeResult[0]->barcode2)?$productRelationshipSizeResult[0]->barcode2:'';
						$barcode3=isset($productRelationshipSizeResult[0]->barcode3)?$productRelationshipSizeResult[0]->barcode3:'';
						
						$product_barcode=$barcode1;
						if($barcode1==''){
							$product_barcode=$barcode2;
							if($barcode2==''){
								$product_barcode=$barcode3;
							}
						}
						
						$product_mrp		= isset($inward_stock['product_detail'][$i]['product_mrp'])?$inward_stock['product_detail'][$i]['product_mrp']:0;
						$product_offer_mrp	= isset($inward_stock['product_detail'][$i]['offer_price'])?$inward_stock['product_detail'][$i]['offer_price']:0;
						$product_qty		= isset($inward_stock['product_detail'][$i]['product_qty'])?$inward_stock['product_detail'][$i]['product_qty']:0;
	
	
						//print_r($product_mrp);exit;
	
						$branch_id=Session::get('branch_id');
						$branch_product_stock_info=BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('size_id',$size_id)->get();
						if(count($branch_product_stock_info)>0){
							
							BranchStockProducts::where('id', $branch_product_stock_info[0]->id)->where('stock_type', $inward_stock['invoice_stock'])->update(['product_barcode' => $product_barcode]);
							
							$branch_product_stock_sell_price_info=BranchStockProductSellPrice::where('stock_id',$branch_product_stock_info[0]->id)->where('selling_price',$product_mrp)->where('stock_type',$inward_stock['invoice_stock'])->get();
	
							$sell_price_id=isset($branch_product_stock_sell_price_info[0]->id)?$branch_product_stock_sell_price_info[0]->id:'';
	
							if($sell_price_id!=''){
								$sell_price_w_qty = 0;
								$sell_price_c_qty = 0;
								if($inward_stock['invoice_stock_type']=='warehouse'){
									$sell_price_w_qty +=isset($branch_product_stock_sell_price_info[0]->w_qty)?$branch_product_stock_sell_price_info[0]->w_qty:0;
									$sell_price_w_qty +=$product_qty;
									BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['w_qty' => $sell_price_w_qty]);
								}else{
									$sell_price_c_qty +=isset($branch_product_stock_sell_price_info[0]->c_qty)?$branch_product_stock_sell_price_info[0]->c_qty:'';
									$sell_price_c_qty +=$product_qty;
									BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['c_qty' => $sell_price_c_qty]);
								}
							}else{
								$sell_price_w_qty = 0;
								$sell_price_c_qty = 0;
								if($inward_stock['invoice_stock_type']=='warehouse'){
									$sell_price_w_qty=$product_qty;
								}else{
									$sell_price_c_qty=$product_qty;
								}
	
								$branchProductStockSellPriceData=array(
									'stock_id'		=> $branch_product_stock_info[0]->id,
									'w_qty'  		=> $sell_price_w_qty,
									'c_qty'  		=> $sell_price_c_qty,
									'selling_price'	=> $product_mrp,
									'offer_price'  	=> $product_offer_mrp,
									'product_mrp'  	=> $product_mrp,
									'stock_type'  	=> $inward_stock['invoice_stock'],
									'created_at'	=> date('Y-m-d')
								);
								BranchStockProductSellPrice::create($branchProductStockSellPriceData);
							}
						}else{
							$branchProductStockData=array(
								'branch_id'			=> $branch_id,
								'product_barcode'	=> $product_barcode,
								'product_id'  		=> $product_id,
								'size_id'  			=> $size_id,
								'created_at'		=> date('Y-m-d')
							);
							$branchStockProducts=BranchStockProducts::create($branchProductStockData);
							$stock_id=$branchStockProducts->id;
	
							$sell_price_w_qty = 0;
							$sell_price_c_qty = 0;
	
							if($inward_stock['invoice_stock_type']=='warehouse'){
								$sell_price_w_qty=$product_qty;
							}else{
								$sell_price_c_qty=$product_qty;
							}
	
							$branchProductStockSellPriceData=array(
								'stock_id'		=> $stock_id,
								'w_qty'  		=> $sell_price_w_qty,
								'c_qty'  		=> $sell_price_c_qty,
								'selling_price'	=> $product_mrp,
								'offer_price'  	=> $product_offer_mrp,
								'product_mrp'  	=> $product_mrp,
								'stock_type'  	=> $inward_stock['invoice_stock'],
								'created_at'	=> date('Y-m-d')
							);
							BranchStockProductSellPrice::create($branchProductStockSellPriceData);	
						}
	
						//Product::where('id', $product_id)->update(['stock_qty' => $current_stock]);
						
						$size_ml=trim(str_replace('Ml.', '', $inward_stock['product_detail'][$i]['measure']));
						$total_ml=(int)$size_ml*(int)$inward_stock['product_detail'][$i]['product_qty'];
	
						$inward_stock_product=array(
							'inward_stock_id'			=> $purchaseInwardStockId,
							'branch_id'  				=> $company_id,
							'product_id'  				=> $inward_stock['product_detail'][$i]['product_id'],
							'size_id'  					=> $size_id,
							'case_qty'  				=> $inward_stock['product_detail'][$i]['product_case_qty'],
							'bottle_case'  				=> $inward_stock['product_detail'][$i]['product_bottle_case'],
							'loose_qty'  				=> $inward_stock['product_detail'][$i]['product_loose_qty'],
							'product_qty'  				=> $inward_stock['product_detail'][$i]['product_qty'],
							'free_qty'  				=> $inward_stock['product_detail'][$i]['free_qty'],
							'strength'  				=> $inward_stock['product_detail'][$i]['strength'],
							'bl'  						=> $inward_stock['product_detail'][$i]['bl'],
							'lpl'  						=> $inward_stock['product_detail'][$i]['lpl'],
							'retailer_margin'  			=> $inward_stock['product_detail'][$i]['retailer_margin'],
							'round_off'  				=> $inward_stock['product_detail'][$i]['round_off'],
							'sp_fee'  					=> $inward_stock['product_detail'][$i]['sp_fee'],
							'batch_no'  				=> $inward_stock['product_detail'][$i]['batch_no'],
							'unit_cost'  				=> $inward_stock['product_detail'][$i]['unit_cost'],
							'exc_unit_cost'  			=> $inward_stock['product_detail'][$i]['retail_item_amt'],
							'category_id'  				=> $inward_stock['product_detail'][$i]['category_id'],
							'subcategory_id'  			=> $inward_stock['product_detail'][$i]['subcategory_id'],
							'size_ml'  					=> $inward_stock['product_detail'][$i]['measure'],
							'total_ml'  				=> $total_ml,
							'base_price'  				=> isset($inward_stock['product_detail'][$i]['base_price'])?$inward_stock['product_detail'][$i]['base_price']:0,
							'base_discount_percent'  	=> isset($inward_stock['product_detail'][$i]['base_discount_percent'])?$inward_stock['product_detail'][$i]['base_discount_percent']:0,
							'base_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['base_discount_amount'])?$inward_stock['product_detail'][$i]['base_discount_amount']:0,
	
							'scheme_discount_percent'  	=> isset($inward_stock['product_detail'][$i]['scheme_discount_percent'])?$inward_stock['product_detail'][$i]['scheme_discount_percent']:0,
	
							'scheme_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['scheme_discount_amount'])?$inward_stock['product_detail'][$i]['scheme_discount_amount']:0,
	
							'free_discount_percent'  	=> isset($inward_stock['product_detail'][$i]['free_discount_percent'])?$inward_stock['product_detail'][$i]['free_discount_percent']:0,
	
							'free_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['free_discount_amount'])?$inward_stock['product_detail'][$i]['free_discount_amount']:0,
	
							'free_discount_amount'  	=> isset($inward_stock['product_detail'][$i]['free_discount_amount'])?$inward_stock['product_detail'][$i]['free_discount_amount']:0,
	
							'cost_rate'  				=> isset($inward_stock['product_detail'][$i]['cost_rate'])?$inward_stock['product_detail'][$i]['cost_rate']:0,
							'total_cost_rate'  			=> isset($inward_stock['product_detail'][$i]['total_cost_rate'])?$inward_stock['product_detail'][$i]['total_cost_rate']:0,
							'gst_percent'  				=> isset($inward_stock['product_detail'][$i]['gst_percent'])?$inward_stock['product_detail'][$i]['gst_percent']:0,
							'gst_amount'  				=> isset($inward_stock['product_detail'][$i]['gst_amount'])?$inward_stock['product_detail'][$i]['gst_amount']:0,
	
							'extra_charge'  			=> isset($inward_stock['product_detail'][$i]['extra_charge'])?$inward_stock['product_detail'][$i]['extra_charge']:0,
							'profit_percent'  			=> isset($inward_stock['product_detail'][$i]['profit_percent'])?$inward_stock['product_detail'][$i]['profit_percent']:0,
							'profit_amount'  			=> isset($inward_stock['product_detail'][$i]['profit_amount'])?$inward_stock['product_detail'][$i]['profit_amount']:0,
							'sell_price'  				=> isset($inward_stock['product_detail'][$i]['sell_price'])?$inward_stock['product_detail'][$i]['sell_price']:0,
	
							'selling_gst_percent'  		=> isset($inward_stock['product_detail'][$i]['selling_gst_percent'])?$inward_stock['product_detail'][$i]['selling_gst_percent']:0,
							'selling_gst_amount'  		=> isset($inward_stock['product_detail'][$i]['selling_gst_amount'])?$inward_stock['product_detail'][$i]['selling_gst_amount']:0,
							'offer_price'  				=> $inward_stock['product_detail'][$i]['offer_price'],
							'product_mrp'  				=> $inward_stock['product_detail'][$i]['product_mrp'],
							'wholesale_price'  			=> 0,
							'mfg_date'  				=> '',
							'expiry_date'  				=> '',
							'total_cost'  				=> $inward_stock['product_detail'][$i]['total_cost'],
							'created_at'				=> date('Y-m-d')
						);
						InwardStockProducts::create($inward_stock_product);
						//print_r($inward_stock_product);exit;
					}
					$branch_id=Session::get('branch_id');
					for($i=0;count($inward_stock['product_detail'])>$i;$i++){
						$product_id=$inward_stock['product_detail'][$i]['product_id'];
						
						$product_qty		= isset($inward_stock['product_detail'][$i]['product_qty'])?$inward_stock['product_detail'][$i]['product_qty']:0;
						
						$measure=$inward_stock['product_detail'][$i]['measure'];
						$size_arr=explode(' ',$measure);
						$size_result=Size::query()->where('name', 'LIKE', "%{$size_arr[0]}%")->get();
						$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
						$size_ml=isset($size_result[0]->ml)?$size_result[0]->ml:0;
				
						$branch_product_stock_info=BranchStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('size_id',$size_id)->where('stock_type',$inward_stock['invoice_stock'])->get();
						if(count($branch_product_stock_info)>0){
							$branch_product_counter_stock_info=CounterWiseStock::where('stock_id',$branch_product_stock_info[0]->id)->where('counter_id',$counter_id)->where('stock_type',$inward_stock['invoice_stock'])->get();
							
							$product_counter_id=isset($branch_product_counter_stock_info[0]->id)?$branch_product_counter_stock_info[0]->id:'';
							
							if($counter_id!=''){
								$c_qty		= 0;
								$total_ml	= 0;
								if($inward_stock['invoice_stock_type']=='counter'){
									$c_qty=$product_qty;
									$total_ml=$size_ml*$c_qty;
								}
								if($product_counter_id!=''){
									$product_total_ml=0;
									$product_total_ml +=isset($branch_product_counter_stock_info[0]->total_ml)?$branch_product_counter_stock_info[0]->total_ml:0;
									$product_total_ml +=$total_ml;
									
									$product_total_qty=0;
									$product_total_qty +=isset($branch_product_counter_stock_info[0]->c_qty)?$branch_product_counter_stock_info[0]->c_qty:0;
									$product_total_qty +=$c_qty;
									
									CounterWiseStock::where('id', $product_counter_id)->where('stock_type', $inward_stock['invoice_stock'])->update(['c_qty' => $product_total_qty,'total_ml' => $total_ml]);
								}else{
									$counterWiseStockData=array(
										'stock_id'		=> $branch_product_stock_info[0]->id,
										'counter_id'  	=> $counter_id,
										'c_qty'  		=> $c_qty,
										'total_ml'		=> $total_ml,
										'stock_type'  	=> $inward_stock['invoice_stock']
									);
									
									CounterWiseStock::create($counterWiseStockData);
								}
							}
						}
					}
					$this->daily_product_purchase_history();
				}
			}
		}
		
		$return_data['msg']		= 'Successfully added';
		$return_data['status']	= 1;
		echo json_encode($return_data);
	}
	
	
	public function daily_product_purchase_history(){
		$branch_id				= Session::get('branch_id');
		$purchase_date_result 	= InwardStockProducts::where('branch_id',$branch_id)->where('is_new','Y')->orderBy('id', 'asc')->first();
		$purchase_start_date	= isset($purchase_date_result->created_at)?date('Y-m-d',strtotime($purchase_date_result->created_at)):'';
		
		//print_r($branch_id);exit;
		
		$items=[];
		
		if($purchase_start_date!=''){
			$current_date=date('Y-m-d');
			
			$category_result		= InwardStockProducts::select('category_id')->whereBetween('created_at', [$current_date." 00:00:00", $current_date." 23:59:59"])->distinct()->get();
			$sub_category_result 	= InwardStockProducts::select('subcategory_id')->whereBetween('created_at', [$current_date." 00:00:00", $current_date." 23:59:59"])->distinct()->get();
			$size_result 			= InwardStockProducts::select('size_id')->whereBetween('created_at', [$current_date." 00:00:00", $current_date." 23:59:59"])->distinct()->get();
			$product_result 		= InwardStockProducts::select('product_id')->whereBetween('created_at', [$current_date." 00:00:00", $current_date." 23:59:59"])->distinct()->get();
			
			//echo '<pre>';print_r($category_result);exit;
			
			foreach($category_result as $cat_row){
				$category_id=$cat_row->category_id;
				
				foreach($sub_category_result as $sub_cat_row){
					$subcategory_id=$sub_cat_row->subcategory_id;
					foreach($size_result as $size_row){
						$size_id=$size_row->size_id;
						foreach($product_result as $product_row){
							$product_id=$product_row->product_id;
							
							$purchase_result = InwardStockProducts::selectRaw('sum(total_ml) as total_ml,sum(product_qty) as product_qty,product_mrp')->whereBetween('created_at', [$current_date." 00:00:00", $current_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->where('is_new','Y')->get();
							
							$date_wise_total_ml	  	= isset($purchase_result[0]->total_ml)?$purchase_result[0]->total_ml:0;
							
							//echo '<pre>';print_r($purchase_result);exit;
							//echo $product_id.'-'.$date_wise_total_ml.'</br>';
							
							//$purchase_result=[];
							
							if($date_wise_total_ml>0){
								$date_wise_total_ml	  	= isset($purchase_result[0]->total_ml)?$purchase_result[0]->total_ml:0;
								$date_wise_total_qty	= isset($purchase_result[0]->product_qty)?$purchase_result[0]->product_qty:0;
								$product_mrp			= isset($purchase_result[0]->product_mrp)?$purchase_result[0]->product_mrp:0;
									
								$closing_stock 		= $date_wise_total_qty;
								$closing_stock_ml 	= $date_wise_total_ml;
									
								$last_purchase_history_result = DailyProductPurchaseHistory::select('closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								$last_purchase_total_ml	  	= isset($last_purchase_history_result->closing_stock_ml)?$last_purchase_history_result->closing_stock_ml:'';
								$last_purchase_total_qty	= isset($last_purchase_history_result->closing_stock)?$last_purchase_history_result->closing_stock:'';
								if($last_purchase_total_qty!=''){
									$closing_stock 		= $last_purchase_total_qty+$date_wise_total_qty;
									$closing_stock_ml 	= $last_purchase_total_ml+$date_wise_total_ml;
								}
								$check_purchase_history_result = DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->whereBetween('created_at', [$current_date." 00:00:00", $current_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->get();
								
								//echo '<pre>';print_r($check_purchase_history_result);exit;
								
								$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
								$strength_no =isset($productRelationshipSizeResult[0]->strength)?$productRelationshipSizeResult[0]->strength:'';
								$strength=$strength_no;
								if($strength_no==''){
									$strength=0;
								}
								
								
								if(count($check_purchase_history_result)>0){
									$total_qty	= $date_wise_total_qty+$check_purchase_history_result[0]->total_qty;
									$total_ml	= $date_wise_total_ml+$check_purchase_history_result[0]->total_ml;
									
									/*$items[]=array(
										'is_new'			=>'update',
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_qty' 		=> $total_qty,
										'total_ml' 			=> $total_ml,
										'closing_stock' 	=> $closing_stock,
										'closing_stock_ml' 	=> $closing_stock_ml
									);*/
									
									DailyProductPurchaseHistory::where('id',$check_purchase_history_result[0]->id)->update(['total_qty' => $total_qty,'total_ml' => $total_ml,'closing_stock' => $closing_stock,'closing_stock_ml' => $closing_stock_ml,'strength' => $strength]);
										
									InwardStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
								}else{
									$purchase_data=array(
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_qty'  		=> $date_wise_total_qty,
										'total_ml'  		=> $date_wise_total_ml,
										'closing_stock'  	=> $closing_stock,
										'closing_stock_ml'  => $closing_stock_ml,
										'product_mrp'		=> $product_mrp,
										'strength'			=> $strength
									);
									DailyProductPurchaseHistory::create($purchase_data);
									InwardStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
									
									
									/*$items[]=array(
										'is_new'			=>'new',
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_qty'  		=> $date_wise_total_qty,
										'total_ml'  		=> $date_wise_total_ml,
										'closing_stock'  	=> $closing_stock,
										'closing_stock_ml'  => $closing_stock_ml,
										'product_mrp'		=> $product_mrp
									);*/
									
								}
							}
						}
					}
				}
			}
			
			//echo '<pre>';print_r($items);exit;	
			//echo 'success';exit;	
		}else{
			//echo 'Not data found';exit;
		}	
	}





	public function ajaxpost_set_feature_option($request) {
		$product_type	= $request->product_type;
		$feature_title	= $request->feature_title;

		$return_data	= [];

		$return_data['msg']		= 'Something went wrong. Please try later!';
		$return_data['status']	= 0;
		if($product_type=='category'){
			$count=Category::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This category already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Category::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='size'){
			$count=Size::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This size already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Size::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='brand'){
			$count=Brand::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This brand already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Brand::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='subcategory'){
			$count=Subcategory::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This subcategory already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Subcategory::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='color'){
			$count=Color::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This color already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Color::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='material'){
			$count=Material::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This Material already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Material::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='abcdefg'){
			$count=Abcdefg::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This abcdefg already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Abcdefg::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='service'){
			$count=Service::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This service already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=Service::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}
		else if($product_type=='vendor_code'){
			$count=VendorCode::where('name',$feature_title)->count();
			if($count>0){
				$return_data['msg']		= 'This vendor code already exists!';
				$return_data['status']	= 0;
			}else{
				$feature_data=array(
					'name'  		=> $feature_title,
					'created_at'	=> date('Y-m-d')
				);
				$feature=VendorCode::create($feature_data);
				$feature_id=$feature->id;

				$return_data['val']		= $feature_id;
				$return_data['title']	= $feature_title;
				$return_data['msg']		= 'Successfully added';
				$return_data['status']	= 1;

			}
		}

		//print_r($return_data);exit;
		echo json_encode($return_data);




	}

}
