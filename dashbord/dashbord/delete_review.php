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
$sql = "SELECT review.*, products.products_name
        FROM review
        JOIN products ON review.product_id = products.product_id";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $review_id = $_POST["review_id"];
    
    // Perform a DELETE query to remove the product with the given review_id
    $deleteQuery = "DELETE FROM review WHERE review_id = $review_id";
    
    if ($conn->query($deleteQuery) === TRUE) {
        echo '<script>alert("Product deleted successfully!");</script>';
        header("Location: Tables_review.php");
        exit();
            } else {
        echo "Error deleting product: " . $conn->error;
    }
}
$conn->close();
?>
