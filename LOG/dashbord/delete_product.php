<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sql = "SELECT * FROM products";
$sql = "SELECT products.*, Category.Category_name
        FROM products
        JOIN Category ON products.Category_id = Category.Category_id";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = $_POST["product_id"];
    
    // Perform a DELETE query to remove the product with the given product_id
    $deleteQuery = "DELETE FROM products WHERE product_id = $product_id";
    
    if ($conn->query($deleteQuery) === TRUE) {
        echo '<script>alert("Product deleted successfully!");</script>';
        header("Location: Tables_product.php");
        exit();
            } else {
        echo "Error deleting product: " . $conn->error;
    }
}
$conn->close();
?>
