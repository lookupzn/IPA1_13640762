<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .required:after {
            content: " *";
            color: red;
        }
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
            background-color: rgb(169, 102, 107);;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>
    <table>
        <tr>
            <th colspan="5">Your Order</th>
        </tr>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Unit Quantity</th>
            <th>Amount</th>
            <th>Sub Total</th>
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

            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $item){
                    print "<tr>";
                    print "<td>".$item['name']."</td>";
                    print "<td>".$item['price']."</td>";
                    print "<td>".$item['uQty']."</td>";
                    print "<td>".$item['amount']."</td>";
                    print "<td>AUD$".($item['price']*$item['amount'])."</td>";
                    print "</tr>";
                    $total += $item['price']*$item['amount'];
                }
            }
        ?>
        <tr>
            <td>Total</td>
            <td colspan="4">A$ <?php print $total;?></td>
        </tr>
    </table>
    <form action="orderProcess.php" method="post" id="checkout_form">
        <fieldset>
            <legend>Shipping Details</legend>
            <label for="name" class="required">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="address" class="required">Address:</label>
            <input type="text" id="address" name="address" required><br><br>
            
            <label for="suburb" class="required">Suburb:</label>
            <input type="text" id="suburb" name="suburb" required><br><br>
            
            <label for="state" class="required">State:</label>
            <input type="text" id="state" name="state" required><br><br>
            
            <label for="country" class="required">Country:</label>
            <input type="text" id="country" name="country" required><br><br>
            
            <label for="email" class="required">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
        </fieldset>
        <input type="submit" value="Place Order">
    </form>
</body>
</html>
