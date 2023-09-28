<?php   
include("connection.php");
$product_id=$_GET['product_id'];
if (isset($_POST['add-to-cart-btn'])) {
		$quantity=$_POST['quantity'];
		$product_name=($_POST['name']);
		$product_price=$_POST['price'];
		

        // Get the logged-in user's ID
        $query = "SELECT user_id FROM users WHERE is_loggedIn = 1";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);
        $user_id = $product['user_id'];
        

            $insertQuery = "INSERT INTO cart (quantity,product_name,user_id,product_id, products_price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("isiii", $quantity, $product_name, $user_id, $product_id, $product_price);

           

                $stmt->execute();

				header("location:cart.php?product_id=$_GET[product_id]");
				exit();
          


    } else {
        echo "<h2 style='text-align:center'>Please log in to add products to your cart.</h2>";
    }
	  // Close the statement

?>