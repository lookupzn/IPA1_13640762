<?php
    $name = $_POST['name'];
    $address = $_POST['address'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $email = $_POST['email'];

    echo "<h2>Your Order Has Been Finished! Here Is Your Detail.</h2>";
    echo "Name: " . $name . "<br>";
    echo "Address: " . $address . "<br>";
    echo "Suburb: " . $suburb . "<br>";
    echo "State: " . $state . "<br>";
    echo "Country: " . $country . "<br>";
    echo "Email: " . $email . "<br>";
?>
