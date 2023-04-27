<?php
    session_start();
    $id = $_REQUEST['id'];
    if(isset($id)){
        unset($_SESSION['cart'][$id]);
    }else{
        unset($_SESSION['cart']);
    }
    header("Location:shoppingCart.php");
?>