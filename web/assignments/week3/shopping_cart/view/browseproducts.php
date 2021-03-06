<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Shopping Cart">
	<title>Product Page</title>
	<link href="style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<main>
		<div id="cart">
		<?php 
			
			if(empty($_SESSION["cart_item"])) {
				$count = "";
			} else {
				
				$count = "(" . count($_SESSION["cart_item"]) . ")";
			}
		?>
			<div class="txt-heading">Shopping Cart <a id="btnView" href="index.php?action=view">View Cart <?php echo $count; ?></a><a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
			<?php
				if(isset($_SESSION["cart_item"])){
					$item_total = 0;
				}
			?>
		</div>

		<div id="product-grid">
			<div class="txt-heading">Kitchen Products</div>
			<?php
			

			if (!empty($product_array)) { 
				foreach($product_array as $key=>$value){
			?>
				<div class="product-item">
					<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
					<div class="product-image"><?php echo $product_array[$key]["code"]; ?><img class="image_size" src="<?php echo $product_array[$key]["image"]; ?>" alt="productimage"></div>
					<div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
					</form>
				</div>
			<?php
					}
			}
			?>
		</div>
	</main>
</body>
</html>