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
// $sql = "SELECT * FROM users";
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $users = $_POST["user_id"];
    
    // Perform a DELETE query to remove the product with the given user_id
    $deleteQuery = "DELETE FROM users WHERE user_id = $users";
    
    if ($conn->query($deleteQuery) === TRUE) {
        echo '<script>alert("user deleted successfully!");</script>';
        header("Location: Tables_users.php");
        exit();
            } else {
        echo "Error deleting product: " . $conn->error;
    }
}
$conn->close();
?>
