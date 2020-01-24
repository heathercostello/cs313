<?php
session_start();

$product_array = array( array( 'id' => "1", 'name' => "3D Camera", 'code' => "3DcAM01", 'image' => "product-images/camera.jpg", 'price' => "1500.00", 'description' => "This camera features optimal image quality for both HD video and still images through Fujifilm's unrelenting supportive functions with Fujinon lens." ),  array( 'id' => "2", 'name' => "External Hard Drive", 'code' => "USB02", 'image' => "product-images/external-hard-drive.jpg", 'price' => "800.00", 'description' => "The Seagate Backup Plus portable drive simplifies backup for consumers who want to protect their entire digital life locally, in the cloud or from social networks. The metal design allows you to slide the drive into your pocket, purse or briefcase and carry it with you. Via the Seagate Dashboard, use the Protect function to set up a one-click plan or schedule your automatic local backup. Keep multiple copies of your files in case disaster strikes. With the Save feature, user-generated content can be backed up from your favorite social networks. Many people now use their smartphones to capture priceless moments. While these devices are handy and readily available, storage is not their strong suit. Capture a memory, post it on a social networking site and let the Seagate Dashboard automatically back up any content posted, even photos that you are tagged in. Even if the file gets accidentally deleted from your smartphone, another copy can be waiting. The Share feature allows multiple files to be uploaded to social networks at once from your computer. The days of uploading individual files without creating a new album are gone! Simply select files to upload, choose where to post them and even add comments. Managing your social profile has never been easier." ), array( 'id' => "3", 'name' => "Wrist Watch", 'code' => "wristWear03", 'image' => "product-images/watch.jpg", 'price' => "300.00", 'description' => "Marine Corps C23 Analog/Digital Chronograph Watch features a 52mm wide and 16mm thick solid case. This stylish dual-time chronograph watch offers both analog and digital time keeping functions and features a sleek black dial with the Marine Corps logo, sharp white hour markers and white/silvertone hands. A black rubber strap with silver detailing adds style and comfort to this unique timepiece. Age Group: Adult" ));

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch($action) {
	case "add":
		if(!empty($_POST["quantity"])) {
			foreach($product_array as $key) {
				if($key["code"] == $_GET["code"]) { 
					$productByCode = $key;
				}
			}
			
			$itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"]));
		
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($product_array[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($product_array[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
		include 'view/browse.php';
	break;
	
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
		include 'view/browse.php';
	break;
	
	case "details":
		foreach($product_array as $key) {
			if($key["code"] == $_GET["code"]) { 
				$itemArray = $key;
			}
		}
		include 'view/details.php';
	break;
	case "view":
		include 'view/cart.php';
	break;

	case "checkout":
		include 'view/checkout.php';
	break;

	case "orderconfirm":
		$clientName = filter_input(INPUT_POST, 'clientName', FILTER_SANITIZE_STRING);
		$clientEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$clientPhone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
		$clientAddress1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
		$clientAddress2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
		$clientCity = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
		$clientState = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
		$clientZipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);
	

		include 'view/orderconfirm.php';
	break;

	case "empty":
		unset($_SESSION["cart_item"]);
		include 'view/browse.php';
	break;	
	
	default:
		include 'view/browse.php';
		break;

}