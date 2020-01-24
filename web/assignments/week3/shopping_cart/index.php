<?php
session_start();

$product_array = array( array( 'id' => "1", 'name' => "Instant Pot", 'image' => "assignment-img/instantpot.png", 'price' => "100.00"),  array( 'id' => "2", 'name' => "Kitchen Aid", 'image' => "assignment-img/kitchenaid.png", 'price' => "600.00"), array( 'id' => "3", 'name' => "Blend Tec", 'image' => "assignment-img/blendtec.png", 'price' => "200.00"));

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
		include 'view/browseproducts.php';
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
		include 'view/browseproducts.php';
	break;
	
	case "view":
		include 'view/cart.php';
	break;

	case "checkout":
		include 'view/checkout.php';
	break;

	case "confirm":
		$clientName = filter_input(INPUT_POST, 'clientName', FILTER_SANITIZE_STRING);
		$clientAddress1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
		$clientCity = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
		$clientState = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
		$clientZipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);
	

		include 'view/orderconfirm.php';
	break;

	case "empty":
		unset($_SESSION["cart_item"]);
		include 'view/browseproducts.php';
	break;	
	
	default:
		include 'view/browseproducts.php';
		break;

}