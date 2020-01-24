<?php
session_start();

$product_array = array( array( 'id' => "1", 'name' => "Instant Pot", 'image' => "assignment-img/instantpot.png", 'price' => "100.00", 'description' => "This instant pot is a pressure cooker, a rice cooker, a slow cooker, and it can saute. It is amazing." ),  array( 'id' => "2", 'name' => "Kitchen Aid", 'image' => "assignment-img/kitchenaid.png", 'price' => "600.00", 'description' => "This is the KitchenAid that you need." ), array( 'id' => "3", 'name' => "Blend Tec", 'image' => "assignment-img/blendtec.png", 'price' => "200.00", 'description' => "The ONLY blender that you will ever need." ));

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