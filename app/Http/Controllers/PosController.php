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
use App\Models\User;

use App\Models\Warehouse;
use App\Models\TableBookingHistory;
use App\Models\RestaurantFloor;
use App\Models\FloorWiseTable;
use App\Models\Waiter;
use App\Models\TableBookingKoPrintInvoice;
use App\Models\TableBookingKoPrintItems;

use App\Models\BarInwardStock;
use App\Models\BarInwardStockProducts;

use App\Models\SellInwardOnlinePayment;

use App\Models\DailyProductSellHistory;
use App\Models\OpeningStockProducts;
use App\Models\DailyProductPurchaseHistory;

use Carbon\Carbon;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Session;

require_once '../mpdf/vendor/autoload.php';

class PosController extends Controller
{
	
	public function print_invoice_old(){
		
		$lastSellInwardStock=SellInwardStock::orderBy('id','DESC')->take(1)->get();
		$invoice_url='';
		if(count($lastSellInwardStock)>0){
			 $data=[];
			 
			 $invoice_no=isset($lastSellInwardStock[0]->invoice_no)?$lastSellInwardStock[0]->invoice_no:'';
			 $invoice_date=isset($lastSellInwardStock[0]->sell_date)?$lastSellInwardStock[0]->sell_date:'';
			 $invoice_time=isset($lastSellInwardStock[0]->sell_time)? date('h:i a',strtotime($lastSellInwardStock[0]->sell_time)):'';
			 $bill_no=isset($lastSellInwardStock[0]->bill_no)? $lastSellInwardStock[0]->bill_no:'';
			 
			 
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
			 
			 //echo '<pre>';print_r($sellStockProducts);exit;
			 
			 
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
				'bill_no'		=> $bill_no,
				'invoice_date'	=> $invoice_date,
				'invoice_time'	=> $invoice_time,
				'gstin'			=> '',
				'place'			=> 'West Bengal',
				'branch'		=> 'K.P.Shaw Bottling Pvt.Ltd.',
				'cashier_name'	=> 'Mrs Roy Suchandra',
			];
			$data['items']=[];
			
			if(count($sellStockProducts)>0){
				foreach($sellStockProducts as $row){
					$product_name=strtolower($row->product_name);
					$data['items'][] = array(
						'product_name'	=> ucfirst($product_name),
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
			
			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML((string)view('admin.pdf.invoice', $data));
			//$mpdf->Output();
			//exit;
			
			$invoice_no=Common::create_slug($invoice_no);
			
			$mpdf->Output('uploads/off_counter/'.$invoice_no.'-invoice.pdf', 'F');
			
			$invoice_url=asset('uploads/off_counter/'.$invoice_no.'-invoice.pdf?v='.time());
			$return_data['invoice_url']	= $invoice_url;
			$return_data['success']	= 1;
		}else{
			$return_data['success']	= 0;
		}
		
		echo json_encode($return_data);
		
		/*
		$return_data['invoice_url']	= $invoice_url;
		echo json_encode($return_data);*/
		
		
    }
	
	public function print_invoice(){
		
		$branch_id 			= Session::get('branch_id');
		$lastSellInwardStock=SellInwardStock::where('branch_id',$branch_id)->orderBy('id','DESC')->take(1)->get();
		$invoice_url='';
		if(count($lastSellInwardStock)>0){
			 $data=[];
			 
			 $invoice_no=isset($lastSellInwardStock[0]->invoice_no)?$lastSellInwardStock[0]->invoice_no:'';
			 $invoice_date=isset($lastSellInwardStock[0]->sell_date)?$lastSellInwardStock[0]->sell_date:'';
			 $invoice_time=isset($lastSellInwardStock[0]->sell_time)? date('h:i a',strtotime($lastSellInwardStock[0]->sell_time)):'';
			 $bill_no=isset($lastSellInwardStock[0]->bill_no)? $lastSellInwardStock[0]->bill_no:'';
			 $branch_id=isset($lastSellInwardStock[0]->branch_id)? $lastSellInwardStock[0]->branch_id:'';
			 $payment_method=isset($lastSellInwardStock[0]->payment_method)?$lastSellInwardStock[0]->payment_method:'Cash';
			 
			 
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
			 
			 //echo '<pre>';print_r($sellStockProducts);exit;
			 
			 
			 
			 $company_name		= Common::get_user_settings($where=['option_name'=>'company_name'],$branch_id);
			 $company_address	= Common::get_user_settings($where=['option_name'=>'company_address'],$branch_id);
			 $address2			= Common::get_user_settings($where=['option_name'=>'company_address2'],$branch_id);
			 $phone				= Common::get_user_settings($where=['option_name'=>'phone'],$branch_id);
			 
			 $supplier_id	= Session::get('adminId');
			 $supplier		= User::find($supplier_id);
			 $supplier_name = $supplier->name;
			 
			 
			
			
			 
			 
			 $data['shop_details'] = [
				'name' 		=> $company_name,
				'address1'	=> $company_address,
				'address2' 	=> $address2,
				'phone'		=> $phone,
			];
			
			$data['customer_details'] = [
				'name'		=> '',
            	'mobile'	=> '',
            	'address'	=> '',
        	];
			
			$data['invoice_details'] = [
				'invoice_no'	=> $invoice_no,
				'bill_no'		=> $bill_no,
				'invoice_date'	=> $invoice_date,
				'invoice_time'	=> $invoice_time,
				'gstin'			=> '',
				'place'			=> 'West Bengal',
				'branch'		=> $company_address,
				'cashier_name'	=> $supplier_name,
			];
			
			$data['items']=[];
			
			if(count($sellStockProducts)>0){
				foreach($sellStockProducts as $row){
					$product_name=strtolower($row->product_name);
					$data['items'][] = array(
						'product_name'	=> ucfirst($product_name),
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
			$data['total_amt_in_word']		= ucwords(Media::getIndianCurrency($pay_amount));
			$data['total_discount_amount']	= number_format($total_discount_amount,2);
			$data['payment_method'] 		= 'Cash';
			
			
			
			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML((string)view('admin.pdf.invoice', $data));
			//$mpdf->Output();
			//exit;
			
			$bill_no=Common::create_slug($bill_no.' '.$branch_id.' '.$invoice_no);
			
			$mpdf->Output('uploads/off_counter/'.$bill_no.'-invoice.pdf', 'F');
			
			//$invoice_url=asset('uploads/off_counter/'.$invoice_no.'-invoice.pdf?v='.time());
			//$return_data['invoice_url']	= $invoice_url;
			//$return_data['success']	= 1;
		}else{
			//$return_data['success']	= 0;
		}
		
		//echo json_encode($return_data);
		
		/*
		$return_data['invoice_url']	= $invoice_url;
		echo json_encode($return_data);*/
		
		
    }
	
	
    public function pos_create(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = [];
			
			$branch_id=Session::get('branch_id');
			$stock_type	= Common::get_user_settings($where=['option_name'=>'stock_type'],$branch_id);
			
			$data['stock_type'] 	= isset($stock_type)?$stock_type:'w';
            $data['heading'] 		= 'Add Order';
            $data['breadcrumb'] 	= ['Stock', 'Purchase Order', 'Add'];
            $data['supplier'] 		= Supplier::all();
            $data['product'] 		= Product::all();
			
			
			
			
			/*$data['purchase_product_result']	= BranchStockProducts::select('master_products.id as product_id','products.slug','products.product_name','products.product_name')
				->leftJoin('products', function($join) {
					$join->on('branch_stock_products.product_id', '=', 'products.id');
				})
				->leftJoin('master_products', function($join) {
					$join->on('products.slug', '=', 'master_products.slug');
				})
				->where('branch_stock_products.branch_id',$branch_id)
				->where('branch_stock_products.stock_type','counter')
				->groupby('product_id')
				->orderby('branch_stock_products.id','DESC')
				->offset(0)->limit(20)
				->get()
				->toArray();
				
				
			echo '<pre>';print_r($data['purchase_product_result']);exit;	*/
			
			
			$data['top_selling_product_result']=[];
			
			$selling_product_result	= SellStockProducts::select('products.slug','products.product_name','products.product_name','sell_stock_products.size_id','sell_stock_products.subcategory_id')->leftJoin('sell_inward_stock', function($join) {
				$join->on('sell_stock_products.inward_stock_id', '=', 'sell_inward_stock.id');
				})
				->leftJoin('products', function($join) {
					$join->on('sell_stock_products.product_id', '=', 'products.id');
				})
				->where('sell_inward_stock.branch_id',$branch_id)
				->groupby('product_id')
				->orderby('sell_stock_products.id','DESC')
				->offset(0)->limit(10)
				->get()
				->toArray();
			//$top_selling_product_ids=[];
			
			foreach($selling_product_result as $row){
				$product_result=MasterProducts::where('slug',$row['slug'])->where('subcategory_id',$row['subcategory_id'])->where('size_id',$row['size_id'])->first();
				//print_r($product_result);exit;
				$product_size=isset($product_result->size->name)?$product_result->size->name:'';
				$data['top_selling_product_result'][]=array(
					'product_id'	=> isset($product_result->id)?$product_result->id:'',
					'product_name'	=> isset($product_result->product_name)?$product_result->product_name:'',
					'product_size'	=> $product_size,
				);
			}
			
			
			$lastSellInwardStock=SellInwardStock::orderBy('id','DESC')->take(1)->get();
			$invoice_url='';
			$bill_no='';
			$pay_amount=0;
			if(count($lastSellInwardStock)>0){
				$invoice_no=isset($lastSellInwardStock[0]->invoice_no)?$lastSellInwardStock[0]->invoice_no:'';
				$bill_no=isset($lastSellInwardStock[0]->bill_no)? $lastSellInwardStock[0]->bill_no:'';
				$branch_id=isset($lastSellInwardStock[0]->branch_id)? $lastSellInwardStock[0]->branch_id:'';
				$pay_amount=isset($lastSellInwardStock[0]->pay_amount)? $lastSellInwardStock[0]->pay_amount:'';
				
				
				$pdf_no=Common::create_slug($bill_no.' '.$branch_id.' '.$invoice_no);
				$invoice_url=asset('uploads/off_counter/'.$pdf_no.'-invoice.pdf?v='.time());
				
			}
			
			$data['last_bill_no']		= $bill_no;
			$data['last_bill_amount']	= $pay_amount;
			$data['invoice_url']		= $invoice_url;
			
			
			$supplier_id	= Session::get('adminId');
			
			$data['supplier']=User::find($supplier_id);
			
			//print_r($data['supplier']->name);exit;
			
			
			
			
			//echo '<pre>';print_r($data['top_selling_product_result']);exit;
			
			//print_r($invoice_url);exit;
			
            return view('admin.counter_pos.pos', compact('data'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try later. ' . $e->getMessage());
        }
    }
	
	public function create(Request $request){
		
		$branch_id		= Session::get('branch_id');
		$supplier_id	= Session::get('adminId');
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
		$n=SellInwardStock::where('branch_id',$branch_id)->count();
		$invoice_no .=date('d');
		$invoice_no .='/'.date('Y');
		$invoice_no .='/'.str_pad($n + 1, 4, 0, STR_PAD_LEFT);
		$invoice_no .='|'.date('d/m/Y');
		
		$bill_no=str_pad($n + 1, 5, 0, STR_PAD_LEFT);
		
		
		$product_barcode=str_pad($n + 1, 5, 0, STR_PAD_LEFT);
		
		$payment_method=$request->payment_method_type;
		
		$sellStockData=array(
			'branch_id' 				=> $branch_id,
			'supplier_id' 				=> $supplier_id,
			'customer_id' 				=> $customer_id,
			'bill_no' 					=> $bill_no,
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
		
		//$result=SellInwardOnlinePayment::get();
		//$arr=json_decode($result[0]->meta_data,true);	
		//print_r($arr['upi_payble_amount']);exit;
		
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
				
				$size_ml=trim(str_replace('ml', '', $size));
				$total_ml=(int)$size_ml*(int)$qty;
				
				$sellStockproductData=array(
					'inward_stock_id'	=> $sellStockId,
					'product_id'  		=> $product_id,
					'branch_id'  		=> $branch_id,
					'product_stock_id'  => $product_stock_id,
					'barcode'			=> $barcode,
					'product_name'  	=> $name,
					'price_id'  		=> $price_id,
					'size_id'  			=> $product_size_id,
					'category_id'  		=> $category_id,
					'subcategory_id'  	=> $subcategory_id,
					'size_ml'  			=> $size,
					'total_ml'  		=> $total_ml,
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
		
		
		
		if($payment_method=='cash'){
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
		}else{
			$sell_online_payment_data=array(
				'sell_inward_stock_id'	=> $sellStockId,
				'type'  				=> $payment_method,
				'meta_data'  			=> json_encode($request->online_payment),
				'created_at'			=> date('Y-m-d')
			);
			SellInwardOnlinePayment::create($sell_online_payment_data);
			//print_r($sell_online_payment_data);exit;
		}
		
		$this->daily_product_sell_history();
		
		$this->print_invoice();
		
		
		$return_data['success']	= 1;
		echo json_encode($return_data);
		
		
	}
	public function daily_product_sell_history(){
		$branch_id=Session::get('branch_id');
		$sell_date=date('Y-m-d');
		$total_product_sell_count = SellStockProducts::selectRaw('id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('is_new','Y')->count();
		//echo '<pre>';print_r($total_product_sell_count);exit;
		if($total_product_sell_count>0){
			$category_result 		= SellStockProducts::select('category_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$sub_category_result 	= SellStockProducts::select('subcategory_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$size_result 			= SellStockProducts::select('size_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$product_result 		= SellStockProducts::select('product_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->distinct()->where('is_new','Y')->get();
			
			//echo '<pre>';print_r($product_result);exit;
			
			
			
			foreach($category_result as $cat_row){
				$category_id=$cat_row->category_id;
				foreach($sub_category_result as $sub_cat_row){
					$subcategory_id=$sub_cat_row->subcategory_id;
					foreach($size_result as $size_row){
						$size_id=$size_row->size_id;
						foreach($product_result as $product_row){
							$product_id=$product_row->product_id;
							
							$dateWise_sell_result = SellStockProducts::selectRaw('sum(total_ml) as total_ml,sum(product_qty) as total_qty,barcode,product_mrp')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->where('is_new','Y')->get();
							
							//echo '<pre>';print_r($dateWise_sell_result);exit;
							
							$total_sell_ml = isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
							if($total_sell_ml>0){
								
								$openingStockProductResult 	= OpeningStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$start_opening_stock_ml		= isset($openingStockProductResult->total_ml)?$openingStockProductResult->total_ml:'0';
								$start_opening_stock		= isset($openingStockProductResult->product_qty)?$openingStockProductResult->product_qty:'0';
									
								$purchase_history_result 	= DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								
								//echo '<pre>';print_r($purchase_history_result);exit;
									
								$purchase_stock_ml = isset($purchase_history_result->closing_stock_ml)?$purchase_history_result->closing_stock_ml:'0';
								$purchase_stock	   = isset($purchase_history_result->closing_stock)?$purchase_history_result->closing_stock:'0';
									
								$gross_opening_stock_ml	= $start_opening_stock_ml+$purchase_stock_ml;
								$gross_opening_stock	= $start_opening_stock+$purchase_stock;
								
								//echo '<pre>';print_r($gross_opening_stock_ml);exit;
								
								$prev_sell_date		= date('Y-m-d', strtotime("-1 day", strtotime($sell_date)));
								
								//$prev_sell_date		= $sell_date;
								
								//echo '<pre>';print_r($prev_sell_date);exit;
									
								$prev_datewise_sell_result = DailyProductSellHistory::whereBetween('created_at', [$prev_sell_date." 00:00:00", $prev_sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								$prev_closing_stock	  = isset($prev_datewise_sell_result->closing_stock)?$prev_datewise_sell_result->closing_stock:'';
								$prev_closing_stock_ml= isset($prev_datewise_sell_result->closing_stock_ml)?$prev_datewise_sell_result->closing_stock_ml:'';
								
								$prev_opening_stock	  = isset($prev_datewise_sell_result->opening_stock)?$prev_datewise_sell_result->opening_stock:'';
								$prev_opening_stock_ml= isset($prev_datewise_sell_result->opening_stock_ml)?$prev_datewise_sell_result->opening_stock_ml:'';
								
								//echo '<pre>';print_r($prev_datewise_sell_result);exit;
								
								$opening_stock_ml	= $gross_opening_stock_ml;
								$opening_stock 		= $gross_opening_stock;
								
								
								$total_datewise_sell_count = DailyProductSellHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->count();
								
								//echo '<pre>';print_r($total_datewise_sell_count);exit;
									
								if($prev_closing_stock_ml!=''){
									if($total_datewise_sell_count>=1){
										
										$today_purchase_history_result 	= DailyProductPurchaseHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
										
										$today_purchase_stock_ml	= isset($today_purchase_history_result->total_ml)?$today_purchase_history_result->total_ml:'0';
										$today_purchase_stock		= isset($today_purchase_history_result->total_qty)?$today_purchase_history_result->total_qty:'0';
										
										//$current_opening_stock_ml	=(($purchase_stock_ml-$prev_opening_stock_ml)+$start_opening_stock_ml);
										$opening_stock_ml 			= $prev_closing_stock_ml+$today_purchase_stock_ml;
										$opening_stock 				= $prev_closing_stock+$today_purchase_stock;
										
										
										//echo '<pre>';print_r($opening_stock);exit;
										
										
										
										//$current_opening_stock_ml	=(($purchase_stock_ml-$prev_opening_stock_ml)+$start_opening_stock_ml);
										//$opening_stock_ml 			= $prev_closing_stock_ml+$current_opening_stock_ml;
										
										//echo '<pre>';print_r($opening_stock_ml);exit;
										//$opening_stock_ml 	= $prev_closing_stock_ml;
										
										//$current_opening_stock	=(($purchase_stock-$prev_opening_stock)+$start_opening_stock);
										
										
										//$opening_stock 		= $prev_closing_stock;
									}	
								}
								
								//echo '<pre>';print_r($opening_stock_ml);exit;
								
								$barcode		= isset($dateWise_sell_result[0]->barcode)?$dateWise_sell_result[0]->barcode:'0';
								$product_mrp	= isset($dateWise_sell_result[0]->product_mrp)?$dateWise_sell_result[0]->product_mrp:'0';
								$total_sell		= isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
								$total_qty_sell	= isset($dateWise_sell_result[0]->total_qty)?$dateWise_sell_result[0]->total_qty:'0';
								
								$closing_stock_ml	= $opening_stock_ml-$total_sell;
								$closing_stock		= $opening_stock-$total_qty_sell;
								
								$date_wise_total_sell_ml	= $total_sell;
								$date_wise_total_sell_qty	= $total_qty_sell;
								
								
								
								$inwardStockProducts = InwardStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								$inward_stock_id=isset($inwardStockProducts->id)?$inwardStockProducts->id:'';
								if($inward_stock_id!=''){
									PurchaseInwardStock::where('id',$inward_stock_id)->update(['is_sell' => 'Y']);
								}
								
								//echo '<pre>';print_r($inward_stock_id);exit;
								
								$check_datewise_sell_result = DailyProductSellHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$check_sell_id		  = isset($check_datewise_sell_result->id)?$check_datewise_sell_result->id:'';
								
								$productRelationshipSizeResult=ProductRelationshipSize::where('product_id',$product_id)->where('size_id',$size_id)->get();
								$strength_no =isset($productRelationshipSizeResult[0]->strength)?$productRelationshipSizeResult[0]->strength:'';
								$strength=$strength_no;
								if($strength_no==''){
									$strength=0;
								}
								
								
								
								if($check_sell_id!=''){
									$total_qty	= $date_wise_total_sell_qty+$check_datewise_sell_result->total_qty;
									$total_ml	= $date_wise_total_sell_ml+$check_datewise_sell_result->total_ml;
									
									$closing_stock		= $opening_stock-$total_qty;
									$closing_stock_ml	= $opening_stock_ml-$total_ml;
									
									//echo '<pre>';print_r($closing_stock_ml);exit;
									
									
									
									DailyProductSellHistory::where('id',$check_sell_id)->update(['total_ml' => $total_ml,'total_qty' => $total_qty,'opening_stock' => $opening_stock,'closing_stock' => $closing_stock,'opening_stock_ml' => $opening_stock_ml,'closing_stock_ml' => $closing_stock_ml,'strength' => $strength]);
									
									SellStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
									
									//echo '<pre>';print_r($total_ml);exit;
								}else{
									$size_cost_data=array(
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_barcode'	=> $barcode,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_ml'  		=> $total_sell,
										'total_qty'  		=> $total_qty_sell,
										'opening_stock'  	=> $opening_stock,
										'closing_stock'  	=> $closing_stock,
										'opening_stock_ml'  => $opening_stock_ml,
										'closing_stock_ml' 	=> $closing_stock_ml,
										'product_mrp'		=> $product_mrp,
										'strength'			=> $strength
									);
									//echo '<pre>';print_r($size_cost_data);exit;
									DailyProductSellHistory::create($size_cost_data);
									SellStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
								}
							}
						}	
					}
				}
			}
		}else{
		}
	}
	
	public function daily_product_sell_history_2(){
		$branch_id=Session::get('branch_id');
		$sell_date=date('Y-m-d');
		$total_product_sell_count = SellStockProducts::selectRaw('id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('is_new','Y')->count();
		//echo '<pre>';print_r($total_product_sell_count);exit;
		if($total_product_sell_count>0){
			$category_result 		= SellStockProducts::select('category_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$sub_category_result 	= SellStockProducts::select('subcategory_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$size_result 			= SellStockProducts::select('size_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$product_result 		= SellStockProducts::select('product_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->distinct()->where('is_new','Y')->get();
			
			//echo '<pre>';print_r($product_result);exit;
			
			
			
			foreach($category_result as $cat_row){
				$category_id=$cat_row->category_id;
				foreach($sub_category_result as $sub_cat_row){
					$subcategory_id=$sub_cat_row->subcategory_id;
					foreach($size_result as $size_row){
						$size_id=$size_row->size_id;
						foreach($product_result as $product_row){
							$product_id=$product_row->product_id;
							
							$dateWise_sell_result = SellStockProducts::selectRaw('sum(total_ml) as total_ml,sum(product_qty) as total_qty,barcode,product_mrp')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->where('is_new','Y')->get();
							
							//echo '<pre>';print_r($dateWise_sell_result);exit;
							
							$total_sell_ml = isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
							if($total_sell_ml>0){
								
								$openingStockProductResult 	= OpeningStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$start_opening_stock_ml		= isset($openingStockProductResult->total_ml)?$openingStockProductResult->total_ml:'0';
								$start_opening_stock		= isset($openingStockProductResult->product_qty)?$openingStockProductResult->product_qty:'0';
									
								$purchase_history_result 	= DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								
								//echo '<pre>';print_r($purchase_history_result);exit;
									
								$purchase_stock_ml = isset($purchase_history_result->closing_stock_ml)?$purchase_history_result->closing_stock_ml:'0';
								$purchase_stock	   = isset($purchase_history_result->closing_stock)?$purchase_history_result->closing_stock:'0';
									
								$gross_opening_stock_ml	= $start_opening_stock_ml+$purchase_stock_ml;
								$gross_opening_stock	= $start_opening_stock+$purchase_stock;
								
								//echo '<pre>';print_r($gross_opening_stock_ml);exit;
								
								$prev_sell_date		= date('Y-m-d', strtotime("-1 day", strtotime($sell_date)));
								
								//echo '<pre>';print_r($prev_sell_date);exit;
									
								$prev_datewise_sell_result = DailyProductSellHistory::whereBetween('created_at', [$prev_sell_date." 00:00:00", $prev_sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								$prev_closing_stock	  = isset($prev_datewise_sell_result->closing_stock)?$prev_datewise_sell_result->closing_stock:'';
								$prev_closing_stock_ml= isset($prev_datewise_sell_result->closing_stock_ml)?$prev_datewise_sell_result->closing_stock_ml:'';
								
								$prev_opening_stock	  = isset($prev_datewise_sell_result->opening_stock)?$prev_datewise_sell_result->opening_stock:'';
								$prev_opening_stock_ml= isset($prev_datewise_sell_result->opening_stock_ml)?$prev_datewise_sell_result->opening_stock_ml:'';
								
								//echo '<pre>';print_r($prev_datewise_sell_result);exit;
								
								$opening_stock_ml	= $gross_opening_stock_ml;
								$opening_stock 		= $gross_opening_stock;
								
								
								$total_datewise_sell_count = DailyProductSellHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->count();
								
								//echo '<pre>';print_r($total_datewise_sell_count);exit;
									
								if($prev_closing_stock_ml!=''){
									if($total_datewise_sell_count>=1){
										//$origina
										
										$current_opening_stock_ml	=(($purchase_stock_ml-$prev_opening_stock_ml)+$start_opening_stock_ml);
										$opening_stock_ml 			= $prev_closing_stock_ml+$current_opening_stock_ml;
										//$opening_stock_ml 	= $prev_closing_stock_ml;
										
										$current_opening_stock	=(($purchase_stock-$prev_opening_stock)+$start_opening_stock);
										$opening_stock 			= $prev_closing_stock+$current_opening_stock;
										
										//$opening_stock 		= $prev_closing_stock;
									}	
								}
								
								//echo '<pre>';print_r($prev_opening_stock_ml);exit;
								
								$barcode		= isset($dateWise_sell_result[0]->barcode)?$dateWise_sell_result[0]->barcode:'0';
								$product_mrp	= isset($dateWise_sell_result[0]->product_mrp)?$dateWise_sell_result[0]->product_mrp:'0';
								$total_sell		= isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
								$total_qty_sell	= isset($dateWise_sell_result[0]->total_qty)?$dateWise_sell_result[0]->total_qty:'0';
								
								$closing_stock_ml	= $opening_stock_ml-$total_sell;
								$closing_stock		= $opening_stock-$total_qty_sell;
								
								$date_wise_total_sell_ml	= $total_sell;
								$date_wise_total_sell_qty	= $total_qty_sell;
								
								
								
								$inwardStockProducts = InwardStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								$inward_stock_id=isset($inwardStockProducts->inward_stock_id)?$inwardStockProducts->inward_stock_id:'';
								if($inward_stock_id!=''){
									PurchaseInwardStock::where('id',$inward_stock_id)->update(['is_sell' => 'Y']);
								}
								
								//echo '<pre>';print_r($inward_stock_id);exit;
								
								$check_datewise_sell_result = DailyProductSellHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$check_sell_id		  = isset($check_datewise_sell_result->id)?$check_datewise_sell_result->id:'';
								
								if($check_sell_id!=''){
									$total_qty	= $date_wise_total_sell_qty+$check_datewise_sell_result->total_qty;
									$total_ml	= $date_wise_total_sell_ml+$check_datewise_sell_result->total_ml;
									
									$closing_stock		= $opening_stock-$total_qty;
									$closing_stock_ml	= $opening_stock_ml-$total_ml;
									
									//echo '<pre>';print_r($opening_stock_ml);exit;
									
									
									
									DailyProductSellHistory::where('id',$check_sell_id)->update(['total_ml' => $total_ml,'total_qty' => $total_qty,'opening_stock' => $opening_stock,'closing_stock' => $closing_stock,'opening_stock_ml' => $opening_stock_ml,'closing_stock_ml' => $closing_stock_ml]);
									
									SellStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
									
									//echo '<pre>';print_r($total_ml);exit;
								}else{
									$size_cost_data=array(
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_barcode'	=> $barcode,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_ml'  		=> $total_sell,
										'total_qty'  		=> $total_qty_sell,
										'opening_stock'  	=> $opening_stock,
										'closing_stock'  	=> $closing_stock,
										'opening_stock_ml'  => $opening_stock_ml,
										'closing_stock_ml' 	=> $closing_stock_ml,
										'product_mrp'		=> $product_mrp
									);
									//echo '<pre>';print_r($size_cost_data);exit;
									DailyProductSellHistory::create($size_cost_data);
									SellStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
								}
							}
						}	
					}
				}
			}
		}else{
		}
	}
	
	public function daily_product_sell_history_1(){
		$branch_id=Session::get('branch_id');
		$sell_date=date('Y-m-d');
		$total_product_sell_count = SellStockProducts::selectRaw('id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('is_new','Y')->count();
		//echo '<pre>';print_r($total_product_sell_count);exit;
		if($total_product_sell_count>0){
			$category_result 		= SellStockProducts::select('category_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$sub_category_result 	= SellStockProducts::select('subcategory_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$size_result 			= SellStockProducts::select('size_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('is_new','Y')->distinct()->get();
			$product_result 		= SellStockProducts::select('product_id')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->distinct()->where('is_new','Y')->get();
			
			//echo '<pre>';print_r($product_result);exit;
			
			
			
			foreach($category_result as $cat_row){
				$category_id=$cat_row->category_id;
				foreach($sub_category_result as $sub_cat_row){
					$subcategory_id=$sub_cat_row->subcategory_id;
					foreach($size_result as $size_row){
						$size_id=$size_row->size_id;
						foreach($product_result as $product_row){
							$product_id=$product_row->product_id;
							
							$dateWise_sell_result = SellStockProducts::selectRaw('sum(total_ml) as total_ml,sum(product_qty) as total_qty,barcode,product_mrp')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->where('is_new','Y')->get();
							
							//echo '<pre>';print_r($dateWise_sell_result);exit;
							
							$total_sell_ml = isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
							if($total_sell_ml>0){
								
								$openingStockProductResult 	= OpeningStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$start_opening_stock_ml		= isset($openingStockProductResult->total_ml)?$openingStockProductResult->total_ml:'0';
								$start_opening_stock		= isset($openingStockProductResult->product_qty)?$openingStockProductResult->product_qty:'0';
									
								$purchase_history_result 	= DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								
								//echo '<pre>';print_r($purchase_history_result);exit;
									
								$purchase_stock_ml = isset($purchase_history_result->closing_stock_ml)?$purchase_history_result->closing_stock_ml:'0';
								$purchase_stock	   = isset($purchase_history_result->closing_stock)?$purchase_history_result->closing_stock:'0';
									
								$gross_opening_stock_ml	= $start_opening_stock_ml+$purchase_stock_ml;
								$gross_opening_stock	= $start_opening_stock+$purchase_stock;
								
								//echo '<pre>';print_r($start_opening_stock);exit;
									
								$prev_datewise_sell_result = DailyProductSellHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
								$prev_closing_stock	  = isset($prev_datewise_sell_result->closing_stock)?$prev_datewise_sell_result->closing_stock:'';
								$prev_closing_stock_ml= isset($prev_datewise_sell_result->closing_stock_ml)?$prev_datewise_sell_result->closing_stock_ml:'';
								
								//echo '<pre>';print_r($prev_datewise_sell_result);exit;
								
								$opening_stock_ml	= $gross_opening_stock_ml;
								$opening_stock 		= $gross_opening_stock;
								
								
								$total_datewise_sell_count = DailyProductSellHistory::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->count();
									
								if($prev_closing_stock_ml!=''){
									if($total_datewise_sell_count>=1){
										$opening_stock_ml 	= $prev_closing_stock_ml;
										$opening_stock 		= $prev_closing_stock;
									}	
								}
								
								$barcode		= isset($dateWise_sell_result[0]->barcode)?$dateWise_sell_result[0]->barcode:'0';
								$product_mrp	= isset($dateWise_sell_result[0]->product_mrp)?$dateWise_sell_result[0]->product_mrp:'0';
								$total_sell		= isset($dateWise_sell_result[0]->total_ml)?$dateWise_sell_result[0]->total_ml:'0';
								$total_qty_sell	= isset($dateWise_sell_result[0]->total_qty)?$dateWise_sell_result[0]->total_qty:'0';
								
								$closing_stock_ml	= $opening_stock_ml-$total_sell;
								$closing_stock		= $opening_stock-$total_qty_sell;
								
								$date_wise_total_sell_ml	= $total_sell;
								$date_wise_total_sell_qty	= $total_qty_sell;
								
								//echo '<pre>';print_r($closing_stock_ml);exit;
								
								$check_datewise_sell_result = DailyProductSellHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
								$check_sell_id		  = isset($check_datewise_sell_result->id)?$check_datewise_sell_result->id:'';
								
								if($check_sell_id!=''){
									$total_qty	= $date_wise_total_sell_qty+$check_datewise_sell_result->total_qty;
									$total_ml	= $date_wise_total_sell_ml+$check_datewise_sell_result->total_ml;
									
									$closing_stock=$check_datewise_sell_result->closing_stock-$date_wise_total_sell_qty;
									$closing_stock_ml=$check_datewise_sell_result->opening_stock_ml-$total_ml;
									
									DailyProductSellHistory::where('id',$check_sell_id)->update(['total_ml' => $total_ml,'total_qty' => $total_qty,'opening_stock' => $opening_stock,'closing_stock' => $closing_stock,'opening_stock_ml' => $opening_stock_ml,'closing_stock_ml' => $closing_stock_ml]);
									
									SellStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
									
									//echo '<pre>';print_r($total_ml);exit;
								}else{
									$size_cost_data=array(
										'branch_id'  		=> $branch_id,
										'category_id'		=> $category_id,
										'subcategory_id'	=> $subcategory_id,
										'product_barcode'	=> $barcode,
										'product_id'  		=> $product_id,
										'size_id'  			=> $size_id,
										'total_ml'  		=> $total_sell,
										'total_qty'  		=> $total_qty_sell,
										'opening_stock'  	=> $opening_stock,
										'closing_stock'  	=> $closing_stock,
										'opening_stock_ml'  => $opening_stock_ml,
										'closing_stock_ml' 	=> $closing_stock_ml,
										'product_mrp'		=> $product_mrp
									);
									//echo '<pre>';print_r($size_cost_data);exit;
									DailyProductSellHistory::create($size_cost_data);
									SellStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);
								}
							}
						}	
					}
				}
			}
		}else{
		}
	}	
}
