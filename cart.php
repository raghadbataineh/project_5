<?php

// include('connection.php');
include('navbar.php');
include ('check_login.php');



if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = array();
}

if (isset($_POST['add-to-cart-btn'])) {
    $product_id = $_POST['product_id']; // Get the product ID from the form data

    // Check if the product is not already in the cart
    $product_in_cart = false;
    foreach ($_SESSION['products'] as $product) {
      
    }

    // $product_id=$_GET['product_id'];
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
    
                    
              
    
    
        } else {
            echo "<h2 style='text-align:center'>Please log in to add products to your cart.</h2>";
        }
          // Close the statement


    


    if (!$product_in_cart) {
        $product_data = array(
            'product_id' => $product_id,
            
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
        );

        // Add the product data to the 'products' session array
        $_SESSION['products'][] = $product_data;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
.cart-icon {
    position: relative;
}

.cart-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 4px 8px;
    font-size: 12px;
}
.checkout-button {
    margin: 40px;
    text-align: right; 

}

.checkout-button .btn-primary {

    background-color: #007bff; 
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease-in-out;
}

.checkout-button .btn-primary:hover {
    background-color: #0056b3; 
}

</style>
  </head>
  <body>

<!-- Start shopping cart -->
<div class="container-fluid">
		
        </div>
        </div>
    </div>
    
  
    <div class="col-md-12">
        <h2>Cart items</h2>
        <?php 
         echo "
         <table class='table table-bordered table-striped '>
         <tr>
         <th > Item Image</th>
         <th> Item Name</th>
       
         
         <th> Item Quantity</th>
         <th> Item Price</th>
         <th> Action</th>
         </tr>"; 
     
         
         $total = 0; 
         if (!empty($_SESSION['products'])) {
            foreach ($_SESSION['products'] as $key => $value) {
                $query = "SELECT products_img FROM products WHERE product_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $value['product_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $productRow = $result->fetch_assoc();
                
                echo "
                <tr>
                <td><img src='data:image/png;base64," . base64_encode($productRow["products_img"]) . "' height='50px' width='50px' alt='Image'></td>

                <td>" . ($value['name'] ?? '') . "</td>
                
                <td>
                <input type='number' name='quantity[" . $value['product_id'] . "]' value='" . $value['quantity'] . "' min='1'>
            </td>
                <td>" . ($value['price'] *$value['quantity']?? '') . "</td>
                <td> 
                    <a href='cart.php?action=remove&product_id=" . ($value['product_id'] ?? '') . "'>
                    <button class='btn btn-danger '>Remove</button>
                    </a>
                </td>
                
                </tr>";



                if ($value !== null && isset($value['quantity']) && isset($value['price'])) {
                    $total += $value['quantity'] * $value['price'];
                }						}

            echo "
            <tr>
            <td colspan='2'> </td>
            <td > </b>Total price </b> </td>
            <td > " . number_format($total , 2) ." </td>
            <td> 
                    <a href='cart.php?action=clearall'>
                    <button class='btn btn-warning '>Clear All</button>
                    </a>
                </td>
            
            </tr>
            ";
        }
        
             
    
         echo "</table>"; 


            
        ?>
    </div>
</div>

</div>
</div>
<div class="checkout-button">
<a href="checkout.php" class="btn btn-primary">Proceed to checkout</a>

</div>
<?php 
if (isset($_GET['action'])) {
if ($_GET['action'] == 'clearall') {
unset($_SESSION['products']);

}
if ($_GET['action'] == 'remove' && isset($_GET['product_id'])) {
foreach ($_SESSION['products'] as $key => $value) {
    if ($value['product_id'] == $_GET['product_id']) {
        unset($_SESSION['products'][$key]);
        // Re-index the array to avoid gaps in keys
        $_SESSION['products'] = array_values($_SESSION['products']);
        
    }
}
}
}


?>


<!-- End shopping cart -->


      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <?php 
  include('footer.php');
  ?>


</body>
</html>