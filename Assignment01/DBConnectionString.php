<?php
    $db_username = "root";
    $db_password = "mysql";
    $link = mysqli_connect("localhost", $db_username, $db_password, "grocery");
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "";
?>