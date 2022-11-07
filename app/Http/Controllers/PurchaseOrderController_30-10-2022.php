<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseOrderSupplier;
use App\Helper\Media;
use App\Models\Product;
use App\Models\ProductSupplier;
use App\Models\PurchaseOrder;
use App\Models\PurchaseProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\Response;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Abcdefg;
use App\Models\BranchStockProducts;
use App\Models\BranchStockProductSellPrice;
use App\Models\Material;
use App\Models\Service;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\VendorCode;
use App\Models\Measurement;
use App\Models\MasterProducts;
use App\Models\ProductRelationshipSize;
use App\Models\PurchaseInwardStock;
use App\Models\InwardStockProducts;
use App\Models\SellInwardStock;
use App\Models\SellInwardTenderedChangeAmount;
use App\Models\SellStockProducts;
use App\Models\Site_settings;
use App\Models\Common;
use App\Models\Customer;
use App\Models\Counter;

use App\Models\StockTransferHistory;
use App\Models\StockTransferCounterHistory;
use App\Models\CounterWiseStock;
use App\Models\OpeningStockProducts;
use App\Models\DailyStockTransferHistory;
use App\Models\DailyProductPurchaseHistory;


use App\Models\Warehouse;
use App\Models\TableBookingHistory;
use App\Models\RestaurantFloor;
use App\Models\FloorWiseTable;
use App\Models\Waiter;
use App\Models\TableBookingKoPrintInvoice;
use App\Models\TableBookingKoPrintItems;



use App\Models\BarInwardStock;
use App\Models\BarInwardStockProducts;

use Carbon\Carbon;
use Smalot\PdfParser\Parser;
use Session;

class PurchaseOrderController extends Controller
{
	
	public function print_invoice(){
		
		$lastSellInwardStock=SellInwardStock::orderBy('id','DESC')->take(1)->get();
		
		if(count($lastSellInwardStock)>0){
			 $data=[];
			 
			 $invoice_no=isset($lastSellInwardStock[0]->invoice_no)?$lastSellInwardStock[0]->invoice_no:'';
			 $invoice_date=isset($lastSellInwardStock[0]->sell_date)?$lastSellInwardStock[0]->sell_date:'';
			 
			 $total_qty			= isset($lastSellInwardStock[0]->total_qty)?$lastSellInwardStock[0]->total_qty:'';
			 $discount_amount	= isset($lastSellInwardStock[0]->discount_amount)?$lastSellInwardStock[0]->discount_amount:'';
			 $special_discount	= isset($lastSellInwardStock[0]->special_discount_amt)?$lastSellInwardStock[0]->special_discount_amt:'';
			 $pay_amount		= isset($lastSellInwardStock[0]->pay_amount)?$lastSellInwardStock[0]->pay_amount:'';
			 
			 $gross_total_amount= isset($lastSellInwardStock[0]->gross_total_amount)?$lastSellInwardStock[0]->gross_total_amount:'';
			 
			 $total_discount_amount=0;
			 if($discount_amount!=''){
				 $total_discount_amount +=$discount_amount;
			 }
			 if($special_discount!=''){
				 $total_discount_amount +=$special_discount;
			 }
			 
			 $sellStockProducts=SellStockProducts::where('inward_stock_id',$lastSellInwardStock[0]->id)->get();
			 
			// echo '<pre>';print_r($sellStockProducts);exit;
			 
			 
			 $data['shop_details'] = [
				'name' 		=> 'BAZIMAT F.L.(OFF) SHOP',
				'address1'	=> 'West Chowbaga , Kolkata-700105',
				'address2' 	=> 'West Bengal India',
				'phone'		=> '8770663036',
			];
			
			$data['customer_details'] = [
				'name'		=> 'Subha',
            	'mobile'	=> '7003923969',
            	'address'	=> 'India',
        	];
			
			$data['invoice_details'] = [
				'invoice_no'	=> $invoice_no,
				'invoice_date'	=> $invoice_date,
				'gstin'			=> '',
				'place'			=> 'West Bengal',
				'branch'		=> 'K.P.Shaw Bottling Pvt.Ltd.',
				'cashier_name'	=> 'Mrs Roy Suchandra',
			];
			$data['items']=[];
			
			if(count($sellStockProducts)>0){
				foreach($sellStockProducts as $row){
					$data['items'][] = array(
						'product_name'	=> $row->product_name,
						'qty'			=> $row->product_qty,
						'mrp'			=> number_format($row->product_mrp,2),
						'offer_price'	=> number_format($row->offer_price,2),
						'disc_price'	=> number_format($row->discount_amount,2),
						'final_price'	=> number_format($row->total_cost,2),
					);
				}
			}
			
			$data['total'] =[
				'total_qty'		=> number_format($total_qty,2),
            	'total_disc'	=> number_format($discount_amount,2),
            	'total_price'	=> number_format($gross_total_amount,2)
			]; 
			
			$data['gst'] =[
				'gst_val' =>'0',
				'taxable_amt'=> '0',
				'cgst_rate'=> '0',
				'cgst_amt'=> '0',
				'sgst_rate'=> '0',
				'sgst_amt'=> '0',
				'total_amt'=> number_format($pay_amount,2),
			]; 
			//echo '<pre>';print_r($data);exit;
			$data['total_amt_in_word']	= ucwords(Media::getIndianCurrency($pay_amount));
			$data['total_discount_amount']	= number_format($total_discount_amount,2);
			$data['payment_method'] 	= 'Cash';
			$pdf = PDF::loadView('admin.pdf.invoice', $data);
			
			/*$pdf = PDF::loadView('admin.pdf.invoice', 
        $data, 
        [], 
        [ 
          'title' => 'Certificate', 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);*/
			
			//$customPaper = array(0,0,567.00,283.80);
			$pdf = PDF::loadView('admin.pdf.invoice', $data)->setPaper($customPaper, 'landscape');
			
			return $pdf->stream($invoice_no.'-invoice.pdf');
			//return $pdf->download($invoice_no.'-invoice.pdf');
			
			//echo '<pre>';print_r($data['total_amt_in_word']);exit;
			
		}
    }
	
	public function bar_dine_in_table_booking(Request $request)
    {
        
        try {
            $data = [];
			$branch_id=Session::get('branch_id');
			
            $data['heading'] 		= 'Purchase Order';
            $data['breadcrumb'] 	= ['Purchase Order', 'Add'];
            $data['floor_list'] 	= RestaurantFloor::where('branch_id',$branch_id)->get();
			$data['waiter_list'] 	= Waiter::where('branch_id',$branch_id)->get();
			
			
			$floor_id=isset($data['floor_list'][0]->id)?$data['floor_list'][0]->id:'';
			$tables=[];
			if($floor_id!=''){
				$table_result	= FloorWiseTable::where('floor_id',$floor_id)->where('status',1)->orderBy('id', 'ASC')->get();
				
				foreach($table_result as $key=>$row){
					$booking_history_id	='';
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
						$booking_history_id	= isset($table_info->id)?$table_info->id:'';
						$waiter_id		= isset($table_info->waiter_id)?$table_info->waiter_id:'';
						$waiter_name	= isset($table_info->waiter->name)?$table_info->waiter->name:'';
						$items_qty		= isset($table_info->items_qty)?$table_info->items_qty:'';
						$total_amount	= isset($table_info->total_amount)?$table_info->total_amount:'';
						$booking_date	= isset($table_info->booking_date)?$table_info->booking_date:'';
						$booking_time	= isset($table_info->booking_time)?$table_info->booking_time:'';
						$customer_id	= isset($table_info->customer_id)?$table_info->customer_id:'';
						$customer_name	= isset($table_info->customer_name)?$table_info->customer_name:'';
						$customer_phone	= isset($table_info->customer_phone)?$table_info->customer_phone:'';
						
						
						//echo '<pre>';print_r($customer_phone);exit;
						
						
      
						
						
						
						//$barInwardStockResult	= BarInwardStock::where('table_booking_id',$booking_history_id)->where('branch_id',$branch_id)->first();
						//$waiter_id		= isset($table_info->waiter_id)?$table_info->waiter_id:'';
						
						
						
						
					}
					
					$tables[]=array(
						'booking_history_id' => $booking_history_id,
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
			}
			
			$data['tables'] 	= $tables;
			
			//phpinfo();exit;
			//echo '<pre>';print_r($data);exit;
			
            return view('admin.bar_pos.dine_in_pos_tbl_booking', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	public function bar_dine_in_table_booking_create_order(Request $request, $id)
    {
        try {
            $data = [];
			$branch_id=Session::get('branch_id');
			
            $data['heading'] 		= 'Purchase Order';
            $data['breadcrumb'] 	= ['Purchase Order', 'Add'];
            $data['floor_list'] 	= RestaurantFloor::where('branch_id',$branch_id)->get();
			$data['waiter_list'] 	= Waiter::where('branch_id',$branch_id)->get();
			
			$table_booking_id 		= base64_decode($id);	
			$table_booking_info		= TableBookingHistory::where('id',$table_booking_id)->first();
			$data['booking_info']	= $table_booking_info;
			
			//echo '<pre>';print_r($data['booking_info']);exit;
			
			$subcategory_result		= Subcategory::where('food_type',1)->where('status',1)->orderBy('name', 'ASC')->get();
			
			$data['subcategory']	= [];
			
			if(count($subcategory_result)>0){
				foreach($subcategory_result as $row){
					$product_count=Product::select('*')->leftJoin('branch_stock_products', 'products.id', '=', 'branch_stock_products.product_id')->where('branch_stock_products.stock_type','bar')->where('products.subcategory_id',$row->id)->count();
					if($product_count>0){
						$data['subcategory'][]=array(
							'id'	=> $row->id,
							'name'	=> $row->name,
							'product_count'=>$product_count
						);
					}	
				}
			}
			
			$data['table_booking_cart_items']	= [];
			$data['barInwardStockResult']	= [];
			
			if(isset($table_booking_info)){
				$sell_date=date('Y-m-d');
				$barInwardStockResult	= BarInwardStock::where('table_booking_id',$table_booking_id)->where('branch_id',$branch_id)->where('floor_id',$table_booking_info->floor_id)->where('table_id',$table_booking_info->table_id)->where('waiter_id',$table_booking_info->waiter_id)->where('sell_date',$sell_date)->where('status',1)->orderBy('id', 'DESC')->first();
				$data['barInwardStockResult']	= $barInwardStockResult;
				
				$bar_inward_stock_id	= isset($barInwardStockResult->id)?$barInwardStockResult->id:'';
				
				if($bar_inward_stock_id!=''){
					$data['table_booking_cart_items']	= BarInwardStockProducts::where('inward_stock_id',$bar_inward_stock_id)->get();
				}	
				
			}
			
			
			
			
			//echo '<pre>';print_r($data['booking_info']);exit;

			//echo '<pre>';print_r($data['subcategory']);exit;
			
			$stock_type				= Common::get_user_settings($where=['option_name'=>'stock_type'],$branch_id);
			$data['stock_type'] 	= isset($stock_type)?$stock_type:'w';
            return view('admin.bar_pos.dine_in_pos_tbl_booking_create_order', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	public function bar_create(Request $request){
		
		//print_r($_POST);exit;
		
		$product_ids				= $request->product_id;
		$size_price_ids				= $request->size_price_id;
		$branch_stock_product_ids	= $request->branch_stock_product_id;
		$product_type				= $request->product_type;
		$product_mrp				= $request->product_mrp;
		$product_total_amount		= $request->product_total_amount;
		$product_price_id			= $request->product_price_id;
		$product_qty				= $request->product_qty;
		
		$floor_id			= $request->floor_id;
		$table_id			= $request->table_id;
		$waiter_id			= $request->waiter_id;
		$table_booking_id	= $request->table_booking_id;
		
		
		$total_quantity			= $request->total_quantity;
		$total_mrp				= $request->total_mrp;
		$tendered_amount		= $request->tendered_amount;
		$tendered_change_amount	= $request->tendered_change_amount;
		
		$branch_id=Session::get('branch_id');
		$customer_id	= $request->customer_id;
		$customer_info	= Customer::find($customer_id);
		$customer_name	= isset($customer_info->customer_fname)?$customer_info->customer_fname:'';
		$customer_name	.= isset($customer_info->customer_last_name)?' '.$customer_info->customer_last_name:'';
		$customer_phone	= isset($customer_info->customer_mobile)?$customer_info->customer_mobile:'';
		$sell_date		= date('Y-m-d');
		
		
		$barInwardStockResult	= BarInwardStock::where('table_booking_id',$table_booking_id)->where('branch_id',$branch_id)->where('floor_id',$floor_id)->where('table_id',$table_id)->where('waiter_id',$waiter_id)->where('customer_id',$customer_id)->where('sell_date',$sell_date)->where('status',1)->orderBy('id', 'DESC')->first();
		
		//echo '<pre>';print_r($barInwardStockResult);exit;
		
		
		$bar_inward_stock_id	= isset($barInwardStockResult->id)?$barInwardStockResult->id:'';
		if($bar_inward_stock_id!=''){
			$barInwardStockData=array(
				'sell_date' 			=> date('Y-m-d'),
				'sell_time' 			=> date('H:i:s'),
				'total_qty' 			=> $total_quantity,
				'gross_amount' 			=> $total_mrp,
				'pay_amount' 			=> $total_mrp,
				'tendered_due_amount' 	=> $total_mrp,
				'tendered_amount' 		=> $tendered_amount,
				'tendered_change_amount'=> $tendered_change_amount,
				'payment_status'		=> 2,
				'status'				=> 2,
			);
			
			BarInwardStock::where('id',$bar_inward_stock_id)->update($barInwardStockData);
			
			TableBookingHistory::where('id',$table_booking_id)->update(['status' => 1]);
			FloorWiseTable::where('id',$table_id)->where('floor_id',$floor_id)->update(['booking_status' => 1]);
			
			for($i=0;count($product_ids)>$i;$i++){
				/*$product_id 	= isset($product_ids['product_id'])?$product_ids['product_id']:0;
				$product_qty 	= isset($product_qty['product_qty'])?$product_qty['product_qty']:0;
				$product_size 	= isset($row['product_size'])?$row['product_size']:0;
				$product_type 	= isset($row['product_type'])?$row['product_type']:0;
				$product_mrp 	= isset($row['product_mrp'])?$row['product_mrp']:0;
				$branch_stock_product_id 	= isset($row['branch_stock_product_id'])?$row['branch_stock_product_id']:0;
				$size_price_id 	= isset($row['size_price_id'])?$row['size_price_id']:0;*/
			}
		}
		
		$return_data['success']	= 1;
		echo json_encode($return_data);
		
		
	}
	
	
	public function download_print_ko_product(){
		$print_ko_items=Session::get('print_ko_items');
		
		//echo '<pre>';print_r($print_ko_items);exit;
		
		
		$data=[];
		$data['items']=[];
		$total_qty=0;
		if(isset($print_ko_items)){
			
			foreach($print_ko_items['items'] as $row){
				$qty = isset($row['product_qty'])?$row['product_qty']:0;
				if($qty>0){
					$total_qty +=$qty;
					$data['items'][] = array(
						'product_name'	=> isset($row['product_name'])?$row['product_name']:'',
						'product_qty'	=> $qty,
						'product_size'	=> isset($row['product_size'])?$row['product_size']:'',
						'product_type'	=> isset($row['product_type'])?$row['product_type']:'',
					);
				}	
			}
		}
		
		//echo '<pre>';print_r($data);exit;
		
		
		if(count($data['items'])>0){
			$data['shop_details'] = [
				'name' 		=> 'BAZIMAT F.L.(OFF) SHOP',
				'address1'	=> 'West Chowbaga , Kolkata-700105',
				'address2' 	=> 'West Bengal India',
				'phone'		=> '8770663036',
			];
			$data['customer_details'] = [
				'name'		=> 'Subha',
            	'mobile'	=> '7003923969',
            	'address'	=> 'India',
        	];
			$invoice_no		= date('Ymd').'01';
			$invoice_date	= date('Y-m-d H:i a');
			$data['invoice_details'] = [
				'invoice_no'	=> $invoice_no,
				'invoice_date'	=> $invoice_date,
				'gstin'			=> '',
				'place'			=> 'West Bengal',
				'branch'		=> 'K.P.Shaw Bottling Pvt.Ltd.',
				'cashier_name'	=> 'Mrs Roy Suchandra',
			];
			
			$data['total'] =[
				'total_qty'		=> $total_qty,
            	'total_disc'	=> 0,
            	'total_price'	=> 0
			]; 
			
			$data['gst'] =[
				'gst_val' =>'0',
				'taxable_amt'=> '0',
				'cgst_rate'=> '0',
				'cgst_amt'=> '0',
				'sgst_rate'=> '0',
				'sgst_amt'=> '0',
				'total_amt'=> 0,
			]; 
			
			//echo '<pre>';print_r($data);exit;
			$data['total_amt_in_word']		= '';;
			$data['total_discount_amount']	= 0;
			$data['payment_method'] 		= 'Cash';
			$pdf = PDF::loadView('admin.pdf.ko_print_invoice', $data);
			//$pdf->Output($invoice_no.'-invoice.pdf','D'); 
			return $pdf->stream($invoice_no.'-invoice.pdf');
		}
		exit;
    }
	public function print_bar_invoice(){
		
		$lastSellInwardStock=BarInwardStock::orderBy('id','DESC')->take(1)->get();
		
		//echo '<pre>';print_r($lastSellInwardStock);exit;
		
		
		
		if(count($lastSellInwardStock)>0){
			 $data=[];
			 
			 $invoice_no=isset($lastSellInwardStock[0]->invoice_no)?$lastSellInwardStock[0]->invoice_no:'';
			 $invoice_date		= isset($lastSellInwardStock[0]->sell_date)?$lastSellInwardStock[0]->sell_date:'';
			 $total_qty			= isset($lastSellInwardStock[0]->total_qty)?$lastSellInwardStock[0]->total_qty:'';
			 $pay_amount		= isset($lastSellInwardStock[0]->pay_amount)?$lastSellInwardStock[0]->pay_amount:'';
			 $table_booking_id	= isset($lastSellInwardStock[0]->table_booking_id)?$lastSellInwardStock[0]->table_booking_id:'';
			 
			 $tableBookingHistoryResult=TableBookingHistory::where('id',$table_booking_id)->first();
			 
			 //echo '<pre>';print_r($tableBookingHistoryResult);exit;
			 
			 
			 $sellStockProducts	= BarInwardStockProducts::where('inward_stock_id',$lastSellInwardStock[0]->id)->get();
			 
			$customer_info	= Customer::find($lastSellInwardStock[0]->customer_id);
			$customer_name	= isset($customer_info->customer_fname)?$customer_info->customer_fname:'';
			$customer_name	.= isset($customer_info->customer_last_name)?' '.$customer_info->customer_last_name:'';
			$customer_phone	= isset($customer_info->customer_mobile)?$customer_info->customer_mobile:'';
			
			
			 $data['shop_details'] = [
				'name' 		=> 'BAZIMAT F.L.(OFF) SHOP',
				'address1'	=> 'West Chowbaga , Kolkata-700105',
				'address2' 	=> 'West Bengal India',
				'phone'		=> '8770663036',
			];
			
			$data['customer_details'] = [
				'name'		=> $customer_name,
            	'mobile'	=> $customer_phone,
            	'address'	=> 'Kolkata, West Bengal, India',
        	];
			
			$data['invoice_details'] = [
				'invoice_no'	=> $invoice_no,
				'invoice_date'	=> $invoice_date,
				'gstin'			=> '',
				'place'			=> 'West Bengal',
				'branch'		=> 'K.P.Shaw Bottling Pvt.Ltd.',
				'cashier_name'	=> 'Mrs Roy Suchandra',
				'bill_no'		=> $tableBookingHistoryResult->bill_no,
				'table_no'		=> $tableBookingHistoryResult->table->table_name,
				'booking_date'	=> $tableBookingHistoryResult->booking_date,
				'booking_time'	=> date("h:i A",strtotime($tableBookingHistoryResult->booking_time)),
			];
			$data['items']=[];
			
			//echo '<pre>';print_r($data);exit;
			
			
			if(count($sellStockProducts)>0){
				foreach($sellStockProducts as $row){
					$total_cost=$row->items_qty*$row->product_mrp;
					$data['items'][] = array(
						'product_name'	=> $row->product->product_name,
						'qty'			=> $row->items_qty,
						'size'			=> $row->size,
						'mrp'			=> number_format($row->product_mrp,2),
						'final_price'	=> number_format($total_cost,2),
					);
				}
			}
			
			
			
			$data['total'] =[
				'total_qty'		=> $total_qty,
            	'total_price'	=> number_format($pay_amount,2)
			]; 
			
			
			
			$data['gst'] =[
				'gst_val' =>'0',
				'taxable_amt'=> '0',
				'cgst_rate'=> '0',
				'cgst_amt'=> '0',
				'sgst_rate'=> '0',
				'sgst_amt'=> '0',
				'total_amt'=> number_format($pay_amount,2),
			]; 
			//echo '<pre>';print_r($data);exit;
			$data['total_amt_in_word']	= ucwords(Media::getIndianCurrency($pay_amount));
			$data['payment_method'] 	= 'Cash';
			//echo '<pre>';print_r($data);exit;
			$pdf = PDF::loadView('admin.pdf.bar_invoice', $data);
			return $pdf->stream($invoice_no.'-invoice.pdf');
			//return $pdf->download($invoice_no.'-invoice.pdf');
			
			//echo '<pre>';print_r($data['total_amt_in_word']);exit;
			
		}
    }
	
	
	
	public function print_ko_product(Request $request){
		$product_ids	= $request->product_id;
		$product_qty	= $request->product_qty;
		$product_size	= $request->product_size;
		$product_name	= $request->product_name;
		$product_type	= $request->product_type;
		$product_mrp	= $request->product_mrp;
		$branch_stock_product_ids	= $request->branch_stock_product_id;
		$size_price_ids	= $request->size_price_id;
		
		$floor_id			= $request->floor_id;
		$table_id			= $request->table_id;
		$waiter_id			= $request->waiter_id;
		$table_booking_id	= $request->table_booking_id;
		
		
		$customer_id	= $request->customer_id;
		
		
		
		
		//print_r($_POST);exit;
		
		
		
		$data=[];
		$data['items']=[];
		$total_qty=0;
		$gross_amount=0;
		if(isset($product_ids)){
			for($i=0;count($product_ids)>$i;$i++){
				$qty 	= isset($product_qty[$i])?$product_qty[$i]:0;
				$amount = isset($product_mrp[$i])?$product_mrp[$i]:0;
				if($qty>0){
					$total_qty +=$qty;
					$gross_amount +=$amount;
					$data['items'][] = array(
					
						'product_id'	=> isset($product_ids[$i])?$product_ids[$i]:'',
						'product_name'	=> isset($product_name[$i])?$product_name[$i]:'',
						'product_qty'	=> $qty,
						'product_size'	=> isset($product_size[$i])?$product_size[$i]:'',
						'product_type'	=> isset($product_type[$i])?$product_type[$i]:'',
						'product_mrp'	=> isset($product_mrp[$i])?$product_mrp[$i]:'',
						'branch_stock_product_id'	=> isset($branch_stock_product_ids[$i])?$branch_stock_product_ids[$i]:'',
						'size_price_id'	=> isset($size_price_ids[$i])?$size_price_ids[$i]:'',
					);
				}	
			}
		}
		
		
		
		//print_r($data);exit;
		
		
		
		if(count($data['items'])>0){
			$branch_id=Session::get('branch_id');
			
			$customer_info	= Customer::find($customer_id);
			$customer_name	= isset($customer_info->customer_fname)?$customer_info->customer_fname:'';
			$customer_name	.= isset($customer_info->customer_last_name)?' '.$customer_info->customer_last_name:'';
			$customer_phone	= isset($customer_info->customer_mobile)?$customer_info->customer_mobile:'';
			
			$sell_date		= date('Y-m-d');
			
			$barInwardStockResult	= BarInwardStock::where('table_booking_id',$table_booking_id)->where('branch_id',$branch_id)->where('floor_id',$floor_id)->where('table_id',$table_id)->where('waiter_id',$waiter_id)->where('customer_id',$customer_id)->where('sell_date',$sell_date)->where('status',1)->orderBy('id', 'DESC')->first();
			$bar_inward_stock_id	= isset($barInwardStockResult->id)?$barInwardStockResult->id:'';
			
			//print_r($bar_inward_stock_id);exit;
			
			if($bar_inward_stock_id!=''){
				
				$bar_items_qty	=0;
				$bar_items_qty	+= isset($barInwardStockResult->total_qty)?$barInwardStockResult->total_qty:0;
				$bar_items_qty	+= $total_qty;
				
				$bar_gross_amount		=0;
				$bar_gross_amount		+= isset($barInwardStockResult->gross_amount)?$barInwardStockResult->gross_amount:0;
				$bar_gross_amount		+= $gross_amount;
				
				
				$barInwardStockData=array(
					'sell_date' 			=> date('Y-m-d'),
					'sell_time' 			=> date('H:i:s'),
					'total_qty' 			=> $bar_items_qty,
					'gross_amount' 			=> $bar_gross_amount,
					'pay_amount' 			=> $bar_gross_amount
				);
				
				TableBookingHistory::where('id',$table_booking_id)->update(['items_qty' => $bar_items_qty,'total_amount' => $bar_gross_amount]);
				
				//print_r($barInwardStockData);exit;
				
				BarInwardStock::where('id',$bar_inward_stock_id)->update($barInwardStockData);
			}else{
				$invoice_no='';
				$n=BarInwardStock::where('branch_id',$branch_id)->count();
				$invoice_no .=date('d');
				$invoice_no .='/'.date('Y');
				$invoice_no .='/'.str_pad($n + 1, 4, 0, STR_PAD_LEFT);
				$invoice_no .='|'.date('d/m/Y');
				
				$barInwardStockData=array(
					'branch_id' 			=> $branch_id,
					'table_booking_id'		=> $table_booking_id,
					'floor_id' 				=> $floor_id,	
					'table_id' 				=> $table_id,
					'waiter_id' 			=> $waiter_id,
					'customer_id' 			=> $customer_id,
					'invoice_no' 			=> $invoice_no,
					'sell_date' 			=> date('Y-m-d'),
					'sell_time' 			=> date('H:i:s'),
					'total_qty' 			=> $total_qty,
					'gross_amount' 			=> $gross_amount,
					'pay_amount' 			=> $gross_amount,
					'status' 				=> 1,
					'payment_status' 		=> 1,
					'created_at'			=> date('Y-m-d')
				);
				
				$sellStock		= BarInwardStock::create($barInwardStockData);
				$bar_inward_stock_id = $sellStock->id;
				
				TableBookingHistory::where('id',$table_booking_id)->update(['items_qty' => $total_qty,'total_amount' => $gross_amount]);
			}
			
			//print_r($data['items']);exit;
			foreach($data['items'] as $row){
				$product_id 	= isset($row['product_id'])?$row['product_id']:0;
				$product_qty 	= isset($row['product_qty'])?$row['product_qty']:0;
				$product_size 	= isset($row['product_size'])?$row['product_size']:0;
				$product_type 	= isset($row['product_type'])?$row['product_type']:0;
				$product_mrp 	= isset($row['product_mrp'])?$row['product_mrp']:0;
				$branch_stock_product_id 	= isset($row['branch_stock_product_id'])?$row['branch_stock_product_id']:0;
				$size_price_id 	= isset($row['size_price_id'])?$row['size_price_id']:0;
				
				$ml=0;
				if($size_price_id>0){
					$product_size_arr=explode(' ',$product_size);
					$ml=$product_size_arr[0];
				}
				
				$barInwardStockResult	= BarInwardStockProducts::where('inward_stock_id',$bar_inward_stock_id)->where('product_id',$product_id)->where('size_price_id',$size_price_id)->first();
				$bar_inward_stock_product_id	= isset($barInwardStockResult->id)?$barInwardStockResult->id:'';
				
				//print_r($barInwardStockResult);exit;
				
				if($bar_inward_stock_product_id!=''){
					$items_qty	=0;
					$items_qty	+= isset($barInwardStockResult->items_qty)?$barInwardStockResult->items_qty:0;
					$items_qty	+= 1;
					
					$barInwardStockProductData=array(
						'items_qty' => $items_qty
					);
					
					BarInwardStockProducts::where('id',$bar_inward_stock_product_id)->update($barInwardStockProductData);
				}else{
					$barInwardStockProductData=array(
						'inward_stock_id' 			=> $bar_inward_stock_id,
						'product_id' 				=> $product_id,
						'items_qty' 				=> $product_qty,
						'size' 						=> $product_size,
						'ml' 						=> $ml,
						'product_type' 				=> $product_type,
						'product_mrp' 				=> $product_mrp,
						'branch_stock_product_id' 	=> $branch_stock_product_id,
						'size_price_id' 			=> $size_price_id
					);
					//print_r($barInwardStockProductData);exit;
					BarInwardStockProducts::create($barInwardStockProductData);
				}
			}
			
			$n=TableBookingKoPrintInvoice::where('branch_id',$branch_id)->count();
			$order_no=str_pad($n + 1, 5, 0, STR_PAD_LEFT);
			
			$barKoInwardStockData=array(
				'table_booking_id'		=> $table_booking_id,
				'branch_id' 			=> $branch_id,
				'order_no' 				=> $order_no,
				'floor_id' 				=> $floor_id,	
				'table_id' 				=> $table_id,
				'waiter_id' 			=> $waiter_id,
				'customer_id' 			=> $customer_id,
				'customer_name' 		=> $customer_name,
				'customer_phone' 		=> $customer_phone,
				'booking_date' 			=> date('Y-m-d'),
				'booking_time' 			=> date('H:i:s'),
				'total_qty' 			=> $total_qty,
				'total_amount' 			=> $gross_amount,
			);
			
			$koSellStock	= TableBookingKoPrintInvoice::create($barKoInwardStockData);
			$ko_invoice_id 	= $koSellStock->id;
			
			//$ko_invoice_id = 1;
			
			foreach($data['items'] as $row){	
				$product_id 	= isset($row['product_id'])?$row['product_id']:0;
				$product_qty 	= isset($row['product_qty'])?$row['product_qty']:0;
				$product_size 	= isset($row['product_size'])?$row['product_size']:0;
				$product_type 	= isset($row['product_type'])?$row['product_type']:0;
				$product_mrp 	= isset($row['product_mrp'])?$row['product_mrp']:0;
				
				$koPrintItemsData=array(
					'ko_invoice_id' 		=> $ko_invoice_id,
					'product_id' 			=> $product_id,	
					'items_qty' 			=> $product_qty,
					'size' 					=> $product_size,
					'product_type' 			=> $product_type,
					'product_mrp' 			=> $product_mrp,
				);
				
				TableBookingKoPrintItems::insert($koPrintItemsData);
			}
			
			//print_r($data);exit;
			
			$return_data['status']	= 1;
			//Session::set('print_ko_items', $data);
			session(['print_ko_items' => $data]);
		}else{
			$return_data['status']	= 0;
		}
		
		echo json_encode($return_data);
    }
	
	public function pos_type()
    {
		$data['heading'] 		= 'Purchase Order';
		$data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
		return view('admin.purchase_order.type', compact('data'));
	}
	
	
	public function demo_page_1()
    {
		$data['heading'] 		= 'Purchase Order';
		$data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
		return view('admin.purchase_order.demo_page_1', compact('data'));
	}
	public function demo_page_2()
    {
		$data['heading'] 		= 'Purchase Order';
		$data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
		return view('admin.purchase_order.demo_page_2', compact('data'));
	}
	public function demo_page_3()
    {
		$data['heading'] 		= 'Purchase Order';
		$data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
		return view('admin.purchase_order.demo_page_3', compact('data'));
	}
	public function demo_page_4()
    {
		$data['heading'] 		= 'Purchase Order';
		$data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
		return view('admin.purchase_order.demo_page_4', compact('data'));
	}
	public function demo_page_5()
    {
		$data['heading'] 		= 'Purchase Order';
		$data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
		return view('admin.purchase_order.demo_page_5', compact('data'));
	}
	
	
	
	
	
	public function pos_payment_method()
    {
		
		$data['heading'] 		= 'Payment';
        $data['breadcrumb'] 	= ['Payment'];
            
		return view('admin.purchase_order.payment_method', compact('data'));
	}
	
	public function create(Request $request){
		
		$branch_id=Session::get('branch_id');
		$supplier_id	= 17;
		$customer_id	= 2;
		
		$validator = Validator::make($request->all(), [
			'total_quantity' => 'required',
			'total_mrp' => 'required'
		]);
		if ($validator->fails()) {
			$return_data['success']	= 0;
			$return_data['msg']		= 'Product should not be empty';
			echo json_encode($return_data);
		}
		
		//print_r($_POST);exit;
		
		
		$invoice_no='';
		$n=SellInwardStock::count();
		$invoice_no .=date('d');
		$invoice_no .='/'.date('Y');
		$invoice_no .='/'.str_pad($n + 1, 4, 0, STR_PAD_LEFT);
		$invoice_no .='|'.date('d/m/Y');
		
		$sellStockData=array(
			'branch_id' 				=> $branch_id,
			'supplier_id' 				=> $supplier_id,
			'customer_id' 				=> $customer_id,
			'invoice_no' 				=> $invoice_no,
			'sell_date' 				=> date('Y-m-d'),
			'sell_time' 				=> date('H:i'),
			'stock_type' 				=> $request->stock_type,
			'total_qty' 				=> $request->total_quantity,
			'gross_amount' 				=> $request->total_mrp,
			'tax_amount' 				=> $request->tax_amount,
			'discount_amount' 			=> $request->total_discount_amount,
			'sub_total' 				=> $request->sub_total,
			'round_off_amount' 			=> $request->round_off ?? 0,
			'gross_total_amount'		=> $request->gross_total_amount ?? 0,
			'special_discount_percent'	=> $request->special_discount_percent,
			'special_discount_amt' 		=> $request->special_discount_amt,
			'pay_amount' 				=> $request->total_payble_amount,
			'tendered_due_amount' 		=> $request->total_payble_amount,
			'tendered_amount' 			=> $request->tendered_amount,
			'tendered_change_amount' 	=> $request->tendered_change_amount,
			'payment_method' 			=> $request->payment_method_type,
			'payment_date' 				=> date('Y-m-d'),
			'created_at'				=> date('Y-m-d')
		);
		
		//print_r($sellStockData);exit;
		
		$sellStock		= SellInwardStock::create($sellStockData);
		$sellStockId	= $sellStock->id;
		//$sellStockId	= 1;
		
		$product_ids			= $request->product_id;
		$product_total_amount	= $request->product_total_amount;
		$product_barcode		= $request->product_barcode;
		$product_name			= $request->product_name;
		$product_qty			= $request->product_qty;
		$product_disc_percent	= $request->product_disc_percent;
		$product_disc_amount	= $request->product_disc_amount;
		$product_unit_price		= $request->product_unit_price;
		$product_price_id		= $request->product_price_id;
		
		
		for($i=0;count($product_ids)>$i;$i++){
			$product_stock_id			= $product_ids[$i];
			$branch_product_stock_info	= BranchStockProducts::where('id',$product_stock_id)->get();
			
			$product_id 		= isset($branch_product_stock_info[0]->product_id)?$branch_product_stock_info[0]->product_id:'';
			$product_size_id 	= isset($branch_product_stock_info[0]->size_id)?$branch_product_stock_info[0]->size_id:'0';
			
			
			
			if($product_id!=''){
				$total_amount	= isset($product_total_amount[$i])?$product_total_amount[$i]:'0';
				$barcode		= isset($product_barcode[$i])?$product_barcode[$i]:'';
				$name			= isset($product_name[$i])?$product_name[$i]:'';
				$qty			= isset($product_qty[$i])?$product_qty[$i]:'';
				$disc_percent	= isset($product_disc_percent[$i])?$product_disc_percent[$i]:0;
				$disc_amount	= isset($product_disc_amount[$i])?$product_disc_amount[$i]:0;
				$unit_price		= isset($product_unit_price[$i])?$product_unit_price[$i]:0;
				$price_id		= isset($product_price_id[$i])?$product_price_id[$i]:0;
				
				$productInfo	= Product::where('id',$product_id)->get();
				$category_id	= isset($productInfo[0]->category_id)?$productInfo[0]->category_id:0;
				$subcategory_id	= isset($productInfo[0]->subcategory_id)?$productInfo[0]->subcategory_id:0;
				
				$productSizeInfo= Size::where('id',$product_size_id)->get();
				$size	= isset($productSizeInfo[0]->name)?$productSizeInfo[0]->name:0;
								
				$branch_product_stock_sell_price_info=BranchStockProductSellPrice::where('id',$price_id)->where('stock_type','counter')->get();
				
				$sell_price_id=isset($branch_product_stock_sell_price_info[0]->id)?$branch_product_stock_sell_price_info[0]->id:'';
				
				$sell_price_w_qty = 0;
				$sell_price_c_qty = 0;
				if($request->stock_type=='s'){
					$sell_price_c_qty +=isset($branch_product_stock_sell_price_info[0]->c_qty)?$branch_product_stock_sell_price_info[0]->c_qty:'';
					$sell_price_c_qty -=$qty;
					BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type','counter')->update(['c_qty' => $sell_price_c_qty]);
				}else{
					$sell_price_w_qty +=isset($branch_product_stock_sell_price_info[0]->w_qty)?$branch_product_stock_sell_price_info[0]->w_qty:0;
					$sell_price_w_qty -=$qty;
					BranchStockProductSellPrice::where('id', $sell_price_id)->where('stock_type','counter')->update(['w_qty' => $sell_price_w_qty]);
				}
				
				$sellStockproductData=array(
					'inward_stock_id'	=> $sellStockId,
					'product_id'  		=> $product_id,
					'product_stock_id'  => $product_stock_id,
					'barcode'			=> $barcode,
					'product_name'  	=> $name,
					'price_id'  		=> $price_id,
					'size_id'  			=> $product_size_id,
					'category_id'  		=> $category_id,
					'subcategory_id'  	=> $subcategory_id,
					'size_ml'  			=> $size,
					'product_qty'		=> $qty,
					'discount_percent'  => $disc_percent,
					'discount_amount'  	=> $disc_amount,
					'product_mrp'		=> $unit_price,
					'unit_price'  		=> $unit_price,
					'offer_price'  		=> $unit_price,
					'total_cost'		=> $total_amount,
					//'created_at'		=> date('Y-m-d')
				);
				//print_r($sellStockproductData);exit;
				SellStockProducts::create($sellStockproductData);
			}
		}
		
		$rupee_type 	= $request->rupee_type;
		$rupee_val 		= $request->note;
		$rupee_qty 		= $request->note_qty;
		
		for($r=0;count($rupee_type)>$r;$r++){
			$note_type	= isset($rupee_type[$r])?$rupee_type[$r]:'note';
			$note_val	= isset($rupee_val[$r])?$rupee_val[$r]:0;
			$note_qty	= isset($rupee_qty[$r])?$rupee_qty[$r]:0;
			$total_note_amount	= $note_val*$note_qty;
			
			$tenderedChangeAmount=array(
				'sell_inward_stock_id'	=> $sellStockId,
				'type'  				=> $note_type,
				'rupee_val'  			=> $note_val,
				'qty'					=> $note_qty,
				'amount'  				=> $total_note_amount,
				'created_at'			=> date('Y-m-d')
			);
			//print_r($tenderedChangeAmount);exit;
			SellInwardTenderedChangeAmount::create($tenderedChangeAmount);
		}
		
		
		$return_data['success']	= 1;
		echo json_encode($return_data);
		
		
	}
	
	public function invoice_upload_test(Request $request){
		$file = $request->file('upload_invoice_pdf');
		/*$request->validate([
			'file' => 'required|mimes:pdf',
        ]);*/
		$fileName = $file->getClientOriginalName();
		
		error_reporting(0);
		//include '../pdf_parser/vendor/autoload.php';
			
		$pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($file->path());
		
		$metaData = $pdf->getDetails();
		
		$product_result=[];
		$new_product_result=[];
		
		$tp_no='';
		$tp_no_row_id='';
		$data = $pdf->getPages()[0]->getDataTm();
		
		//echo '<pre>';print_r($data);exit;
		
		for($i=0; count($data)>$i; $i++){
			$th_head	= trim($data[$i][1]);
			
			if (stripos($th_head, "Transport Pass No") !== false) {
				$tp_no_row_id	= $i;
				break;
			}
		}
		if(isset($data[$tp_no_row_id][1])){
			if($data[$tp_no_row_id][1]!=''){
				$tp_no_arr	= explode(':',$data[$tp_no_row_id][1]);
				$tp_no		= isset($tp_no_arr[1])?$tp_no_arr[1]:'';	
			}
		}
		
		$invoice_date_row_id='';
		for($i=0; count($data)>$i; $i++){
			$th_head	= trim($data[$i][1]);
			if (stripos($th_head, "Date") !== false) {
				$invoice_date_row_id	= $i;
				break;
			}
		}
		
		$invoice_date='';
		if(isset($data[$invoice_date_row_id][1])){
			if($data[$invoice_date_row_id][1]!=''){
				$invoice_date_arr	= explode(':',$data[$invoice_date_row_id][1]);
				$invoice_date_arr	= isset($invoice_date_arr[1])?trim($invoice_date_arr[1]):'';
				$invoice_date_arr2	= explode(' ',$invoice_date_arr);
				
				$invoice_date_arr3	= explode('/',$invoice_date_arr2[0]);
				$invoice_date		= $invoice_date_arr3[0].'-'.$invoice_date_arr3[1].'-'.$invoice_date_arr3[2];	
				$invoice_date		= date('Y-m-d',strtotime($invoice_date));
			}
		}
		
		
		//print_r($invoice_date);exit;
		
		
		
		
		if(isset($metaData['Pages'])){
			if($metaData['Pages']>0){
				for($p=10;$metaData['Pages']>$p;$p++){
					$data = $pdf->getPages()[$p]->getDataTm();
					
					$start_product_row_id	= '';
					$remove_row_ids=[];
					$product_cat_ids=[];
					$product_size_ids=[];
					$product_inCases_ids=[];
					
					for($i=0; count($data)>$i; $i++){
						$th_head	= str_replace(' ','',$data[$i][1]);
						if($th_head==''){
							$remove_row_ids[]	= $i;
						}
					}
					
					for($i=0; count($remove_row_ids)>$i; $i++){
						unset($data[$remove_row_ids[$i]]);
					}
					
					$brand_liquor_data=[];
					foreach($data as $key=>$val){
						$index_val	= trim($val[1]);
						$brand_liquor_data[]=$index_val;
					}
					
					
					//echo '<pre>';print_r($brand_liquor_data);exit;
					
					
					for($i=0; count($brand_liquor_data)>$i; $i++){
						$th_head	= str_replace(' ','',$brand_liquor_data[$i]);
						if (preg_match('/\BrandName\b/', $th_head)) {
							$start_product_row_id	= ($i+23);
							break;
						}
					}
					
					//echo '<pre>';print_r($start_product_row_id);exit;
					
					
					for($i=$start_product_row_id; count($brand_liquor_data)>$i; $i++){
						$th_head	= str_replace(' ','',$brand_liquor_data[$i]);
						//$th_head	= trim($brand_liquor_data[$i]);
						
						if (preg_match('/\IMFL\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						
						/*if (preg_match('/\OS\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						if (preg_match('/\Country Liquor\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						if (preg_match('/\OSBI\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						if (preg_match('/\CS\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}*/
					}
					
					//echo '<pre>';print_r($product_cat_ids);exit;
					
					for($i=$start_product_row_id; count($brand_liquor_data)>$i; $i++){
						$th_head	= $brand_liquor_data[$i];
						if (stripos($th_head, "Ml.") !== false) {
							$product_size_ids[]	= $i;
						}
					}
					
					//echo '<pre>';print_r($product_size_ids);exit;
					
					for($i=$start_product_row_id; count($brand_liquor_data)>$i; $i++){
						$th_head	= $brand_liquor_data[$i];
						if (stripos($th_head, "- 0") !== false) {
							$product_inCases_ids[]	= $i;
						}
					}
					
					//echo '<pre>';print_r($product_inCases_ids);exit;
					
					for($i=0; count($product_cat_ids)>$i; $i++){
						$index_1=$product_cat_ids[$i];
						$index_2=($index_1+1);
						$index_3=$product_size_ids[$i];
						$index_4=($product_inCases_ids[$i]+1);
						$index_5=($product_inCases_ids[$i]+2);
						$index_6=($product_inCases_ids[$i]+3);
						$index_7=($product_inCases_ids[$i]+4);
						
						//echo '<pre>';print_r($index_4);exit;
						
						$brand_name_length=($product_size_ids[$i]-$index_2);
						
						$brand_name='';
						for($j=1; $brand_name_length>$j; $j++){
							$p_index=$index_2+$j;
							$brand_name .= trim($brand_liquor_data[$p_index]).' ';
						}
						//$brand_name_arr = explode('[',$brand_name);
						//$brand_name		= isset($brand_name_arr[0])?trim($brand_name_arr[0]):'';
						
						//echo '<pre>';print_r($brand_name);exit;
						
						$current_year=date('Y');
						
						$batch_no_length=($product_inCases_ids[$i]-1);
						
						if (stripos($brand_liquor_data[$batch_no_length], $current_year) !== false) {
							$batch_index_count=2;
						}else{
							$batch_index_count=3;
						}
						
						//$batch_index_count=2;
						
						$batch_length=($product_inCases_ids[$i]-$batch_index_count);
						
						$batch_no='';
						for($b=0; $batch_index_count>$b; $b++){
							$b_index=$batch_length+$b;
							$batch_no .= trim($brand_liquor_data[$b_index]).' ';
						}
						
						$brand_slug	= Media::create_slug(trim($brand_name));
						$category_title=trim($brand_liquor_data[$index_1]);
						$sub_category_title=trim($brand_liquor_data[$index_2]);
						
						
						
						
						
							$total_cost	= trim($brand_liquor_data[$index_7]);
							$total_qty	= trim($brand_liquor_data[$index_4]);
							$unit_mrp	= $total_cost/$total_qty;
							
							$new_product_result[]=array(
								'category'			=> $category_title,
								'sub_category'		=> $sub_category_title,
								'brand_name'		=> trim($brand_name),	 
								'measure'			=> $size_title,
								'batch_no'			=> trim($batch_no),
								'strength'			=> '',
								'retailer_margin'	=> '',
								'round_off'			=> '',
								'sp_fee'			=> '',
								'qty'				=> trim($brand_liquor_data[$index_4]),
								'bl'				=> trim($brand_liquor_data[$index_5]),
								'lpl'				=> trim($brand_liquor_data[$index_6]),
								'product_mrp'		=> trim($unit_mrp),
								'unit_cost'			=> trim($unit_mrp),
								'total_cost'		=> trim($brand_liquor_data[$index_7])
							);
						
					}	
				}
			}
		}
		
		echo '<pre>';
		print_r($product_result);
		print_r($new_product_result);
		exit;
		
		if(count($product_result)>0){
			$return_data['result']			= $product_result;
			$return_data['new_result']		= $new_product_result;
			$return_data['tp_no']			= $tp_no;
			$return_data['invoice_date']	= $invoice_date;
			
			$return_data['success']	= 1;
		}else{
			$return_data['success']	= 0;
		}
		
		echo json_encode($return_data);
		
		//echo '<pre>';print_r($return_data);exit;		
	}
	
	public function invoice_upload(Request $request){
		$branch_id	= Session::get('branch_id');
		$stock_type=$request->upload_invoice_stock_type;
		
		$file = $request->file('upload_invoice_pdf');
		/*$request->validate([
			'file' => 'required|mimes:pdf',
        ]);*/
		$fileName = $file->getClientOriginalName();
		
		error_reporting(0);
		//include '../pdf_parser/vendor/autoload.php';
			
		$pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($file->path());
		
		$metaData = $pdf->getDetails();
		
		$product_result=[];
		$new_product_result=[];
		$invoice_product_result=[];
		
		$product_ids=[];
		$product_slugs=[];
		
		$tp_no='';
		$tp_no_row_id='';
		$data = $pdf->getPages()[0]->getDataTm();
		
		//echo '<pre>';print_r($data);exit;
		
		for($i=0; count($data)>$i; $i++){
			$th_head	= trim($data[$i][1]);
			
			if (stripos($th_head, "Transport Pass No") !== false) {
				$tp_no_row_id	= $i;
				break;
			}
		}
		if(isset($data[$tp_no_row_id][1])){
			if($data[$tp_no_row_id][1]!=''){
				$tp_no_arr	= explode(':',$data[$tp_no_row_id][1]);
				$tp_no		= isset($tp_no_arr[1])?trim($tp_no_arr[1]):'';	
			}
		}
		
		if($tp_no!=''){
			$check_tp_no=PurchaseInwardStock::where('tp_no', $tp_no)->where('company_id',$branch_id)->where('invoice_stock', $stock_type)->get();
			if(count($check_tp_no)>0){
				$return_data['msg']		= 'This invoice is already uploaded!';
				$return_data['success']	= 2;
				echo json_encode($return_data);exit;
			}
		}
		
		$invoice_date_row_id='';
		for($i=0; count($data)>$i; $i++){
			$th_head	= trim($data[$i][1]);
			if (stripos($th_head, "Date") !== false) {
				$invoice_date_row_id	= $i;
				break;
			}
		}
		
		
		
		$invoice_date='';
		if(isset($data[$invoice_date_row_id][1])){
			if($data[$invoice_date_row_id][1]!=''){
				$invoice_date_arr	= explode(':',$data[$invoice_date_row_id][1]);
				$invoice_date_arr	= isset($invoice_date_arr[1])?trim($invoice_date_arr[1]):'';
				$invoice_date_arr2	= explode(' ',$invoice_date_arr);
				
				$invoice_date_arr3	= explode('/',$invoice_date_arr2[0]);
				$invoice_date		= $invoice_date_arr3[0].'-'.$invoice_date_arr3[1].'-'.$invoice_date_arr3[2];	
				$invoice_date		= date('Y-m-d',strtotime($invoice_date));
			}
		}
		
		//print_r($invoice_date);exit;
		$invoice_no_row=[];
		for($i=0; count($data)>$i; $i++){
			$th_head	= trim($data[$i][1]);
			if (stripos($th_head, "& Date") !== false) {
				$invoice_no_row[]	= $i;
			}
		}
		$invoice_no='';
		if(count($invoice_no_row)>0){
			$invoice_no_row_id=isset($invoice_no_row[1])?$invoice_no_row[1]:'';
			if($invoice_no_row_id!=''){
				$invoice_no_length=($invoice_no_row_id-3);
				for($j=0; 3>$j; $j++){
					$invoice_index=$invoice_no_length+$j;
					$invoice_no .= trim($data[$invoice_index][1]);
				}
			}
		}
		
		//print_r($invoice_date);exit;
		$warehouse_row_id='';
		for($i=0; count($data)>$i; $i++){
			$th_head	= trim($data[$i][1]);
			if (stripos($th_head, "Bevco") !== false) {
				$warehouse_row_id	= $i;
				break;
			}
		}
		
		$warehouse_info=[];
		$warehouse_name='';
		if($warehouse_row_id!=''){
			for($j=0; 5>$j; $j++){
				$warehouse_index=$warehouse_row_id+$j;
				$warehouse_name .= ' '.trim($data[$warehouse_index][1]);
				$warehouse_name = str_replace( ',', '', $warehouse_name);
			}	
		}
		
		if($warehouse_name!=''){
			$reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
			$searchTerm = str_replace($reservedSymbols, ' ', $warehouse_name);
			$searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);
			
			$warehouse_res = Warehouse::where(function ($q) use ($searchValues) {
				foreach ($searchValues as $value) {
					$q->orWhere('company_name', 'like', "%{$value}%");
				}
				})->take(1)->get();
				
			foreach($warehouse_res as $row){
				$warehouse_info=array(
					'id'=>$row->id,
					'company_name'=>$row->company_name,
					'email'=>$row->email,
					'phone_no'=>$row->phone_no,
					'city'=>$row->city,
					'pin'=>$row->pin,
					'address'=>$row->address,
					'area'=>$row->area,
				);
			}				
		}
		
		//print_r($warehouse_info);exit;
		
		
		
		
		if(isset($metaData['Pages'])){
			if($metaData['Pages']>0){
				for($p=0;$metaData['Pages']>$p;$p++){
					$data = $pdf->getPages()[$p]->getDataTm();
					
					$start_product_row_id	= '';
					$remove_row_ids=[];
					$product_cat_ids=[];
					$product_size_ids=[];
					$product_inCases_ids=[];
					
					for($i=0; count($data)>$i; $i++){
						$th_head	= str_replace(' ','',$data[$i][1]);
						if($th_head==''){
							$remove_row_ids[]	= $i;
						}
					}
					
					for($i=0; count($remove_row_ids)>$i; $i++){
						unset($data[$remove_row_ids[$i]]);
					}
					
					$brand_liquor_data=[];
					foreach($data as $key=>$val){
						$index_val	= trim($val[1]);
						$brand_liquor_data[]=$index_val;
					}
					
					
					//echo '<pre>';print_r($brand_liquor_data);exit;
					
					
					for($i=0; count($brand_liquor_data)>$i; $i++){
						$th_head	= str_replace(' ','',$brand_liquor_data[$i]);
						if (preg_match('/\BrandName\b/', $th_head)) {
							$start_product_row_id	= ($i+23);
							break;
						}
					}
					
					//$th_head	= str_replace(' ','',$brand_liquor_data[$i]);
					
					
					for($i=$start_product_row_id; count($brand_liquor_data)>$i; $i++){
						$th_head	= str_replace(' ','',$brand_liquor_data[$i]);
						//echo '<pre>';print_r($th_head);exit;
						if($th_head=='IMFL'){
							$product_cat_ids[]	= $i;
						}
						if($th_head=='OSBI'){
							$product_cat_ids[]	= $i;
						}
						if($th_head=='CS'){
							$product_cat_ids[]	= $i;
						}
						if($th_head=='OS'){
							$product_cat_ids[]	= $i;
						}
						/*if (preg_match('/\OS\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						if (preg_match('/\Country Liquor\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						if (preg_match('/\OSBI\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}
						if (preg_match('/\CS\b/', $th_head)) {
							$product_cat_ids[]	= $i;
						}*/
					}
					
					//echo '<pre>';print_r($product_cat_ids);exit;
					
					for($i=$start_product_row_id; count($brand_liquor_data)>$i; $i++){
						$th_head	= $brand_liquor_data[$i];
						if (stripos($th_head, "Ml.") !== false) {
							$product_size_ids[]	= $i;
						}
					}
					
					//echo '<pre>';print_r($product_size_ids);exit;
					
					for($i=$start_product_row_id; count($brand_liquor_data)>$i; $i++){
						$th_head	= $brand_liquor_data[$i];
						
						for($n=0;100>$n;$n++){
							$match_in_case="- ".$n;
							if (stripos($th_head, $match_in_case) !== false) {
								if(!in_array($i, $product_inCases_ids)){
									$product_inCases_ids[]	= $i;
								}
							}
						}
						
						
						/*if (stripos($th_head, "- 1") !== false) {
							$product_inCases_ids[]	= $i;
						}
						if (stripos($th_head, "- 3") !== false) {
							$product_inCases_ids[]	= $i;
						}
						if (stripos($th_head, "- 7") !== false) {
							$product_inCases_ids[]	= $i;
						}
						if (stripos($th_head, "- 11") !== false) {
							$product_inCases_ids[]	= $i;
						}
						if (stripos($th_head, "- 41") !== false) {
							$product_inCases_ids[]	= $i;
						}*/
					}
					/*if(count($product_inCases_ids)>0){
						$product_inCases_ids = array_unique($product_inCases_ids);
						
						for()
					}*/
					
					//echo '<pre>';print_r($product_inCases_ids);exit;
					
					for($i=0; count($product_cat_ids)>$i; $i++){
						$index_1=$product_cat_ids[$i];
						$index_2=($index_1+1);
						$index_3=$product_size_ids[$i];
						$index_4=($product_inCases_ids[$i]+1);
						$index_5=($product_inCases_ids[$i]+2);
						$index_6=($product_inCases_ids[$i]+3);
						$index_7=($product_inCases_ids[$i]+4);
						
						$index_8=$product_size_ids[$i]+1;
						
						
						
						
						/*if($i==1){
							break;
						}*/
						
						//echo '<pre>';print_r($size_title);exit;
						
						$brand_name_length=($product_size_ids[$i]-$index_2);
						
						$brand_name='';
						for($j=1; $brand_name_length>$j; $j++){
							$p_index=$index_2+$j;
							$brand_name .= trim($brand_liquor_data[$p_index]).' ';
							$brand_name	= str_replace("[Pet Bottle]", "", $brand_name);
							$brand_name	= str_replace("[Can]", "", $brand_name);
						}
						if($brand_name!=''){
							$brand_name = rtrim($brand_name, " .");
						}
						
						//print_r($brand_name);exit;
						
						
						$category_title2='';
						if (stripos($brand_name, "Spirit") !== false) {
							$brand_name	= str_replace("Spirit", "", $brand_name);
							$category_title2='Spirit';
						}
						//print_r($brand_name);exit;
						//category_title
						
						//$brand_name_arr = explode('[',$brand_name);
						//$brand_name		= isset($brand_name_arr[0])?trim($brand_name_arr[0]):'';
						//echo str_replace("[Pet Bottle]", "", $brand_name);
						//echo '<pre>';print_r($brand_name);exit;
						
						$current_year=date('Y');
						
						$batch_no_length=($product_inCases_ids[$i]-1);
						
						if (stripos($brand_liquor_data[$batch_no_length], $current_year) !== false) {
							$batch_index_count=2;
						}else{
							$batch_index_count=3;
						}
						
						//$batch_index_count=2;
						
						$batch_length=($product_inCases_ids[$i]-$batch_index_count);
						
						$batch_no='';
						for($b=0; $batch_index_count>$b; $b++){
							$b_index=$batch_length+$b;
							$batch_no .= trim($brand_liquor_data[$b_index]).' ';
						}
						$brand_slug	= Media::create_slug(trim($brand_name));
						
						$in_cases_info	= trim($brand_liquor_data[$product_inCases_ids[$i]]);
						//echo $product_inCases_ids[$i].'</br>';
						$in_cases_arr	= explode('-',$in_cases_info);
						$total_cases	= isset($in_cases_arr[0])?trim($in_cases_arr[0]):0;
						$loose_qty		= isset($in_cases_arr[1])?trim($in_cases_arr[1]):0;
						//print_r($in_cases);exit;
						
						
						
						$category_title =trim($brand_liquor_data[$index_1]);
						$category_result=Category::where('name',$category_title)->get();
						$category_id=isset($category_result[0]->id)?$category_result[0]->id:0;
						
						
						if($category_title=='CS'){
							$strength_title=trim($brand_liquor_data[$index_8]);
							$strength_title=preg_replace('/[^0-9]/', '', $strength_title);
							
							$sub_category_title=trim($brand_liquor_data[$index_2].' '.$category_title2.' '.$strength_title);		
						}else{
							$sub_category_title=trim($brand_liquor_data[$index_2].' '.$category_title2);	
						}
						
						
							
						
						//print_r($sub_category_title);exit;
						$sub_category_result=Subcategory::where('name',$sub_category_title)->get();
						$subcategory_id=isset($sub_category_result[0]->id)?$sub_category_result[0]->id:0;
						//print_r($sub_category_result);exit;
						
						$size_title=trim($brand_liquor_data[$index_3]);
						/*$size_id=0;
						if($size_title!=''){
							$size_arr=explode(' ',$size_title);
							$size_result=Size::query()->where('name', 'LIKE', "%{$size_arr[0]}%")->get();
							$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
						}*/
						
						
						$size_id=0;
						if($size_title!=''){
							$size_arr=explode(' ',$size_title);
							$size_ml=isset($size_arr[0])?trim($size_arr[0]):'';
							if($size_ml!=''){
								$size_result=Size::where('ml',$size_arr[0])->get();
								$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
							}
						}
						
						
						
						$product_slug	= Media::create_slug(trim($brand_slug.' '.$category_title.' '.$sub_category_title.' '.$size_title.' '.$batch_no));
						if(!in_array($product_slug, $product_slugs)){
							$product_slugs[]=$product_slug;
							$item_result = Product::where('slug',$brand_slug)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->get();
							$product_id	 = isset($item_result[0]->id)?$item_result[0]->id:'';
							if($product_id!=''){
								
								$item_bottle_case_qty_nfo = MasterProducts::where('slug',$brand_slug)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->first();
								$item_bottle_case_qty=isset($item_bottle_case_qty_nfo->qty)?$item_bottle_case_qty_nfo->qty:'0';
								
								//echo 'slug='.$brand_slug.' category_id='.$category_id.' subcategory_id='.$subcategory_id.' product_id='.$product_id.'</br>';
								
								
								//echo 'slug='.$brand_slug.' category_id='.$category_id.' subcategory_id='.$subcategory_id.' product_id='.$product_id.'</br>';
								$item_size_result=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
								$strength	 		= isset($item_size_result[0]->strength)?$item_size_result[0]->strength:0;
								$retailer_margin	= isset($item_size_result[0]->retailer_margin)?$item_size_result[0]->retailer_margin:0;
								$round_off	 		= isset($item_size_result[0]->round_off)?$item_size_result[0]->round_off:0;
								$sp_fee	 			= isset($item_size_result[0]->special_purpose_fee)?$item_size_result[0]->special_purpose_fee:0;
								$product_mrp	 	= isset($item_size_result[0]->product_mrp)?$item_size_result[0]->product_mrp:0;
								
								$total_cost	= trim($brand_liquor_data[$index_7]);
								$total_qty	= trim($brand_liquor_data[$index_4]);
								$unit_mrp	= $total_cost/$total_qty;
								$in_cases	= $total_qty/$total_cases;
								
								if($in_cases!=''){
									$in_cases=round(trim($in_cases));
								}
								$rrs_amt			= $retailer_margin+$round_off+$sp_fee;
								$retail_item_val	= $product_mrp-$rrs_amt;
								$total_cost			= $retail_item_val*$total_qty;
								$unit_mrp			= $product_mrp-$retailer_margin;
								
								
								//echo $total_cases.'-'.$item_bottle_case_qty.'-'.$loose_qty;exit;
								
								//(($total_cases*$item_bottle_case_qty)+$loose_qty)
								
								
								
								
								
								
								$invoice_product_result[]=array(
									'product_id'		=> $product_id,
									'product_barcode'	=> $item_result[0]->product_barcode,
									'category'			=> $category_title,
									'category_id'		=> $category_id,
									'sub_category'		=> $sub_category_title,
									'subcategory_id'	=> $subcategory_id,
									'brand_name'		=> trim($brand_name),
									'brand_slug'		=> $brand_slug,	 
									'measure'			=> $size_title,
									'size_id'			=> $size_id,
									'batch_no'			=> trim($batch_no),
									'strength'			=> trim($strength),
									'retailer_margin'	=> trim($retailer_margin),
									'round_off'			=> trim($round_off),
									'sp_fee'			=> trim($sp_fee),
									'bottle_case'		=> $item_bottle_case_qty,
									'total_cases'		=> $total_cases,
									'loose_qty'			=> $loose_qty,
									'in_cases'			=> $in_cases,
									'qty'				=> (($total_cases*$item_bottle_case_qty)+$loose_qty),//trim($brand_liquor_data[$index_4]),
									'bl'				=> trim($brand_liquor_data[$index_5]),
									'lpl'				=> trim($brand_liquor_data[$index_6]),
									'product_mrp'		=> trim($product_mrp),
									'unit_cost'			=> trim($unit_mrp),
									'rrs_amt'			=> trim($rrs_amt),
									'retail_item_val'	=> trim($retail_item_val),
									'total_cost'		=> trim($total_cost)
								);
								
								
								//echo '<pre>';print_r($invoice_product_result);exit;
								
								
							}else{
								$product_slugs[]=$product_slug;
								$total_cost	= trim($brand_liquor_data[$index_7]);
								$total_qty	= trim($brand_liquor_data[$index_4]);
								$unit_mrp	= $total_cost/$total_qty;
								$in_cases	= $total_qty/$total_cases;
								
								$new_product_result[]=array(
									//'brand_slug'		=> $brand_slug,
									'category'			=> $category_title,
									'sub_category'		=> $sub_category_title,
									'brand_name'		=> trim($brand_name),	 
									'measure'			=> $size_title,
									'batch_no'			=> trim($batch_no),
									'strength'			=> '',
									'retailer_margin'	=> '',
									'round_off'			=> '',
									'sp_fee'			=> '',
									'total_cases'		=> $total_cases,
									'in_cases'			=> trim($in_cases),
									'qty'				=> trim($brand_liquor_data[$index_4]),
									'bl'				=> trim($brand_liquor_data[$index_5]),
									'lpl'				=> trim($brand_liquor_data[$index_6]),
									'product_mrp'		=> trim($unit_mrp),
									'unit_cost'			=> trim($unit_mrp),
									'total_cost'		=> trim($brand_liquor_data[$index_7])
								);
							}
						}
					}	
				}
			}
		}
		
		
		
		$gross_total_amount=0;
		$gross_sp_fee_amount=0;
		$gross_round_off_amount=0;
		if(count($invoice_product_result)>0){
			foreach($invoice_product_result as $row){
				$gross_total_amount+= $row['total_cost'];
				$gross_sp_fee_amount+= $row['sp_fee']*$row['qty'];
				$gross_round_off_amount+= $row['round_off']*$row['qty'];
			}
		}
		
		$tcs_amt = ($gross_total_amount / 100) * 1;
		$total_amount = ($gross_total_amount + $tcs_amt + $gross_sp_fee_amount + $gross_round_off_amount );
		
		
		/*echo '<pre>';
		print_r($gross_total_amount);
		print_r($product_slugs);
		print_r($invoice_product_result);
		print_r($new_product_result);
		exit;*/
		
		
		
		if(count($invoice_product_result)>0 || count($new_product_result)>0){
			
			$return_data['result']			= $invoice_product_result;
			
			$return_data['new_result']		= $new_product_result;
			$return_data['warehouse']		= $warehouse_info;
			$return_data['tp_no']			= $tp_no;
			$return_data['invoice_no']		= $invoice_no;
			$return_data['invoice_date']	= $invoice_date;
			$return_data['tcs_amt']			= $tcs_amt;
			
			$return_data['gross_total_amount']		= $gross_total_amount;
			$return_data['gross_sp_fee_amount']		= $gross_sp_fee_amount;
			$return_data['gross_round_off_amount']	= $gross_round_off_amount;
			$return_data['total_amount']			= round($total_amount);
			
			
			
			$return_data['success']	= 1;
		}else{
			$return_data['msg']		= 'This invoice is already uploaded!';
			$return_data['success']	= 0;
		}
		//echo '<pre>';print_r($return_data);exit;
		
		echo json_encode($return_data);
		
		//echo '<pre>';print_r($return_data);exit;		
	}
	
    public function pos_create(Request $request)
    {
		
        DB::beginTransaction();
        try {
            if ($request->isMethod('post')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'supplier_code' => 'required',
                    // 'supplier_invoice_date' => 'required|date',
                    'delivery_name' => 'required',
                    'address_line_1' => 'required',
                    'address_line_2' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'post_code' => 'required',
                    'order_date' => 'required|date',
                    'delivery_date' => 'required|date',
                    // 'discount' => 'required',
                    'product_price' => 'required|array|min:1',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $purchase = PurchaseOrder::create([
                    'supplier_id' => $request->supplier_code,
                    'supplier_ref' => $request->supplier_ref,
                    // 'supplier_invoice_date' => $request->supplier_invoice_date,
                    'delivery_name' => $request->delivery_name,
                    'address_one' => $request->address_line_1,
                    'address_two' => $request->address_line_2,
                    'city' => $request->city,
                    'state' => $request->state,
                    'post_code' => $request->post_code,
                    'order_date' => $request->order_date,
                    'delivery_date' => $request->delivery_date,
                    'delivery_charge' => $request->delivery_charge ?? 0,
                    // 'discount' => $request->discount,
                ]);
                $purchase_product = [];
                $sub_total = $request->delivery_charge ?? 0;
                foreach ($request->product_id as $key => $value) {
                    $purchase_product[$key] = [
                        'purchase_order_id' => $purchase->id,
                        'product_id' => $value,
                        'price' => $request->product_price[$key],
                        'qty' => $request->product_qty[$key],
                        'discount' => $request->product_discount[$key],
                        'tax_rate' => $request->product_purchase_tax_rate[$key],
                        'total' => $request->product_sub_total[$key],
                        'comments' => $request->product_comment[$key],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    $sub_total += $request->product_sub_total[$key];
                }

                // dd($supplier_product);
                PurchaseProduct::insert($purchase_product);
                PurchaseOrder::find($purchase->id)->update([
                    'sub_total' => $sub_total,
                    'order_no' =>  'PO-' . rand(1111111, 9999999) . $purchase->id,
                ]);
                DB::commit();
                return redirect()->route('admin.stock.purchase-order.edit', [base64_encode($purchase->id)])->with('success', 'Purchase order placed successfully');
            }
			
			
            $data = [];
			
			$branch_id=Session::get('branch_id');
			$stock_type	= Common::get_user_settings($where=['option_name'=>'stock_type'],$branch_id);
			
			$data['stock_type'] 	= isset($stock_type)?$stock_type:'w';
            $data['heading'] 		= 'Add Order';
            $data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
            $data['supplier'] 		= Supplier::all();
            $data['product'] 		= Product::all();
			
            return view('admin.purchase_order.pos', compact('data'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	public function create_order(Request $request)
    {
		
        DB::beginTransaction();
        try {
            $data = [];
			$spplier_code='bevco-17';
			
            $data['heading'] 		= 'Purchase Order';
            $data['breadcrumb'] 	= ['Purchase Order', 'Add'];
            $data['supplier'] 		= Supplier::where('sup_code',$spplier_code)->first();
            $data['product'] 		= Product::all();
			
			//echo '<pre>';print_r($data['supplier']->company_name);exit;
			
			
            return view('admin.purchase_order.add', compact('data'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }

	//added by palash
	public function updateInwardStock(Request $request,$inward_stock_id){
		//echo $inward_stock_id;die;
		DB::beginTransaction();
        try {
			$data = [];
			$spplier_code='bevco-17';
			
            $data['heading'] 		= 'Purchase Order';
            $data['breadcrumb'] 	= ['Purchase Order', 'Edit'];
            $data['supplier'] 		= Supplier::where('sup_code',$spplier_code)->first();
            $data['product'] 		= Product::all();
            $data['inward_stock_id'] = $inward_stock_id;
            $data['inward_stock_type'] = 'edit';
			
            return view('admin.purchase_order.add', compact('data'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
	}

	public function ajaxPurchaseById(Request $request){

		//dd($request->all());
		$purchase_inward_stock = PurchaseInwardStock::where('id',base64_decode($request->id))->first();
		/* $return_data['tp_no']			= $purchase_inward_stock->tp_no;
        $return_data['invoice_no']		= $purchase_inward_stock->invoice_no;
        $return_data['invoice_date']	= date('Y-m-d',strtotime($purchase_inward_stock->purchase_date));
        $return_data['purchase_date']	= date('Y-m-d',strtotime($purchase_inward_stock->purchase_date));
        $return_data['payment_method']	= $purchase_inward_stock->payment_method;
        $return_data['payment_date']	= $purchase_inward_stock->payment_date;
        $return_data['invoice_stock']	= $purchase_inward_stock->invoice_stock; */
		$return_data['inward_date']	= date('Y-m-d',strtotime($purchase_inward_stock->inward_date));
        $return_data['purchase_date']	= date('Y-m-d',strtotime($purchase_inward_stock->purchase_date));
        $return_data['invoice_stock_type']	= $purchase_inward_stock->invoice_stock_type;

        $return_data['purchase_inward_stock']	= $purchase_inward_stock;
		
		$return_data['warehouse']		= $purchase_inward_stock->warehouse;
		//$return_data['stock_products']	= $invoice_product_result;
		$invoice_product_result = [];
		if(count($purchase_inward_stock->inwardStockProducts)>0){
			foreach($purchase_inward_stock->inwardStockProducts as $inwardStockProducts){
				$invoice_product_result[]=[
					'product_id'		=> $inwardStockProducts->product_id,
					'product_barcode'	=> $inwardStockProducts->product->product_barcode,
					'category'			=> $inwardStockProducts->product->category->name,
					'category_id'		=> $inwardStockProducts->product->category->id,
					'sub_category'		=> $inwardStockProducts->product->subcategory->name,
					'subcategory_id'	=> $inwardStockProducts->product->subcategory->id,
					'brand_name'		=> $inwardStockProducts->product->brand->name,
					'brand_slug'		=> $inwardStockProducts->product->brand->slug,	 
					'measure'			=> $inwardStockProducts->size->name,
					'size_id'			=> $inwardStockProducts->size_id,
					'batch_no'			=> $inwardStockProducts->batch_no,
					'strength'			=> $inwardStockProducts->strength,
					'retailer_margin'	=> $inwardStockProducts->retailer_margin,
					'round_off'			=> $inwardStockProducts->round_off,
					'sp_fee'			=> $inwardStockProducts->sp_fee,
					'bottle_case'		=> $inwardStockProducts->bottle_case,
					'total_cases'		=> $inwardStockProducts->case_qty,
					'loose_qty'			=> $inwardStockProducts->loose_qty,
					'in_cases'			=> '',
					'qty'				=> $inwardStockProducts->product_qty,
					'bl'				=> $inwardStockProducts->bl,
					'lpl'				=> $inwardStockProducts->lpl,
					'product_mrp'		=> $inwardStockProducts->product_mrp,
					'unit_cost'			=> '',
					'total_cost'		=> $inwardStockProducts->total_cost,
				];
			}
		}

		$return_data['stock_products']	= $invoice_product_result;
        $return_data['success']	= 1;
		//return response()->json(['status'=>true,'massage'=>'User details saved Successfully']);
		echo json_encode($return_data);
	}

	public function deleteInwardStock(Request $request,$id){
		try {
            $id = base64_decode($id);
			$inward_stock_result 	= PurchaseInwardStock::where('id',$id)->first();
			$inward_stock_products 	= InwardStockProducts::where('inward_stock_id',$id)->get();
			$branch_id = Session::get('branch_id');
			
			$invoice_stock_type=isset($inward_stock_result->invoice_stock_type)?$inward_stock_result->invoice_stock_type:'warehouse';
			
			//echo '<pre>';print_r($inward_stock_products);exit;
			
			if(count($inward_stock_products) > 0){
				
				foreach($inward_stock_products as $product){
					$branch_stock_product = BranchStockProducts::where('product_id',$product->product_id)->where('size_id',$product->size_id)->where('branch_id',$branch_id)->first();
					$stock_id=isset($branch_stock_product->id)?$branch_stock_product->id:'';
					if($stock_id!=''){
						$branch_stock_product_sell_price = BranchStockProductSellPrice::where('stock_id',$branch_stock_product->id)->first();
						
						if($branch_stock_product_sell_price){
							if($invoice_stock_type=='warehouse'){
								$branch_stock_product_sell_price->w_qty = $branch_stock_product_sell_price->w_qty - $product->product_qty;
							}else{
								$branch_stock_product_sell_price->c_qty = $branch_stock_product_sell_price->c_qty - $product->product_qty;
							}
							
							$branch_stock_product_sell_price->updated_at = Carbon::now();
							$branch_stock_product_sell_price->save();
						}		
					}	
				}
			}
			
            InwardStockProducts::where('inward_stock_id',$id)->delete();
			PurchaseInwardStock::find($id)->delete();
            return redirect()->back()->with('success', 'Purchase Order deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
	}

	public function pdfBrandRegister(){
			$data = [];
			$pdf = PDF::loadView('admin.pdf.brand-register', $data,[], 
			[ 
				'format' => [250, 580],
				//'format' => 'A4-L',
			  	'orientation' => 'L'
			]);
			return $pdf->stream('brand-register.pdf');
	}
	public function pdfMonthwiseReport(){
			$data = [];
			$pdf = PDF::loadView('admin.pdf.monthwise-report', $data);
			return $pdf->stream('monthwise-report.pdf');
	}
	public function pdfItemWiseSalesReport(){
			$data = [];
			$pdf = PDF::loadView('admin.pdf.item-wise-sales-report', $data);
			return $pdf->stream('item-wise-sales-report.pdf');
	}
	public function pdfEReport(){
			$data = [];
			$pdf = PDF::loadView('admin.pdf.e-report', $data);
			return $pdf->stream('e-report.pdf');
	}

	public function todaySalesProductDownload(){
		$sales_products = SellStockProducts::whereDate('created_at', Carbon::today())->get();
        $content = "";
        foreach ($sales_products as $product) {
        $content .= '01/2007/0003|'.date('d-m-Y h:i', strtotime($product->created_at)).'|'.$product->barcode .'|'.substr($product->size->name,0,-4).'|'.$product->product_mrp.'|'.$product->product_qty;
        $content .= "\n";
        }

        // file name that will be used in the download
        $fileName = now()."SELL.txt";

        // use headers in order to generate the download
        $headers = [
        'Content-type' => 'text/plain', 
        'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        //'Content-Length' => sizeof($content)
        ];

        // make a response, with the content, a 200 response code and the headers
        return Response::make($content, 200, $headers);
	}
	//Stock Tranfer
	public function stockTranfer(Request $request){
		//$this->daily_stock_transfer_sell_history();exit;
		//dd($request->all());\
		try{
			if ($request->isMethod('post')) {
				$prev_w_qty		= $request->prev_w_qty;
				$prev_c_qty		= $request->prev_c_qty;
				$new_w_qty		= $request->w_qty;
				$new_c_qty		= $request->c_qty;
				$stock_id		= $request->stock_id;
				$price_id		= $request->price_id;
				$transfer_to	= $request->transfer_to;
				$counter_id		= $request->counter_id;
				
				$branch_id=Session::get('branch_id');
				
				$branchStockProductResult=BranchStockProducts::where('id',$stock_id)->first();
				$size_ml=isset($branchStockProductResult->size->ml)?$branchStockProductResult->size->ml:0;
				
				$product_id=isset($branchStockProductResult->product_id)?$branchStockProductResult->product_id:0;
				$size_id=isset($branchStockProductResult->size_id)?$branchStockProductResult->size_id:0;
				
				$category_id=isset($branchStockProductResult->product->category_id)?$branchStockProductResult->product->category_id:0;
				$subcategory_id=isset($branchStockProductResult->product->subcategory_id)?$branchStockProductResult->product->subcategory_id:0;
				
				
				
				
				
				
				$total_c_qty=0;
				if($prev_c_qty>0){
					$total_c_qty +=$prev_c_qty;
				}
				
				$trans_c_qty=0;
				
				if(count($new_c_qty)>0){
					for($i=0;count($new_c_qty)>$i;$i++){
						$c_qty=isset($new_c_qty[$i])?$new_c_qty[$i]:'';
						if($c_qty!=''){
							$total_c_qty +=$c_qty;
							$trans_c_qty +=$c_qty;
						}
					}
				}
				
				BranchStockProductSellPrice::where('id', $price_id)->where('stock_id', $stock_id)->where('stock_type', 'counter')->update(['w_qty' => $new_w_qty,'c_qty' => $total_c_qty]);
				
				$branch_id=Session::get('branch_id');
				
				$invoice_no='';
				$n=StockTransferHistory::where('branch_id',$branch_id)->count();
				$invoice_no .=date('d');
				$invoice_no .='/'.date('Y');
				$invoice_no .='/'.str_pad($n + 1, 4, 0, STR_PAD_LEFT);
				$invoice_no .='|'.date('d/m/Y');
				
				$total_ml=$size_ml*$trans_c_qty;
				
				$stocktransferData=array(
					'invoice_no'	=> $invoice_no,
					'stock_id'		=> $stock_id,
					'branch_id'		=> $branch_id,
					'price_id'  	=> $price_id,
					'prev_w_qty'  	=> $prev_w_qty,
					'category_id'	=> $category_id,
					'subcategory_id'=> $subcategory_id,
					'product_id'  	=> $product_id,
					'size_id'  		=> $size_id,
					'prev_c_qty'	=> $prev_c_qty,
					'new_w_qty'  	=> $new_w_qty,
					'new_c_qty'  	=> $total_c_qty,
					'transfer_to'  	=> $transfer_to,
					'c_qty'  		=> $trans_c_qty,
					'total_ml'  	=> $total_ml,
					
					
				);
				
				//print_r($stocktransferData);exit;
				
				$stockTransferHistory=StockTransferHistory::create($stocktransferData);
				$stock_transfer_id	= $stockTransferHistory->id;
				
				//$stock_transfer_id=1;
				
				
				
				if(count($counter_id)>0){
					for($i=0;count($counter_id)>$i;$i++){
						$c_qty=isset($new_c_qty[$i])?$new_c_qty[$i]:'';
						if($c_qty!=''){
							$stocktransferData=array(
								'stock_transfer_id'	=> $stock_transfer_id,
								'counter_id'  		=> $counter_id[$i],
								'qty'  				=> $c_qty,
							);
							StockTransferCounterHistory::create($stocktransferData);
							
							
							$branch_product_counter_stock_info=CounterWiseStock::where('stock_id',$stock_id)->where('counter_id',$counter_id[$i])->where('stock_type','counter')->get();
							$product_counter_id=isset($branch_product_counter_stock_info[0]->id)?$branch_product_counter_stock_info[0]->id:'';
							
							$counter_c_qty=$c_qty;
							$total_ml=$size_ml*$counter_c_qty;
							
							
							if($product_counter_id!=''){
								$product_total_ml=0;
								$product_total_ml +=isset($branch_product_counter_stock_info[0]->total_ml)?$branch_product_counter_stock_info[0]->total_ml:0;
								$product_total_ml +=$total_ml;
								
								$product_total_qty=0;
								$product_total_qty +=isset($branch_product_counter_stock_info[0]->c_qty)?$branch_product_counter_stock_info[0]->c_qty:0;
								$product_total_qty +=$counter_c_qty;
								CounterWiseStock::where('id', $product_counter_id)->update(['c_qty' => $product_total_qty,'total_ml' => $product_total_ml]);
							}else{
								$counterWiseStockData=array(
									'stock_id'		=> $stock_id,
									'counter_id'  	=> $counter_id[$i],
									'c_qty'  		=> $counter_c_qty,
									'total_ml'		=> $total_ml,
									'stock_type'  	=> 'counter'
								);
								CounterWiseStock::create($counterWiseStockData);
							}
						}
					}
				}
				
				$this->daily_stock_transfer_sell_history();
				
				$return_data['status']	= 1;
				echo json_encode($return_data);exit;
			}
			
			
			
			$branch_id		= Session::get('branch_id');
			//echo $branch_id;die;
			$stock_product = BranchStockProducts::where('branch_id',$branch_id)->where('stock_type','counter');
			
			if(!empty($request->get('product_id'))){
				$stock_product->where('product_id', $request->get('product_id'));
			}
				
			$stock_product=$stock_product->paginate(20);
			$data = [];
			$data['heading'] 		= 'Stock Tranfer';
            $data['breadcrumb'] 	= ['Stock Tranfer', 'List'];
			$data['stock_product'] 	= $stock_product;
			
			$data['counter'] = Counter::where('branch_id',$branch_id)->get();
			
			//dd($data);
			return view('admin.stock_transfer.list', compact('data'));				
		} catch (\Exception $e) {
			echo $e;die;
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
	}
	
	
	public function daily_stock_transfer_sell_history(){
		$branch_id				= Session::get('branch_id');
		$sell_date_result 	= StockTransferHistory::where('branch_id',$branch_id)->where('is_new','Y')->orderBy('id', 'asc')->first();
		$start_date			= isset($sell_date_result->created_at)?date('Y-m-d',strtotime($sell_date_result->created_at)):'';
		
		if($start_date!=''){
			$current_date=date('Y-m-d');
			$diff 		= strtotime($current_date) - strtotime($start_date);
			$total_day	= round($diff / 86400);
			
			for($i=0;$total_day>=$i;$i++){
				$sell_date	= date('Y-m-d', strtotime("+".$i." day", strtotime($start_date)));
				//echo $sell_date.'</br>';exit;
				
				$category_result 		= StockTransferHistory::select('category_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
				$sub_category_result 	= StockTransferHistory::select('subcategory_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
				$size_result 			= StockTransferHistory::select('size_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->distinct()->where('is_new','Y')->get();
				$product_result 		= StockTransferHistory::select('product_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
				//echo '<pre>';print_r($product_result);exit;
				
				foreach($category_result as $cat_row){
					$category_id=$cat_row->category_id;
					foreach($sub_category_result as $sub_cat_row){
						$subcategory_id=$sub_cat_row->subcategory_id;
						foreach($size_result as $size_row){
							$size_id=$size_row->size_id;
							foreach($product_result as $product_row){
								$product_id=$product_row->product_id;
								//echo $category_id.'-'.$subcategory_id.'-'.$size_id.'-'.$product_id;exit;
								
								$dateWise_sell_result = StockTransferHistory::selectRaw('sum(total_ml) as total_ml,sum(c_qty) as total_qty,price_id,stock_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->where('is_new','Y')->get();
								$total_total_qty = isset($dateWise_sell_result[0]->total_qty)?$dateWise_sell_result[0]->total_qty:'0';
								$product_mrp = isset($dateWise_sell_result[0]->price->selling_price)?$dateWise_sell_result[0]->price->selling_price:'0';
								$product_barcode = isset($dateWise_sell_result[0]->stock_info->product_barcode)?$dateWise_sell_result[0]->stock_info->product_barcode:'0';
								
								//echo '<pre>';print_r($total_total_qty);exit;
								
								if($total_total_qty>0){
									$openingStockProductResult = OpeningStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
									$start_opening_stock_ml	= isset($openingStockProductResult->total_ml)?$openingStockProductResult->total_ml:'0';
									$start_opening_stock	= isset($openingStockProductResult->product_qty)?$openingStockProductResult->product_qty:'0';
									
									$purchase_history_result 	= DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
									
									$purchase_stock_ml = isset($purchase_history_result->closing_stock_ml)?$purchase_history_result->closing_stock_ml:'0';
									$purchase_stock	   = isset($purchase_history_result->closing_stock)?$purchase_history_result->closing_stock:'0';
									
									$gross_opening_stock_ml	= $start_opening_stock_ml+$purchase_stock_ml;
									$gross_opening_stock	= $start_opening_stock+$purchase_stock;
									
									
									$prev_sell_date		= date('Y-m-d', strtotime("-1 day", strtotime($sell_date)));
									
									$prev_datewise_sell_result = DailyStockTransferHistory::whereBetween('created_at', [$prev_sell_date." 00:00:00", $prev_sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
									$prev_closing_stock	  =isset($prev_datewise_sell_result->closing_stock)?$prev_datewise_sell_result->closing_stock:'';
									$prev_closing_stock_ml=isset($prev_datewise_sell_result->closing_stock_ml)?$prev_datewise_sell_result->closing_stock_ml:'';
								
									$prev_opening_stock	  =isset($prev_datewise_sell_result->opening_stock)?$prev_datewise_sell_result->opening_stock:'';
									$prev_opening_stock_ml=isset($prev_datewise_sell_result->opening_stock_ml)?$prev_datewise_sell_result->opening_stock_ml:'';
									
									$opening_stock_ml	= $gross_opening_stock_ml;
									$opening_stock 		= $gross_opening_stock;
									
									$total_datewise_sell_count = DailyStockTransferHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->count();
									
									
									
									if($prev_closing_stock_ml!=''){
										if($total_datewise_sell_count>=1){
											$today_purchase_history_result 	= DailyStockTransferHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
										
										$today_purchase_stock_ml	= isset($today_purchase_history_result->total_ml)?$today_purchase_history_result->total_ml:'0';
										$today_purchase_stock		= isset($today_purchase_history_result->total_qty)?$today_purchase_history_result->total_qty:'0';
										$opening_stock_ml 			= $prev_closing_stock_ml+$today_purchase_stock_ml;
										$opening_stock 				= $prev_closing_stock+$today_purchase_stock;	
									}	
								}
								
								
								
								
								
								$total_sell		= isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
								$total_qty_sell	= isset($dateWise_sell_result[0]->total_qty)?$dateWise_sell_result[0]->total_qty:'0';
								
								$closing_stock_ml	= $opening_stock_ml-$total_sell;
								$closing_stock		= $opening_stock-$total_qty_sell;
								
								$date_wise_total_sell_ml	= $total_sell;
								$date_wise_total_sell_qty	= $total_qty_sell;
								
								
								//echo '<pre>';print_r($date_wise_total_sell_ml);exit;
								
								$check_datewise_sell_result = DailyStockTransferHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$check_sell_id		  = isset($check_datewise_sell_result->id)?$check_datewise_sell_result->id:'';
								
								$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
								$strength_no =isset($productRelationshipSizeResult[0]->strength)?$productRelationshipSizeResult[0]->strength:'';
								
								$strength=$strength_no;
								if($strength_no==''){
									$strength=0;
								}
								
								//echo '<pre>';print_r($strength);exit;
								
								if($check_sell_id!=''){
									//echo '<pre>';print_r($date_wise_total_sell_ml);exit;
									$total_qty	= $date_wise_total_sell_qty+$check_datewise_sell_result->total_qty;
									$total_ml	= $date_wise_total_sell_ml+$check_datewise_sell_result->total_ml;
									
									$closing_stock		= $opening_stock-$total_qty;
									$closing_stock_ml	= $opening_stock_ml-$total_ml;
									
									//print_r($closing_stock_ml);exit;
									
									
									
									DailyStockTransferHistory::where('id',$check_sell_id)->update(['total_ml' => $total_ml,'total_qty' => $total_qty,'opening_stock' => $opening_stock,'closing_stock' => $closing_stock,'opening_stock_ml' => $opening_stock_ml,'closing_stock_ml' => $closing_stock_ml,'strength' => $strength]);
									
									StockTransferHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
									
								}else{
									$size_cost_data=array(
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_barcode'	=> $product_barcode,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_ml'  		=> $total_sell,
										'total_qty'  		=> $total_qty_sell,
										'opening_stock'  	=> $opening_stock,
										'closing_stock'  	=> $closing_stock,
										'opening_stock_ml'  => $opening_stock_ml,
										'closing_stock_ml' 	=> $closing_stock_ml,
										'product_mrp'		=> $product_mrp,
										'strength'			=> $strength,
										'created_at' 		=> $sell_date." ".date('H:i:s'),
										'updated_at' 		=> $sell_date." ".date('H:i:s'),
									);
									
									//echo '<pre>';print_r($size_cost_data);exit;
									DailyStockTransferHistory::create($size_cost_data);
									StockTransferHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
								}
							}
						}
					}
				}
			}	
		}
	}
}
	
	public function product_stock_upload(Request $request){
		$file = $request->file('product_upload_file');
		if($file){
			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$tempPath = $file->getRealPath();
			$fileSize = $file->getSize();
			
			if($extension!='csv'){
				return redirect()->back()->with('error', 'Something error occurs!');
			}
			$location = 'uploads';
			$file->move($location, $filename);
			$filepath = public_path($location . "/" . $filename);
			
			$file = fopen($filepath, "r");
			$importData_arr = array();
			$i = 0;
			while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
				$num = count($filedata);
				if ($i == 0) {
					$i++;
					continue;
				}
				for ($c = 0; $c < $num; $c++) {
					$importData_arr[$i][] = $filedata[$c];
				}
				$i++;
			} 
			
			
			//echo '<pre>';print_r($importData_arr);exit;
			
			$j = 0;
			$brand_data=[];
			foreach ($importData_arr as $importData) {
				$category				= $importData[0];
				$type 					= $importData[1];
				$brand_name 			= $importData[2];
				$size 					= $importData[3];
				$opening_stock 			= $importData[4];
				
				if($category!=''){
					$brand_slug 	= $this->create_slug($brand_name);
					
					$category_title=trim($category);
					$category_result=Category::where('name',$category_title)->where('food_type',1)->get();
					if(count($category_result)>0){
						$category_id=isset($category_result[0]->id)?$category_result[0]->id:0;
					}else{
						$feature_data=array(
							'name'  		=> $category_title,
							'food_type'  	=> 1,
							'created_at'	=> date('Y-m-d')
						);
						$feature=Category::create($feature_data);
						$category_id=$feature->id;
					}
					
					
					$type_result=Subcategory::where('name',$type)->where('food_type',1)->get();
					if(count($type_result)>0){
						$subcategory_id=isset($type_result[0]->id)?$type_result[0]->id:0;
					}else{
						$feature_data=array(
							'name'  		=> $type,
							'food_type'  	=> 1,
							'created_at'	=> date('Y-m-d')
						);
						$feature=Subcategory::create($feature_data);
						$subcategory_id=$feature->id;
					}
					
					$size_id=0;
					$size_ml=0;
					if($size!=''){
						$size_arr=explode(' ',$size);
						$size_ml=isset($size_arr[0])?trim($size_arr[0]):0;
						
						$size_result=Size::where('ml',$size_ml)->get();
						
						if(count($size_result)>0){
							$size_id=isset($size_result[0]->id)?$size_result[0]->id:0;
							$size_ml=isset($size_result[0]->ml)?$size_result[0]->ml:0;
						}else{
							$size_arr=explode(' ',$size);
							$feature_data=array(
								'name'  		=> $size,
								'ml'  			=> isset($size_arr[0])?trim($size_arr[0]):0,
								'created_at'	=> date('Y-m-d')
							);
							$feature=Size::create($feature_data);
							$size_id=$feature->id;
						}
					}
					
					if($size_id!=0){
						$product_result=Product::where('slug',$brand_slug)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->get();
						
						if(count($product_result)>0){
							$product_id=$product_result[0]->id;
							
							$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
							$product_mrp=isset($productRelationshipSizeResult[0]->cost_rate)?$productRelationshipSizeResult[0]->cost_rate:'';
							
							$barcode=isset($productRelationshipSizeResult[0]->product_barcode)?$productRelationshipSizeResult[0]->product_barcode:'';
							$barcode2=isset($productRelationshipSizeResult[0]->barcode2)?$productRelationshipSizeResult[0]->barcode2:'';
							$barcode3=isset($productRelationshipSizeResult[0]->barcode3)?$productRelationshipSizeResult[0]->barcode3:'';
							
							$product_barcode='';
							if($barcode!=''){
								$product_barcode=$barcode;
							}
							if($barcode2!=''){
								$product_barcode=$barcode2;
							}
							if($barcode3!=''){
								$product_barcode=$barcode3;
							}
							
							$branch_id=Session::get('branch_id');
							
							$branch_product_stock_info=OpeningStockProducts::where('branch_id',$branch_id)->where('product_id',$product_id)->where('size_id',$size_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->get();
							
							$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
							$strength_no =isset($productRelationshipSizeResult[0]->strength)?$productRelationshipSizeResult[0]->strength:'';
							
							$strength=$strength_no;
							if($strength_no==''){
								$strength=0;
							}
							
							
							if(count($branch_product_stock_info)>0){
								$total_ml=0;
								$opening_stock_qty=0;
								if($opening_stock!=''){
									$total_ml=$size_ml*$opening_stock;
									$opening_stock_qty=$opening_stock;
								}
								
								
								OpeningStockProducts::where('branch_id', $branch_id)->where('product_id', $product_id)->where('size_id', $size_id)->update(['total_ml' => $total_ml,'product_qty' => $opening_stock_qty,'strength' => $strength]);
							}else{
								$total_ml=0;
								$opening_stock_qty=0;
								if($opening_stock!=''){
									$total_ml=$size_ml*$opening_stock;
									$opening_stock_qty=$opening_stock;
								}
								
								$stockData=array(
									'branch_id'			=> $branch_id,
									'category_id'		=> $category_id,
									'subcategory_id'	=> $subcategory_id,
									'product_barcode'	=> $product_barcode,
									'product_id'		=> $product_id,
									'size_id'			=> $size_id,
									'size_ml'  			=> $size_ml,
									'total_ml'  		=> $total_ml,
									'product_qty'		=> $opening_stock_qty,
									'product_mrp'  		=> $product_mrp,
									'strength'			=> $strength
								);
								OpeningStockProducts::create($stockData);	
							}
							
						}	
					}	
				}
			$j++;}
			
			//echo '<pre>';print_r($brand_data);exit;
		}
		
		return redirect()->back()->with('success', 'Opening Stock updated successfully');
		
	}
	
	public function setOpeningStock_old(Request $request){
		try{
			$branch_id		= Session::get('branch_id');
			//echo $branch_id;die;
			$stock_product = OpeningStockProducts::where('branch_id',$branch_id);
			
			if(!empty($request->get('product_id'))){
				$stock_product->where('product_id', $request->get('product_id'));
			}
				
			$stock_product=$stock_product->paginate(20);
			$data = [];
			$data['heading'] 		= 'Opening Stock';
            $data['breadcrumb'] 	= ['Opening Stock', 'List'];
			$data['stock_product'] 	= $stock_product;
			
			//echo '<pre>';print_r($data);exit;
			
			
			
			
			
			//$data['counter'] = Counter::where('branch_id',$branch_id)->get();
			
			
			
			
			
			
			
			//dd($data);
			return view('admin.stock_transfer.opening_stock', compact('data'));				
		} catch (\Exception $e) {
			echo $e;die;
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
	}
	
	public function setOpeningStock(Request $request){
		try{
			$branch_id		= Session::get('branch_id');
			//echo $branch_id;die;
			$stock_product = OpeningStockProducts::where('branch_id',$branch_id);
			
			if(!empty($request->get('product_id'))){
				$stock_product->where('product_id', $request->get('product_id'));
			}
				
			$stock_product=$stock_product->paginate(20);
			$data = [];
			$data['heading'] 		= 'Opening Stock';
            $data['breadcrumb'] 	= ['Opening Stock', 'List'];
			$data['stock_product'] 	= $stock_product;
			
			//echo '<pre>';print_r($data);exit;
			
			
			
			
			
			//$data['counter'] = Counter::where('branch_id',$branch_id)->get();
			
			
			
			
			
			
			
			//dd($data);
			return view('admin.stock_transfer.opening_stock', compact('data'));				
		} catch (\Exception $e) {
			echo $e;die;
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
	}
	
	public function create_slug($string){
		$replace = '-';
	   	$string = strtolower($string);
	   //replace / and . with white space
	   	$string = preg_replace("/[\/\.]/", " ", $string);
	   	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

	   //remove multiple dashes or whitespaces
	   	$string = preg_replace("/[\s-]+/", " ", $string);
	   
	   //convert whitespaces and underscore to $replace
	  	 $string = preg_replace("/[\s_]/", $replace, $string);

	   //limit the slug size
	  	 $string = substr($string, 0, 100);
	   
	   //slug is generated
	  	 return $string;
	  }
}
