<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="browser.css">
    <title>Document</title>
</head>
<body>
    <div id="display">
        <?php
            error_reporting(E_ERROR | E_PARSE);
            include 'DBConnectionString.php';
            $product_id = $_GET['pid'];
            print "<img id='pic' src='pics/$product_id.jpg'>";
            $query_string = "select * from products where product_id = $product_id;";
            $result = mysqli_query($link, $query_string);
            $rows = mysqli_num_rows($result);
            if($rows > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $price = $row['unit_price'];
                    $uQty = $row['unit_quantity'];
                    $in_stock = $row['in_stock'];
                    print "<ul id='details'>";
                    print "<li>ProductID: ".$id."</li>";
                    print "<li>Name: ".$name."</li>";
                    print "<li>Price: ".$price."</li>";
                    print "<li>Unit Quantity: ".$uQty."</li>";
                    print "<li>Stock Condition: ".($in_stock > 0 ? $in_stock : "Out of stock")."</li>";
                    print "</ul>";
                }
            } 
        ?>
        <form name="addToCart" action="shoppingCart.php" method="POST" target="cart">
            <label for="qty">Quantity(1-99): </label>
            <input type="number" name="qty" min="1" max="99">
            <input type="hidden" name="id" value="<?php print $id;?>">
            <input type="hidden" name="name" value="<?php print $name;?>">
            <input type="hidden" name="price" value="<?php print $price;?>">
            <input type="hidden" name="uQty" value="<?php print $uQty;?>">
            <input type="submit" value="Add to cart" id="addToCartBtn" <?php print ($in_stock <= 0) ? "disabled" : ""; ?>>
        </form>
    </div>
</body>
<script>
  document.getElementById("addToCartBtn").addEventListener("click", function(event) {
    var productId = "<?php print $id; ?>";
    if (!productId) {
      event.preventDefault();
      alert("Please Select An Item First :)");
    }
  });
</script>
</html>