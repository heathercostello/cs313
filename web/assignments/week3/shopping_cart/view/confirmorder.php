<<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Confirm Order">
    <title>Confirm Order</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <main>

        <?php
            if(isset($_SESSION["cart_item"])){
                $item_total = 0;
        ?>
        <div class="text-heading">
            <p>Please Confirm Your Order</p>
        </div>	
        

        <legend>Information</legend>

        <div class="row2">Full Name: <?php echo $clientName; ?></div>
        <div class="row1">Address: <?php echo $clientAddress1; ?></div>
        <div class="row2">City: <?php echo $clientCity; ?></div>
        <div class="row1">State: <?php echo $clientState; ?></div>
        <div class="row2">Zip Code: <?php echo $clientZipcode; ?></div>

        <div class="ordered">
            <legend class="orderedTitle">Products Ordered</legend>

            <div class="titleRow" id="confname">Name</div>
            <div class="titleRow" id="confqty">Quantity</div>
            <div class="titleRow" id="confprice">Price</div>
            
            <?php	
                $display= "";
                $index = 0;
                foreach ($_SESSION["cart_item"] as $key=>$item){
                    
                    if(($index % 2) == 0) {
                        $tmp = "even";
                    } else { $tmp = "odd"; }
                    $display .= "<div class='prodRow$key $tmp' id='confprodname'>" .  $item['name'] . "</div>";
                    $display .= "<div class='prodRow$key $tmp' id='confprodqty'>" .  $item['quantity'] . "</div>";
                    $display .= "<div class='prodRow$key $tmp' id='confprodprice'> $".$item['price'] . "</div>";
                    $item_total += ($item["price"]*$item["quantity"]);
                    $index += 1;
                }
                $display .= "<div class='prodTotal' id='total'>Total: $" . $item_total . "</div>";
                echo $display;
        }
        ?>
        </div>
        <div class="text-heading"><a id="btnView" href="index.php?action=browse">Browse</a></div>
    </main>
</body>
</html>