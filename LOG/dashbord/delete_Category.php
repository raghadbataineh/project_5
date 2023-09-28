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
// $sql = "SELECT * FROM Category";
$sql = "SELECT * FROM Category";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Category_id = $_POST["Category_id"];
    
    // Perform a DELETE query to remove the product with the given Category_id
    $deleteQuery = "DELETE FROM Category WHERE Category_id = $Category_id";
    
    if ($conn->query($deleteQuery) === TRUE) {
        echo '<script>alert("Product deleted successfully!");</script>';
        header("Location: Tables_Category.php");
        exit();
            } else {
        echo "Error deleting product: " . $conn->error;
    }
}
$conn->close();
?>
