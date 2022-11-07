<?php 
namespace App\Http\Controllers;

use App\Mail\PurchaseOrderSupplier;
use App\Models\Product;
use App\Models\ProductSupplier;
use App\Models\PurchaseOrder;
use App\Models\PurchaseProduct;
use App\Models\Supplier;
use App\Models\PurchaseInwardStock;
use App\Models\InwardStockProducts;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Helper\Media;
use App\Models\BranchStockProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\SellInwardStock;
use App\Models\SellStockProducts;
use App\Models\Size;
use App\Models\Subcategory;

use App\Models\Counter;
use App\Models\StockTransferHistory;
use App\Models\StockTransferCounterHistory;
use App\Models\CounterWiseStock;
use App\Models\DailyProductSellHistory;
use App\Models\OpeningStockProducts;
use App\Models\DailyProductPurchaseHistory;

use App\Models\DailyStockTransferHistory;
use App\Models\ProductRelationshipSize;
use App\Models\Warehouse;

use App\Models\StoreSalesInvoice;
use App\Models\StoreSalesProducts;



use Carbon\Carbon;
Use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Str;


class CronController extends Controller {
	
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
	public function upload_store_sell_product(Request $request){
		if ($request->isMethod('post')) {
			$branch_id		= $request->branch_id;
			$file_name		= $request->file_name;
			$licensee_id_no	= $request->licensee_id_no;
			$datetime_stamp	= $request->datetime_stamp;
			$product_data	= $request->product_data;
			$file_name_slug		= $this->create_slug($file_name);
			
			$datearr=explode(' ',$datetime_stamp);
			$sell_date=isset($datearr[0])?$datearr[0]:'';
			if($sell_date!=''){
				$sell_date_arr=explode('/',$sell_date);
				$sell_date=date('Y-m-d',strtotime($sell_date_arr[2].'-'.$sell_date_arr[1].'-'.$sell_date_arr[0]));
			}
			
			$invoice_result=StoreSalesInvoice::where('file_name_slug',$file_name_slug)->where('branch_id',$branch_id)->where('date',$sell_date)->first();
			$invoice_id=isset($invoice_result->id)?$invoice_result->id:'';
			if($invoice_id!=''){
				$total_qty=count($product_data);
				//StoreSalesInvoice::where('id',$invoice_id)->update(['total_qty' => $total_qty]);
			}else{
				$invoice_no='';
				$n=StoreSalesInvoice::where('branch_id',$branch_id)->count();
				$invoice_no .=date('d');
				$invoice_no .='/'.date('Y');
				$invoice_no .='/'.str_pad($n + 1, 4, 0, STR_PAD_LEFT);
				$invoice_no .='|'.date('d/m/Y');
				
				$bill_no=str_pad($n + 1, 5, 0, STR_PAD_LEFT);
				
				$total_qty=count($product_data);
				$total_amount=0;
				
				$store_sales_invoice_data=array(
					'branch_id'  		=> $branch_id,
					'file_name'  		=> $file_name,
					'file_name_slug'	=> $file_name_slug,
					'licensee_id'		=> $licensee_id_no,
					'bill_no'			=> $bill_no,
					'invoice_no'		=> $invoice_no,
					'total_qty'  		=> $total_qty,
					'total_amount'  	=> $total_amount,
					'date'				=> $sell_date,
				);
				//echo '<pre>';print_r($store_sales_invoice_data);exit;
				$sellStockInvoice=StoreSalesInvoice::create($store_sales_invoice_data);
				$invoice_id=$sellStockInvoice->id;
			}
			
			if(count($product_data)>0){
				foreach($product_data as $row){
					$licensee_id_no=$row['Licensee_Id_No'];
					$datetime_stamp=$row['Datetime_Stamp'];
					$barcode=$row['GTIN'];
					$pack_size=$row['Pack_Size'];
					$mrp=$row['MRP'];
					$quantity=$row['Quantity'];
					
					$branchStockProducts=BranchStockProducts::where('product_barcode',$barcode)->where('stock_type','counter')->first();
					$product_id=isset($branchStockProducts->product_id)?$branchStockProducts->product_id:0;
					
					$sizeInfo=Size::where('ml',$pack_size)->first();
					$size_id=isset($sizeInfo->id)?$sizeInfo->id:0;
					
					$product_stock_result=StoreSalesProducts::where('store_sales_invoice_id',$invoice_id)->where('barcode',$barcode)->first();
					$product_stock_id=isset($product_stock_result->id)?$product_stock_result->id:'';
					
					if($product_stock_id!=''){
						StoreSalesProducts::where('id',$product_stock_id)->update(['product_qty' => $quantity,'product_mrp' => $mrp,'product_size' => $pack_size,'size_id' => $size_id]);
					}else{
						$store_sales_data=array(
							'store_sales_invoice_id'  	=> $invoice_id,
							'branch_id'  				=> $branch_id,
							'barcode'					=> $barcode,
							'product_qty'				=> $quantity,
							'product_mrp'				=> $mrp,
							'product_size'				=> $pack_size,
							'datetime_stamp'  			=> $datetime_stamp,
							'product_id'  				=> $product_id,
							'size_id'					=> $size_id
						);
						//echo '<pre>';print_r($store_sales_data);exit;
						StoreSalesProducts::create($store_sales_data);
					}
				}
			}
		}
		
		echo 'success';exit;
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function daily_product_sell_history($branch_id){
		$start_date='2022-10-21';
		$first_day_this_month = date('Y-m-01',strtotime($start_date));
		$last_day_this_month  = date('Y-m-t',strtotime($start_date));
		
		$product_id  = '11';
		$product_info = Product::select('product_name')->where('id',$product_id)->first();
		
		if($product_id!=''){
			$dateS	= date('Y-m-d',strtotime($first_day_this_month));
			$dateE	= date('Y-m-d',strtotime($last_day_this_month));
			
			$diff	= strtotime($dateE) - strtotime($dateS);
			$total_day	= round($diff / 86400);
			
			$product_size_result = ProductRelationshipSize::select('size_id')->where('product_id',$product_id)->distinct()->get();
			
			//echo '<pre>';print_r($product_size_result);exit;
			
			$result=[];
			
			for($i=0;$total_day>=$i;$i++){
				$sell_date = date('Y-m-d', strtotime("+".$i." day", strtotime($dateS)));
				$sell_date_slug = date('Ymd', strtotime("+".$i." day", strtotime($dateS)));
				$currentdayslug	= date('Ymd', strtotime("+1 day"));
				
				if($sell_date_slug==$currentdayslug){
					break;
				}
				
				
				$stock_result=[];
				foreach($product_size_result as $size_row){
					$size_id=$size_row->size_id;
					
					$datewise_sell_result = DailyStockTransferHistory::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
					
					
					//$openingStockProductResultTillDate = OpeningStockProducts::whereBetween('created_at', [$dateS." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
					//$start_opening_stock_tillDate	= isset($openingStockProductResult->product_qty)?$openingStockProductResult->product_qty:'0';
					
					$openingStockProductResult = OpeningStockProducts::whereBetween('created_at', [$dateS." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->first();
					
					//$start_opening_stock_ml	= isset($openingStockProductResult->total_ml)?$openingStockProductResult->total_ml:'0';
					$start_opening_stock	= isset($openingStockProductResult->product_qty)?$openingStockProductResult->product_qty:'0';
					
					
					
					$opening_stock	= isset($datewise_sell_result->opening_stock)?$datewise_sell_result->opening_stock:0;
					$total_stock	= $opening_stock;
					$total_sale		= isset($datewise_sell_result->total_qty)?$datewise_sell_result->total_qty:0;
					$closing_stock	= isset($datewise_sell_result->closing_stock)?$datewise_sell_result->closing_stock:0;
					
					
					$prev_datewise_sell_result = DailyStockTransferHistory::whereBetween('created_at', [$dateS." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
					
					$prev_sell_stock =isset($prev_datewise_sell_result->closing_stock)?$prev_datewise_sell_result->closing_stock:'';
					
					$purchase_history_result 	= DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
					
					$purchase_stock =isset($purchase_history_result->total_qty)?$purchase_history_result->total_qty:'0';
					
					
					
					
					
					if($purchase_stock>0){
						//echo 'ddd-'.$sell_date.'--'.$purchase_stock.'-'.$opening_stock.'-';
						if($opening_stock>0){
							$opening_stock=$opening_stock-$purchase_stock;
						}
						if($closing_stock==0){
							$opening_stock=$start_opening_stock;
							$total_stock=$purchase_stock+$start_opening_stock;
							$closing_stock=$purchase_stock+$start_opening_stock;
						}
						
					}
					
					$purchase_history_last_result 	= DailyProductPurchaseHistory::select('id', 'total_qty', 'total_ml', 'closing_stock', 'closing_stock_ml')->whereBetween('created_at', [$dateS." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->first();
					
					$last_purchase_stock =isset($purchase_history_last_result->total_qty)?$purchase_history_last_result->total_qty:'0';
					
					//echo $sell_date.'-'.$last_purchase_stock.'</br>';
					//$start_opening_stock=0;
					
					if($prev_sell_stock!=''){
						//echo 'ddd-'.$sell_date.'--'.$prev_sell_stock.'-'.$opening_stock.'</br>';
						if($opening_stock==0 && $closing_stock==0){
							$opening_stock	= $prev_sell_stock;
							$total_stock	= $prev_sell_stock+$purchase_stock;
							$closing_stock	= $prev_sell_stock+$purchase_stock;
						}
					}else{
						if($start_opening_stock>0){
							if($opening_stock==0 && $closing_stock==0){
								$opening_stock	= $start_opening_stock;
								if($purchase_stock>0){
									$total_stock	= $start_opening_stock+$purchase_stock;
									$closing_stock	= $start_opening_stock+$purchase_stock;
								}else{
									$opening_stock	= $start_opening_stock+$last_purchase_stock;
									$total_stock	= $start_opening_stock+$last_purchase_stock;
									$closing_stock	= $start_opening_stock+$last_purchase_stock;
								}
							}
						}else{
							if($opening_stock==0 && $closing_stock==0){
								$opening_stock	= $start_opening_stock;
								if($purchase_stock>0){
									$total_stock	= $purchase_stock;
									$closing_stock	= $purchase_stock;
								}else{
									$opening_stock	= $last_purchase_stock;
									$total_stock	= $last_purchase_stock;
									$closing_stock	= $last_purchase_stock;
								}
							}
						}
					}
					
					/*if($opening_stock>0){
						echo 'iii-'.$sell_date.'--';
						if($closing_stock==0){
							$closing_stock=$opening_stock;
						}
					}*/
					
					
					
					$inwardStockProductResult = InwardStockProducts::whereBetween('created_at', [$sell_date." 00:00:00", $sell_date." 23:59:59"])->where('branch_id',$branch_id)->where('size_id',$size_id)->where('product_id',$product_id)->orderBy('id', 'DESC')->get();
					
					
					$source_info='';
					$warehouse_info='';
					$batch_no='';
					if(count($inwardStockProductResult)>0){
						foreach($inwardStockProductResult as $inwardPRow){
							if($inwardPRow->invoice->warehouse_id!=''){
								$warehouse_result=Warehouse::where('id',$inwardPRow->invoice->warehouse_id)->first();
								$warehouse_info	.= isset($warehouse_result->company_name)?$warehouse_result->company_name:0;
							}
							
							$source_info .=$inwardPRow->invoice->tp_no;
							$batch_no .=$inwardPRow->batch_no;
						}
					}
					
					//echo '<pre>';print_r($);exit;
					
					$stock_result[]=array(
						'size_id'			=> $size_row->size_id,
						'size_name'			=> $size_row->size->ml,
						'opening_stock'		=> $opening_stock,
						'purchase_stock'	=> $purchase_stock,
						'total_stock'		=> $total_stock,
						'total_sale'		=> $total_sale,
						'closing_stock'		=> $closing_stock,
						'source_info'		=> $source_info,
						'warehouse_info'	=> $warehouse_info,
						'batch_no'			=> $batch_no,
					);
				}
				$result[]=array(
					'sell_date'		=> $sell_date,
					'stock_result'	=> $stock_result
				);
			}
			
			
        	$data['result'] 		= $result;
        	$data['shop_name'] 		= 'BAZIMAT';
			$data['brand_name'] 	= isset($product_info->product_name)?$product_info->product_name:'';
        	$data['shop_address'] 	= 'West Chowbaga Kolkata - 700105 West Bengal';
			$data['month'] 			= date('F Y',strtotime($start_date));
			
			echo '<pre>';print_r($result);exit;
			
			$pdf = PDF::loadView('admin.pdf.brand-register', compact('data'));
			return $pdf->stream(now().'-brand.pdf');
			
			
			
			
			//echo '<pre>';print_r($result);exit;
			
			
			
			
			
			
			//$product_result=Product::where('id',$product_id)->first();
			
			echo '<pre>';print_r($dateS);exit;
			
			
			
		}
		
		
		
		echo '<pre>';print_r($product_info);exit;
		
		
		
	}
	
	public function daily_product_sell_history_new($branch_id){
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
								
								if($check_sell_id!=''){
									$total_qty	= $date_wise_total_sell_qty+$check_datewise_sell_result->total_qty;
									$total_ml	= $date_wise_total_sell_ml+$check_datewise_sell_result->total_ml;
									
									$closing_stock		= $opening_stock-$total_qty;
									$closing_stock_ml	= $opening_stock_ml-$total_ml;
									
									//echo '<pre>';print_r($closing_stock_ml);exit;
									
									
									
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
	
	
	
	public function daily_product_purchase_history_new2($branch_id){
		$purchase_date_result 	= InwardStockProducts::where('branch_id',$branch_id)->where('is_new','Y')->orderBy('id', 'asc')->first();
		$purchase_start_date	= isset($purchase_date_result->created_at)?date('Y-m-d',strtotime($purchase_date_result->created_at)):'';
		
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
								
								if(count($check_purchase_history_result)>0){
									$total_qty	= $date_wise_total_qty+$check_purchase_history_result[0]->total_qty;
									$total_ml	= $date_wise_total_ml+$check_purchase_history_result[0]->total_ml;
									
									$items[]=array(
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
									);
									
									/*DailyProductPurchaseHistory::where('id',$check_purchase_history_result[0]->id)->update(['total_qty' => $total_qty,'total_ml' => $total_ml,'closing_stock' => $closing_stock,'closing_stock_ml' => $closing_stock_ml]);
										
									InwardStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);*/
								}else{
									/*$purchase_data=array(
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
									);
									DailyProductPurchaseHistory::create($purchase_data);
									InwardStockProducts::where('branch_id',$branch_id)->where('category_id',$category_id)->where('subcategory_id',$subcategory_id)->where('size_id',$size_id)->where('product_id',$product_id)->update(['is_new' => 'N']);*/
									
									
									$items[]=array(
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
									);
									
								}
							}
						}
					}
				}
			}
			
			echo '<pre>';print_r($items);exit;	
			echo 'success';exit;	
		}else{
			echo 'Not data found';exit;
		}	
	}
	
	public function daily_product_sell_history2($branch_id){
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
								
								
								//echo '<pre>';print_r($product_barcode);exit;
								
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
								
								
								
								if($check_sell_id!=''){
									//echo '<pre>';print_r($date_wise_total_sell_ml);exit;
									$total_qty	= $date_wise_total_sell_qty+$check_datewise_sell_result->total_qty;
									$total_ml	= $date_wise_total_sell_ml+$check_datewise_sell_result->total_ml;
									
									$closing_stock		= $opening_stock-$total_qty;
									$closing_stock_ml	= $opening_stock_ml-$total_ml;
									
									//print_r($closing_stock_ml);exit;
									
									
									
									DailyStockTransferHistory::where('id',$check_sell_id)->update(['total_ml' => $total_ml,'total_qty' => $total_qty,'opening_stock' => $opening_stock,'closing_stock' => $closing_stock,'opening_stock_ml' => $opening_stock_ml,'closing_stock_ml' => $closing_stock_ml]);
									
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
	}}
	
	
	
	public function daily_product_sell_history_old($branch_id){
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
									
								if($prev_closing_stock_ml!=''){
									$opening_stock_ml 	= $prev_closing_stock_ml;
									$opening_stock 		= $prev_closing_stock;
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
			echo 'success';exit;
		}else{
			echo 'Data not found';exit;
		}
	}
	
	
}
?>

      