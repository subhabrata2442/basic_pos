<?php
include('db.php');
error_reporting(0);
include 'vendor/autoload.php';

// create config
$config = new Smalot\PdfParser\Config();
$config->setDataTmFontInfoHasToBeIncluded(true);

// use config and parse file
$parser = new Smalot\PdfParser\Parser([], $config);
$pdf = $parser->parseFile('wine.pdf');

$metaData = $pdf->getDetails();


$product_result=[];

if(isset($metaData['Pages'])){
	if($metaData['Pages']>0){
		for($p=0;$metaData['Pages']>$p;$p++){
			$data = $pdf->getPages()[$p]->getDataTm();
			
			$start_product_row_id	= '';
			$remove_row_ids=[];
			
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
			
			for($i=0; count($brand_liquor_data)>$i; $i++){
				$th_head	= str_replace(' ','',$brand_liquor_data[$i]);
				if (preg_match('/\BrandName\b/', $th_head)) {
					$start_product_row_id	= ($i+3);
					break;
				}
			}
			
			$total_row=intval(((count($brand_liquor_data)-$start_product_row_id)/3));
			for($i=0;$total_row>$i;$i++){
				$count=($i*3);
				$index_1=($start_product_row_id+$count+0);
				$index_2=($start_product_row_id+$count+1);
				$index_3=($start_product_row_id+$count+2);
				
				$th_head=trim($brand_liquor_data[$index_2]);
				if (stripos($th_head, "Ml.") !== false) {
				}else{
					unset($brand_liquor_data[$index_2]);
					break;
				}
			}
			
			for($i=0;$total_row>$i;$i++){
				$count=($i*3);
				$index_1=($start_product_row_id+$count+0);
				$index_2=($start_product_row_id+$count+1);
				$index_3=($start_product_row_id+$count+2);
				$th_head=trim($brand_liquor_data[$index_2]);
				if (stripos($th_head, "Ml.") !== false) {
				}else{
					unset($brand_liquor_data[$index_2]);
					break;
				}
			}
			
			$brand_liquor_new_data=[];
			$i=0;foreach($brand_liquor_data as $key=>$val){
				$index_val	= trim($val);
				$brand_liquor_new_data[]=$index_val;
			$i++;}
			
			$total_row=intval(((count($brand_liquor_new_data)-$start_product_row_id)/3));
			
			for($i=0;$total_row>$i;$i++){
				$count=($i*3);
				$index_1=($start_product_row_id+$count+0);
				$index_2=($start_product_row_id+$count+1);
				$index_3=($start_product_row_id+$count+2);
				$product_result[]=array(
					'brand_name'	=> trim($brand_liquor_new_data[$index_1]),
					'measure'		=> trim($brand_liquor_new_data[$index_2]),
					'mrp'			=> trim($brand_liquor_new_data[$index_3])
				);
			}
		}	
	}
}

//echo '<pre>';print_r($product_result);exit;

$category_name	= 'Foreign Liquor';
$subcategory	= 'Wine';

$sql='SELECT * FROM `category` WHERE name="'.$category_name.'"';
$category_result = $conn->query($sql);

if ($category_result->num_rows > 0) {
	while($row = $category_result->fetch_assoc()) {
		$category_id 	= (isset($row['id']) ? $row['id'] : '');
	}
}else{
	$sql = 'INSERT INTO `category`(`name`, `created_at`) VALUES ("'.$category_name.'","'.date('Y-m-d').'")';
	$conn->query($sql);
	$category_id=$conn->insert_id;
}



$sql='SELECT * FROM `subcategory` WHERE name="'.$subcategory.'"';
$subcategory_result = $conn->query($sql);

if ($subcategory_result->num_rows > 0) {
	while($row = $subcategory_result->fetch_assoc()) {
		$subcategory_id 	= (isset($row['id']) ? $row['id'] : '');
	}
}else{
	$sql = 'INSERT INTO `subcategory`(`name`, `created_at`) VALUES ("'.$subcategory.'","'.date('Y-m-d').'")';
	$conn->query($sql);
	$subcategory_id=$conn->insert_id;
}

//echo '<pre>';print_r($product_barcode);exit;

if(count($product_result)>0){
	foreach($product_result as $row){
		$brand_name	= $row['brand_name'];
		$measure	= substr_replace($row['measure'] ,"", -1);
		$cost_rate	= $row['mrp'];
		
		//echo '<pre>';print_r($measure);exit;
		
		$sql='SELECT * FROM products';
		$total_product_result = $conn->query($sql);
		$n=$total_product_result->num_rows;
		$product_barcode=str_pad($n + 1, 5, 0, STR_PAD_LEFT);
		
		
		$sql='SELECT * FROM `brand` WHERE name="'.$brand_name.'"';
		$brand_result = $conn->query($sql);
		
		if ($brand_result->num_rows > 0) {
			while($row = $brand_result->fetch_assoc()) {
				$brand_id 	= (isset($row['id']) ? $row['id'] : '');
			}
		}else{
			$sql = 'INSERT INTO `brand`(`name`, `created_at`) VALUES ("'.$brand_name.'","'.date('Y-m-d').'")';
			$conn->query($sql);
			$brand_id=$conn->insert_id;
		}
		
		$sql='SELECT * FROM `size` WHERE name="'.$measure.'"';
		$size_result = $conn->query($sql);
		
		if ($size_result->num_rows > 0) {
			while($row = $size_result->fetch_assoc()) {
				$size_id 	= (isset($row['id']) ? $row['id'] : '');
			}
		}else{
			$sql = 'INSERT INTO `size`(`name`, `created_at`) VALUES ("'.$measure.'","'.date('Y-m-d').'")';
			$conn->query($sql);
			$size_id=$conn->insert_id;
		}
		
		$sql='SELECT * FROM `products` WHERE product_name="'.$brand_name.'"';
		$product_result = $conn->query($sql);
		if ($product_result->num_rows > 0) {
			
		}else{
			$sql = 'INSERT INTO `products`(`product_barcode`, `product_name`, `cost_rate`, `cost_price`, `selling_price`, `offer_price`, `product_mrp`, `category_id`, `subcategory_id`, `brand_id`, `size_id`, `created_at`) VALUES ("'.$product_barcode.'","'.$brand_name.'","'.$cost_rate.'","'.$cost_rate.'","'.$cost_rate.'","'.$cost_rate.'","'.$cost_rate.'","'.$category_id.'","'.$subcategory_id.'","'.$brand_id.'","'.$size_id.'","'.date('Y-m-d').'")';
			
			//echo '<pre>';print_r($sql);exit;
			
			
			$conn->query($sql);
		}
	}
}






//echo '<pre>';print_r($product_result);exit;
?>