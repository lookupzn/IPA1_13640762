<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Document</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    h3 {
        text-align: center;
    }
    </style>
</head>
<body>
    <table>
    <tr>
            <th colspan="6">Shopping Cart</th>
    </tr>
    <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Unit Quantity</th>
            <th>Amount</th>
            <th>Sub Total</th>
            <th>Delete Item</th>
    </tr>
    <?php
            error_reporting(E_ERROR | E_PARSE);
            session_start();
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $price = $_REQUEST['price'];
            $uQty = $_REQUEST['uQty'];
            $amount = $_REQUEST['qty'];
            $total = 0;
            if ($amount > 0 && $amount <= 99) {
                if(!isset($_SESSION['cart']) || !array_key_exists($id, $_SESSION['cart']))
                {
                    $_SESSION['cart'][$id] = array("id" => $id, "name" => $name, "price" => $price, "uQty" => $uQty, "amount" => $amount);
                }
                else
                {
                    $_SESSION['cart'][$id]['amount'] += $amount;
                }
            }

            if (count($_SESSION['cart']) == 0) {
                print '<h3>Shopping Cart is empty</h3>';
            } 
            if (isset($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $item){
                    print "<tr>";
                    print "<td>".$item['name']."</td>";
                    print "<td>".$item['price']."</td>";
                    print "<td>".$item['uQty']."</td>";
                    print "<td>".$item['amount']."</td>";
                    print "<td>AUD$".($item['price']*$item['amount'])."</td>";
                    print "<td><button><a href='itemDelete.php?id=".$item['id']."'>DELETE</a></button></td>";
                    print "</tr>";
                    $total += $item['price']*$item['amount'];
                }
            }
    ?>
        <tr>
            <td>Total</td>
            <td colspan="3">A$ <?php print $total;?></td>
            <td>
                <form action="itemDelete.php"><input type="submit" value="Clear"></form>
            </td>
            <td>
                <form action="checkout.php" target="browse"><input type="submit" value="Check Out" id="checkoutBtn"></form>
            </td>
        </tr>
    </table>
</body>
<script>
    function disableCheckoutIfTotalIsZero() {
        const total = parseFloat(<?php echo json_encode($total); ?>);
        const checkoutButton = document.getElementById("checkoutBtn");
        if (total === 0) {
            checkoutButton.disabled = true;
        } else {
            checkoutButton.disabled = false;
        }
    }
    disableCheckoutIfTotalIsZero();
</script>
</html>