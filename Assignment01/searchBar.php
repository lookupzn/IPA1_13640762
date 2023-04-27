<?php
error_reporting(E_ERROR | E_PARSE);
include 'DBConnectionString.php';
$keywords = $_GET['keywords'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];
// Create a query based on the input
$query = "SELECT * FROM products WHERE 1";
if (!empty($keywords)) {
    $keywordsArray = explode(' ', $keywords);
    foreach ($keywordsArray as $keyword) {
        $query .= " AND product_name LIKE '%" . mysqli_real_escape_string($link, $keyword) . "%'";
    }
}
if (!empty($minPrice)) {
    $query .= " AND unit_price >= " . mysqli_real_escape_string($link, $minPrice);
}
if (!empty($maxPrice)) {
    $query .= " AND unit_price <= " . mysqli_real_escape_string($link, $maxPrice);
}
$result = mysqli_query($link, $query);
// Display the results
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Product ID</th>";
    echo "<th>Product Name</th>";
    echo "<th>Price</th>";
    echo "<th>Unit Quantity</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['unit_price'] . "</td>";
        echo "<td>" . $row['unit_quantity'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<h3>No results found</h3>";
}
?>
