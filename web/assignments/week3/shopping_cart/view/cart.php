<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Shopping Cart">
    <title>Cart</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<main>
		<div id="cart">
			<div class="txt-heading">Shopping Cart <a id="btnView" href="index.php?action=browse">Browse</a><a id="btnEmpty" href="index.php?action=empty">Empty Cart </a></div>
			<?php
				if(isset($_SESSION["cart_item"])){
					$item_total = 0;
			?>	
			<table>
				<tbody>
					<tr>
						<th style="text-align:left;"><strong>Name</strong></th>
						<th style="text-align:right;"><strong>Quantity</strong></th>
						<th style="text-align:right;"><strong>Price</strong></th>
						<th style="text-align:center;"><strong>Action</strong></th>
					</tr>	
					<?php		
						foreach ($_SESSION["cart_item"] as $item){
							?>
									<tr>
										<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
										<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
										<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
										<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
									</tr>
									<?php
							$item_total += ($item["price"]*$item["quantity"]);
							}
							?>

					<tr>
						<td><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
					</tr>
				</tbody>
			</table>		
			<?php
			}
			?>
			</div>
			<div class="text-heading"><a id="checkout_buttonout" href="index.php?action=checkout">Check out</a></div>
		</main>
</body>
</html>