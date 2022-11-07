<?php include_once('header.php'); ?>
<?php
$sql = 'SELECT * FROM `category` ORDER BY name';
$categoryList = $conn3->query($sql);

$where='';
if(isset($_GET['store_name'])){
	if($_GET['store_name']!=''){
		$where .= 'AND oc_store.name LIKE "%'.$_GET['store_name'].'%"';
	}
}

if(isset($_GET['category'])){
	if($_GET['category']!=''){
		$where .= 'AND oc_store.category="'.$_GET['category'].'"';
	}
}


$nonCbiStoreResult=[];
if($where!=''){
	$sql = 'SELECT oc_store_to_community.*,oc_store.name,oc_store.url,oc_store.type FROM `oc_store_to_community` LEFT JOIN oc_store ON oc_store_to_community.store_id = oc_store.store_id WHERE oc_store.is_official="N" '.$where.' ORDER BY oc_store_to_community.store_id ASC';
	$storeResult = $conn2->query($sql);
	if ($storeResult->num_rows > 0) {
			while($row1 = $storeResult->fetch_assoc()) {
				$thumb	= 'images/store-thuumb/1.jpg';
				
				$config_theme_image='';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_image' and `store_id` = ".$row1['store_id'];
				$storeThumbResult = $conn2->query($sql);
				if ($storeThumbResult->num_rows > 0) {
					while($imagerow = $storeThumbResult->fetch_assoc()) {
						if($imagerow["value"]!=''){
							$config_theme_image='https://aacforusbyus.com/store_admin/image/'.$imagerow["value"];
						}
					}
				}
				
				$membersStore='';
				$sql ="SELECT * FROM `store_webinar` WHERE `store_id` = ".$row1['store_id'];
				$storeMemberResult = $conn3->query($sql);
				if ($storeMemberResult->num_rows > 0) {
					while($row2 = $storeMemberResult->fetch_assoc()) {
						$membersStore=$row2["name"];
					}
				}
				
				$config_theme='';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_theme' and `store_id` = ".$row1['store_id'];
				$storeThumbResult = $conn2->query($sql);
				if ($storeThumbResult->num_rows > 0) {
					while($row2 = $storeThumbResult->fetch_assoc()) {
						$config_theme=$row2["value"];
					}
				}
				
				$store_member_type='';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_member_type' and `store_id` = ".$row1['store_id'];
				$storeThumbResult = $conn2->query($sql);
				if ($storeThumbResult->num_rows > 0) {
					while($row2 = $storeThumbResult->fetch_assoc()) {
						$store_member_type=$row2["value"];
					}
				}
				
				$config_is_publish='N';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_is_publish' and `store_id` = ".$row1['store_id'];
				$storePublishResult = $conn2->query($sql);
				if ($storePublishResult->num_rows > 0) {
					while($row3 = $storePublishResult->fetch_assoc()) {
						$config_is_publish=$row3["value"];
					}
				}
				
				$config_is_live='0';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_live_status' and `store_id` = ".$row1['store_id'];
				$storePublishResult = $conn2->query($sql);
				if ($storePublishResult->num_rows > 0) {
					while($row3 = $storePublishResult->fetch_assoc()) {
						$config_is_live=$row3["value"];
					}
				}
				
				if($config_theme=='new_startup_business'){
					$thumb	= 'images/store-thuumb/1.jpg';
				}elseif($config_theme=='professional_services'){
					$thumb	= 'images/store-thuumb/2.jpg';
				}elseif($config_theme=='existing_ecommerce_sites'){
					$thumb	= 'images/store-thuumb/4.jpg';
				}elseif($config_theme=='brick_morter_business'){
					$thumb	= 'images/store-thuumb/5.jpg';
				}elseif($config_theme=='commissioned_sales'){
					$thumb	= 'images/store-thuumb/3.jpg';
				}
				
				$store_color = '#0000FF';
				$demo_url='https://startup.aacforusbyus.com/';
				if($config_theme=='new_startup_business'){
					$demo_url='https://startup.aacforusbyus.com/';
					$store_color 	= '#0000FF';
				}elseif($config_theme=='professional_services'){
					$demo_url='https://professional.aacforusbyus.com/';
					$store_color 	= '#800080';
				}elseif($config_theme=='commissioned_sales'){
					$demo_url='https://commission.aacforusbyus.com/';
					$store_color 	= '#00FF00';
				}elseif($config_theme=='existing_ecommerce_sites'){
					$demo_url='https://existing.aacforusbyus.com/';
					$store_color 	= '#af2926';
				}elseif($config_theme=='brick_morter_business'){
					$demo_url='https://brick.aacforusbyus.com/';
					$store_color 	= '#FFA500';
				}
				if($row1['type']==1){
					$store_color 	= '#f04333';
				}
				if($row1['type']==3){
					$demo_url		= 'https://youthdemo.aacforusbyus.com';
					$thumb			= 'images/sdBan-right.jpg';
					$store_color	= '#7E3817';
				}
				if($row1['type']==4){
					$store_color 	= '#728C00';
					$theme_img		= 'images/sdBan-right-6.jpg';
					$demo_url		= 'https://nonaac.aacforusbyus.com/';
				}
				
				$store_url	= $demo_url;
				//$row1["url"],
				
				if($config_theme_image!=''){
					$thumb	= $config_theme_image;
				}
				
				
				if($config_is_publish=='Y'){
					if($config_is_live=='1'){
						$store_url	= $row1["url"];
					}
				}
				
				$nonCbiStoreResult[]=array(
					'store_id'				=> $row1["store_id"],
					'community_store_id'	=> $row1["community_store_id"],
					'member_name'			=> $membersStore,
					'name'					=> $row1["name"],
					'member_type'			=> $store_member_type,
					'url'					=> $row1["url"],
					'config_theme'			=> $config_theme,
					'store_color'			=> $store_color,
					'thumb'					=> $thumb,
				);
			}
		}
}



//print_r($nonCbiStoreResult);exit;



$sql = 'SELECT * FROM `oc_store`  WHERE type=1 AND is_official="N" '.$where.' ORDER BY store_id DESC';

//print_r($sql);exit;
$communityList = $conn2->query($sql);

$result=array();

if ($communityList->num_rows > 0) {
	while($row = $communityList->fetch_assoc()) {
		$community_store_id=$row["store_id"];
		
		
		$community_config_theme_image='';
		$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_image' and `store_id` = ".$row['store_id'];
		$storeThumbResult = $conn2->query($sql);
		if ($storeThumbResult->num_rows > 0) {
			while($imagerow = $storeThumbResult->fetch_assoc()) {
				if($imagerow["value"]!=''){
					$community_config_theme_image='https://aacforusbyus.com/store_admin/image/'.$imagerow["value"];
				}
			}
		}
		
		$community_member_type='';
		$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_member_type' and `store_id` = ".$row['store_id'];
		$storeThumbResult = $conn2->query($sql);
		if ($storeThumbResult->num_rows > 0) {
			while($row3 = $storeThumbResult->fetch_assoc()) {
				$community_member_type=$row3["value"];
			}
		}
		
		$parent_config_theme='';
		$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_theme' and `store_id` = ".$row['store_id'];
		$storeThumbResult = $conn2->query($sql);
		if ($storeThumbResult->num_rows > 0) {
			while($row4 = $storeThumbResult->fetch_assoc()) {
				$parent_config_theme=$row4["value"];
			}
		}
		
		$parent_demo_url='https://startup.aacforusbyus.com/';
		if($parent_config_theme=='new_startup_business'){
			$parent_demo_url='https://startup.aacforusbyus.com/';
		}elseif($parent_config_theme=='professional_services'){
			$parent_demo_url='https://aacforusbyus.com/professional_services_demo/';
		}elseif($parent_config_theme=='commissioned_sales'){
			$parent_demo_url='https://aacforusbyus.com/commissioned_sales_demo/';
		}elseif($parent_config_theme=='existing_ecommerce_sites'){
			$parent_demo_url='https://aacforusbyus.com/existing_ecommerce_demo/';
		}elseif($parent_config_theme=='brick_morter_business'){
			$parent_demo_url='https://aacforusbyus.com/brick_morter_business_demo/';
		}
		if($row['type']==3){
			$parent_demo_url='https://aacforusbyus.com/youth_demo/';
			$thumb		= 'images/sdBan-right.jpg';
		}
		
		
		
		$sql = 'SELECT oc_store_to_community.*,oc_store.name,oc_store.url,oc_store.type FROM `oc_store_to_community` LEFT JOIN oc_store ON oc_store_to_community.store_id = oc_store.store_id WHERE oc_store_to_community.community_store_id='.$community_store_id.' AND oc_store.is_official="N" ORDER BY oc_store_to_community.store_id ASC';
		$storeResult = $conn2->query($sql);
		$storeList=[];
		if ($storeResult->num_rows > 0) {
			while($row1 = $storeResult->fetch_assoc()) {
				$thumb	= 'images/store-thuumb/1.jpg';
				
				$config_theme_image='';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_image' and `store_id` = ".$row1['store_id'];
				$storeThumbResult = $conn2->query($sql);
				if ($storeThumbResult->num_rows > 0) {
					while($imagerow = $storeThumbResult->fetch_assoc()) {
						if($imagerow["value"]!=''){
							$config_theme_image='https://aacforusbyus.com/store_admin/image/'.$imagerow["value"];
						}
					}
				}
				
				$membersStore='';
				$sql ="SELECT * FROM `store_webinar` WHERE `store_id` = ".$row1['store_id'];
				$storeMemberResult = $conn3->query($sql);
				if ($storeMemberResult->num_rows > 0) {
					while($row2 = $storeMemberResult->fetch_assoc()) {
						$membersStore=$row2["name"];
					}
				}
				
				$config_theme='';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_theme' and `store_id` = ".$row1['store_id'];
				$storeThumbResult = $conn2->query($sql);
				if ($storeThumbResult->num_rows > 0) {
					while($row2 = $storeThumbResult->fetch_assoc()) {
						$config_theme=$row2["value"];
					}
				}
				
				$store_member_type='';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_member_type' and `store_id` = ".$row1['store_id'];
				$storeThumbResult = $conn2->query($sql);
				if ($storeThumbResult->num_rows > 0) {
					while($row2 = $storeThumbResult->fetch_assoc()) {
						$store_member_type=$row2["value"];
					}
				}
				
				$config_is_publish='N';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_is_publish' and `store_id` = ".$row1['store_id'];
				$storePublishResult = $conn2->query($sql);
				if ($storePublishResult->num_rows > 0) {
					while($row3 = $storePublishResult->fetch_assoc()) {
						$config_is_publish=$row3["value"];
					}
				}
				
				$config_is_live='0';
				$sql ="SELECT * FROM `oc_setting` WHERE `key`='config_live_status' and `store_id` = ".$row1['store_id'];
				$storePublishResult = $conn2->query($sql);
				if ($storePublishResult->num_rows > 0) {
					while($row3 = $storePublishResult->fetch_assoc()) {
						$config_is_live=$row3["value"];
					}
				}
				
				if($config_theme=='new_startup_business'){
					$thumb	= 'images/store-thuumb/1.jpg';
				}elseif($config_theme=='professional_services'){
					$thumb	= 'images/store-thuumb/2.jpg';
				}elseif($config_theme=='existing_ecommerce_sites'){
					$thumb	= 'images/store-thuumb/4.jpg';
				}elseif($config_theme=='brick_morter_business'){
					$thumb	= 'images/store-thuumb/5.jpg';
				}elseif($config_theme=='commissioned_sales'){
					$thumb	= 'images/store-thuumb/3.jpg';
				}
				
				$store_color = '#0000FF';
				$demo_url='https://startup.aacforusbyus.com/';
				if($config_theme=='new_startup_business'){
					$demo_url='https://startup.aacforusbyus.com/';
					$store_color 	= '#0000FF';
				}elseif($config_theme=='professional_services'){
					$demo_url='https://professional.aacforusbyus.com/';
					$store_color 	= '#800080';
				}elseif($config_theme=='commissioned_sales'){
					$demo_url='https://commission.aacforusbyus.com/';
					$store_color 	= '#00FF00';
				}elseif($config_theme=='existing_ecommerce_sites'){
					$demo_url='https://existing.aacforusbyus.com/';
					$store_color 	= '#af2926';
				}elseif($config_theme=='brick_morter_business'){
					$demo_url='https://brick.aacforusbyus.com/';
					$store_color 	= '#FFA500';
				}
				if($row1['type']==1){
					$store_color 	= '#f04333';
				}
				if($row1['type']==3){
					$demo_url		= 'https://youthdemo.aacforusbyus.com';
					$thumb			= 'images/sdBan-right.jpg';
					$store_color	= '#7E3817';
				}
				if($row1['type']==4){
					$store_color 	= '#728C00';
					$theme_img		= 'images/sdBan-right-6.jpg';
					$demo_url		= 'https://nonaac.aacforusbyus.com/';
				}
				
				$store_url	= $demo_url;
				//$row1["url"],
				
				if($config_theme_image!=''){
					$thumb	= $config_theme_image;
				}
				
				
				if($config_is_publish=='Y'){
					if($config_is_live=='1'){
						$store_url	= $row1["url"];
					}
				}
				
				$storeList[]=array(
					'store_id'				=> $row1["store_id"],
					'community_store_id'	=> $row1["community_store_id"],
					'member_name'			=> $membersStore,
					'name'					=> $row1["name"],
					'member_type'			=> $store_member_type,
					'url'					=> $row1["url"],
					'config_theme'			=> $config_theme,
					'store_color'			=> $store_color,
					'thumb'					=> $thumb,
				);
			}
		}
		
		
		
		
		
		$thumb='images/store-thuumb/1.jpg';
		if($community_config_theme_image!=''){
			$thumb	= $community_config_theme_image;
		}
		
		
		//echo '<pre>';print_r($storeList);exit;
		$result[]=array(
			'store_id'		=> $row["store_id"],
			'name'			=> $row["name"],
			'member_type'	=> $community_member_type,
			'url'			=> $row["url"],
			'thumb'			=> $thumb,
			'storeList'		=> $storeList
		);
	}
}


//echo '<pre>';print_r($result);exit;
                                    



?>
<body class="bg">
<a href="http://preregistration.aacforusbyus.com/" class="preRegBtnFall"><img src="images/pre-reg-btn.jpg" alt=""></a> <a class="scrollup" href="javascript:void(0);" aria-label="Scroll to top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a> <a class="scrollDown" href="javascript:void(0);" aria-label="Scroll to down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
<header class="siteHeader forSun gradient-bg sunpic commuiniti-bg-gap">
  <div class="container-fluid">
    <div class="row justify-content-between align-items-center">
      <div class="col-auto siteLogo"> <a href="https://aacforusbyus.com/"><img src="images/siteLogo.png" alt="" class="img-fluid"></a> </div>
      <div class="col text-center header-hed orga-head">
        <h2>Keeping Communities</h2>
        <h1>Your Organization Name</h1>
      </div>
      <div class="col-auto siteHeaderRight">
        <ul class="">
          <li> <a href="associated-members.php" class="box-shaw"><img src="images/go-back-2.png" alt="" class="img-fluid"></a> </li>
          <!-- <li class="mt-1">
                            <a href="associated-members.php" class="box-shaw"><img src="images/hgt-btn.png" alt="" class="img-fluid"></a>
                        </li> -->
        </ul>
      </div>
    </div>
  </div>
</header>
<section class="aac-demo mt-4">
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <div class="aac-demo-left">
          <p><em>"Snowflakes are one of nature's most fragile things, but just look at what they can do when they stick together."</em></p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="shoppingCenterHeaderBtm mt-5 mb-5 border-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3-col-sm-6 col-12">
        <div class="wayShop w-100"> <span>2 ways to shop</span> </div>
      </div>
      <div class="col-lg-3 col-md-3-col-sm-6 col-12">
        <form action="" method="get">
          <div class="wayShopSrc w-100 relative">
            <label for=""><span>1.</span> Shop By store name</label>
            <input type="text" class="form-control" name="store_name" id="input-store_name" value="<?php if(isset($_GET['store_name'])){ echo $_GET['store_name'];} ?>">
            <button type="submit">Go</button>
          </div>
        </form>
      </div>
      
      <div class="col-lg-3 col-md-3-col-sm-6 col-12">
        <form action="" method="get">
          <div class="wayShopSrc w-100 relative">
            <label for=""><span>3.</span> Shop By category</label>
            <select class="selectOption" name="category" id="category">
              <option value="">--- Please Select---</option>
              <?php
                              if ($categoryList->num_rows > 0) {
								  while($row = $categoryList->fetch_assoc()) {?>
              <option value="<?=$row["name"];?>" <?php if(isset($_GET['category'])){ if($_GET["category"]==$row["name"]){ echo 'selected';}} ?>>
              <?=$row["name"];?>
              </option>
              <?php }
							  }
							  ?>
            </select>
            <button type="submit">Go</button>
          </div>
        </form>
      </div>
      <div class="col-lg-3 col-md-3-col-sm-6 col-12"> <a href="https://aacforusbyus.com/keeping-communities3.php" class="view_all_btn">View All</a> </div>
    </div>
  </div>
</section>
<section class="joinAfilate pt-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-12">
        <?php if(count($result)>0){ ?>
        <?php foreach($result as $community_row){?>
        <div class="profile mb-5 store_box" style="display:none">
          <!--<div class="profile-bg lgBg">Your Group / Organization's "FREE" Store</div>-->
          <div class="profile-bg lgBg"><?php echo $community_row['name'] ?> Store</div>
          <div class="profile-sec d-flex w-100 justify-content-between align-items-center">
            <div class="profile-sec-left text-center"> <img src="images/store-thuumb/1.jpg" alt=""> </div>
            <div class="profile-sec-right">
              <ul>
                <li class="mb-2">
                  <p><strong class="text-left">Store name :</strong> <span class="text-left"><?php echo $community_row['name'] ?></span></p>
                </li>
                <li class="mb-2">
                  <p><strong class="text-left">Products :</strong> <span class="text-left prored"><?php echo $community_row['member_type'] ?></span></p>
                </li>
                <li class="mb-2">
                  <p><strong class="text-left">Ratings :</strong> <span class="text-left"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span></p>
                </li>
              </ul>
              <a href="<?php echo $community_row['url'] ?>" > <img src="images/kiping/marchent.png" alt=""> </a> </div>
          </div>
        </div>
        <?php if(count($community_row['storeList'])>0){ ?>
        <?php foreach($community_row['storeList'] as $store_row){?>
        <div class="profile mb-5 store_box" style="display:none">
          <!--<div class="profile-bg"><?php echo $community_row['name'] ?>'s Store</div>-->
          <div class="profile-bg" style="background:<?=$store_row['store_color'];?>"><?php echo $store_row['member_name'] ?>'s Store</div>
          <div class="profile-sec d-flex w-100 justify-content-between align-items-center">
            <div class="profile-sec-left text-center"> <img src="<?php echo $store_row['thumb'] ?>" alt=""> </div>
            <div class="profile-sec-right">
              <ul>
                <li class="mb-2">
                  <p><strong class="text-left">Store name :</strong> <span class="text-left"><?php echo $store_row['name'] ?></span></p>
                </li>
                <li class="mb-2">
                  <p><strong class="text-left">Products :</strong> <span class="text-left prored"><?php echo $store_row['member_type'] ?></span></p>
                </li>
                <li class="mb-2">
                  <p><strong class="text-left">Ratings :</strong> <span class="text-left"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span></p>
                </li>
              </ul>
              <a href="<?php echo $store_row['url'] ?>" > <img src="images/kiping/marchent.png" alt=""> </a> </div>
          </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
         <?php if(count($nonCbiStoreResult)>0){ ?>
        <?php foreach($nonCbiStoreResult as $store_row){?>
        <div class="profile mb-5 store_box" style="display:none">
          
          <div class="profile-bg" style="background:<?=$store_row['store_color'];?>"><?php echo $store_row['member_name'] ?>'s Store</div>
          <div class="profile-sec d-flex w-100 justify-content-between align-items-center">
            <div class="profile-sec-left text-center"> <img src="<?php echo $store_row['thumb'] ?>" alt=""> </div>
            <div class="profile-sec-right">
              <ul>
                <li class="mb-2">
                  <p><strong class="text-left">Store name :</strong> <span class="text-left"><?php echo $store_row['name'] ?></span></p>
                </li>
                <li class="mb-2">
                  <p><strong class="text-left">Products :</strong> <span class="text-left prored"><?php echo $store_row['member_type'] ?></span></p>
                </li>
                <li class="mb-2">
                  <p><strong class="text-left">Ratings :</strong> <span class="text-left"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span></p>
                </li>
              </ul>
              <a href="<?php echo $store_row['url'] ?>" > <img src="images/kiping/marchent.png" alt=""> </a> </div>
          </div>
        </div>
        <?php } ?>
         <?php } ?>
        
        <div class="load_more_sec">
          <a href="javascript:;" class="load_more_btn">Load more</a>
        </div> 
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
        <div class="associed-sec keepComRight">
          <div class="associed-sec-title text-center">
            <h3>aac Associated member</h3>
          </div>
          <div class="join-today text-center">
            <p>This Section Consists of our Associated Member Groups who are Community Based Institutions and Organizations, such as: Churches / Mosque / Fraternities / Sororities / Not-For-Profit Organizations as well as other "for" Profit Organizations,
              and their many AAC Member Merchant Supporters.</p>
          </div>
          <div class="select-sec text-left  w-100">
            <div class="select-sec-left w-100 pr-0">
              <p>Select And Support Your Community Based Institution</p>
              <div class="wayShopSrc w-100 relative mt-3">
                <select name="" id="" class="selectOption">
                  <option value="">Your Selection</option>
                </select>
                <a href="keeping-communities.php">Go</a> </div>
            </div>
            <div class="select-sec-right d-flex align-items-center justify-content-center"> <a href="associated-members.php" class="box-shaw"> <img src="images/Join-Now.png" alt=""> </a> </div>
          </div>
        </div>
        
        <!-- <div class="opportunities mb-5">
                        <h2>AAC Opportunities in Your State</h2>
                        <a href="shopping-center.php" class="text-center mt-3 w-100">
                            <img src="images/kiping/click.png" alt="">
                        </a>
                    </div> -->
        <div class="memder-ad text-center">
          <h4><span>MEMBER ADVERTISEMENT</span></h4>
        </div>
        <div class="licence-opportunity text-center">
          <div class="opportunity-sec mb-4">
            <h3>Licence Opportunity</h3>
          </div>
          <div class="licence-opportunity-img"> <img src="images/2.png" alt=""> </div>
          <a href="affiliate-page.php" title=""> <img src="images/kiping/learn-more.png" alt=""> </a> </div>
      </div>
    </div>
  </div>
</section>
<section class="fsocial mt-5">
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center">
      <div class="col-auto">
        <ul class="d-flex flex-wrap footerSocil">
          <li> <a href="http://twitter.com/TheAfricanAme10" ><img src="images/twitter-2.png" alt=""></a> </li>
          <li> <a href="https://www.facebook.com/African-Americans-for-self-reliant-Economic-Solutions-152844514735852" ><img src="images/facebook-2.png" alt=""></a> </li>
          <li> <a href="javascript:;"><img src="images/instagram-2.png" alt=""></a> </li>
          <li> <a href="tel:833-367-2987"><img src="images/whatsapp-2.png" alt=""></a> </li>
          <li> <a href="javascript:;"><img src="images/gmail-2.png" alt=""></a> </li>
        </ul>
      </div>
      <!-- <div class="col-auto">

                    <ul class="d-flex align-items-center height-92">
                        <li><img src="images/bbb.jpg" alt="" class="img-fluid"></li>
                        <li><img src="images/batch.png" alt="" class="img-fluid"></li>
                        <li><img src="images/site-lock.jpg" alt="" class="img-fluid"></li>
                    </ul>
                </div> --> 
    </div>
  </div>
</section>
<?php include('footer_menu.php'); ?>
<a class="scrollup" href="javascript:void(0);" aria-label="Scroll to top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
<div class="modal fade" id="teckTour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Take The Tour</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="w-100 imgLink"> <a href="shopping-center.php"  class="d-flex align-items-center">
          <div class="modImg"><img src="images/modal-img/1.jpg" alt=""></div>
          <div class="modalContent">African American Shopping Center</div>
          </a> </div>
        <div class="w-100 imgLink"> <a href="the-hive.php"  class="d-flex align-items-center">
          <div class="modImg"><img src="images/modal-img/2.jpg" alt=""></div>
          <div class="modalContent">Where Social Media And Prosperity Meet</div>
          </a> </div>
        <div class="w-100 imgLink"> <a href="business-center.php"  class="d-flex align-items-center">
          <div class="modImg"><img src="images/modal-img/3.jpg" alt=""></div>
          <div class="modalContent">AAC Information Center</div>
          </a> </div>
        <div class="w-100 imgLink d-flex align-items-center justify-content-center"> <a href="startup-page.php" > <img src="images/gs-btn.png" alt="" style="max-width: 250px;"> </a> </div>
        <div class="w-100 imgLink"> <a href="webinar.php"  class="d-flex align-items-center">
          <div class="modImg"><img src="images/modal-img/5.jpg" alt=""></div>
          <div class="modalContent">Signup - Online Webinar</div>
          </a> </div>
        <div class="w-100 imgLink"> <a href="contact-us.php"  class="d-flex align-items-center">
          <div class="modImg"><img src="images/modal-img/6.jpg" alt=""></div>
          <div class="modalContent">Report Abuse</div>
          </a> </div>
        <div class="w-100 imgLink d-flex align-items-center justify-content-center"> <a href="gift-card.php" > <img src="images/gift-btn.png" alt="" class="max-400"> </a> </div>
        <!-- <div class="w-100 imgLink">
                        <a href="../../startup-page.php"  class="d-flex align-items-center">
                            <div class="modImg"><img src="images/modal-img/7.png" alt=""></div>
                            <div class="modalContent"> AAC Enrollment Center</div>
                        </a>
                    </div>
                    <div class="w-100 imgLink">
                        <a href="../../gift-card.php"  class="d-flex align-items-center">
                            <div class="modImg"><img src="images/modal-img/8.jpg" alt=""></div>
                            <div class="modalContent">AAC Buy a Business for a friend, neighbor or loved one</div>
                        </a>
                    </div>-->
        <div class="w-100 imgLink d-flex align-items-center justify-content-center"> <a href="affiliate-page.php" > <img src="images/modal-img/9.jpg" alt=""> </a> </div>
        <!-- <div class="w-100 imgLink d-flex align-items-center justify-content-center">
                        <a href="#">
                            <img src="images/modal-img/10.jpg" alt="">
                        </a>
                    </div> --> 
      </div>
      <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --> 
    </div>
  </div>
</div>
<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/custom.js"></script> 
<script>
$(function() {
	$('div.store_box:lt(10)').show();
	
	if($('.store_box').length<10){
		$('.load_more_sec').hide();
	}
	
});
var show=10;
$(document).on('click','.load_more_btn',function(){
	var total_store_count=$('.store_box').length;
	 show += parseInt(10);
	 $('div.store_box:lt('+show+')').show();
	 
	 
	 if(show>=total_store_count){
		 $('.load_more_sec').hide();
	}
	 
	 console.log(total_store_count); 
	
});


$(function() {
	$("#teckTour").load("takeTour.php");
});
</script> 
<script>
        $(document).ready(function() {
            $('.video').parent().click(function() {
                if ($(this).children(".video").get(0).paused) {
                    $(this).children(".video").get(0).play();
                    $(this).children(".videoCaption").fadeOut();
                    // $(".video-img").fadeOut();
                } else {
                    $(this).children(".video").get(0).pause();
                    $(this).children(".videoCaption").fadeIn();
                    //$(".video-img").fadeIn();
                }
            });
        });
    </script> 
<script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('.scrollup').fadeIn();
                    $('.arrow-show').fadeIn();
                } else {
                    $('.scrollup').fadeOut();
                    $('.arrow-show').fadeOut();
                }
            });
            $('.scrollup').click(function(e) {
                e.preventDefault();
                $("html, body").animate({
                    scrollTop: 0
                }, 300);
                return false;
            });
        });
    </script> 
<script>
        $(document).ready(function() {
            $(".homeslider").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayHoverPause: true,
                autoplayTimeout: 3000,
                smartSpeed: 1000,
                animateOut: 'fadeOut',
                margin: 1,
                dots: true,
                nav: false,

            });
        });
    </script> 
<script>
        $(document).ready(function() {
            console.log($(this).scrollTop());
            if ($(this).scrollTop() > 200) {
                $('.scrollup').fadeIn();
                $('.scrollDown').fadeOut();
            }
            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('.scrollDown').fadeOut();
                    $('.scrollup').fadeIn();
                    $('.arrow-show').fadeIn();
                } else {
                    $('.scrollDown').fadeIn();
                    $('.scrollup').fadeOut();
                    $('.arrow-show').fadeOut();
                }
            });
            $('.scrollup').click(function(e) {
                e.preventDefault();
                $("html, body").animate({
                    scrollTop: 0
                }, 300);
                return false;
            });
            $('.scrollDown').click(function(e) {
                e.preventDefault();
                var n = $(document).height();
                $('html, body').animate({
                    scrollTop: n
                }, 300);
                return false;
            });
        });
    </script>
</body>
</html>