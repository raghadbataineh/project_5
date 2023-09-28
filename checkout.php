<?php

// include('connection.php');
include('navbar.php');
include ('check_login.php');



if (isset($_POST['place-order-btn'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['email'];
    $user_address = $_POST['address'];
    $user_city = $_POST['city'];
    $zip_code = $_POST['zip-code'];
    $phone = $_POST['phone'];
}

if (!isset($loggedInUserId)) {

}
if (isset($loggedInUserId)) {
	$query = "SELECT user_id FROM users WHERE is_loggedIn = 1";
	$result = mysqli_query($conn, $query);

	$product = mysqli_fetch_assoc($result);
	$user_id = $product['user_id'];
}


if (!empty($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $key => $value) {
        $productName = $value['name'];
        $productPrice = $value['price'];
		
        $productTotal = $value['quantity'] * $value['price'];

        $insertQuery = "INSERT INTO order_products (user_id,product_name, price, total, user_name, user_email, user_address, user_city, zip_code, phone) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bind_param("isddssssii",$user_id, $productName, $productPrice, $productTotal, $user_name, $user_email, $user_address, $user_city, $zip_code, $phone);
try {
    $stmt->execute();
    echo "<h2 style='text-align:center'>Order placed successfully!</h2>";
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
		
        
    }
} else {
    echo "No products in the cart!";
}

// Close the database connection
$conn->close();



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
					.primary-btn {
			display: inline-block;
			padding: 10px 20px;
			background-color: #3498db;
			color: white;
			text-decoration: none;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.primary-btn:hover {
			background-color: #2980b9;
		}
				</style>

    </head>
	<body>
		

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
					<form action="checkout.php" method="post">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="user_name" placeholder="Name">
							</div>
							
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" placeholder="Phone">
							</div>
							<div class="form-group">
								
							</div>
							<?php 

if (isset($loggedInUserId)) {
	echo'<input type="submit" name="place-order-btn" class="primary-btn order-submit">';
} else{
	echo '<a href="./login/login.php" class="primary-btn sign-in-button">Please sign in</a>';

}
?>
						</div>
					</form>

						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								
							</div>
							
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<?php
if (!empty($_SESSION['products'])) {
    // Display the order details section only once
    echo '<div class="col-md-5 order-details">
            <div class="section-title text-center">
                <h3 class="title">Your Order</h3>
            </div>
            <div class="order-summary">
                <div class="order-col">
                    <div><h3>PRODUCT</h3></div>
                    <div><h3>PRICE</h3></div>
                </div>
                <div class="order-products">';
    
    // Loop through each product in the session
	$total=0;
    foreach ($_SESSION['products'] as $key => $value) {
        // Display individual product information

		  $productTotal = $value['quantity'] * $value['price'];
                    $total += $productTotal;
        echo '<div class="order-col">
                <div><h5 class="product-name" style="text-align:left">' . $value['name'] . '</h5></div>
                <div><h5 class="product-name" style="text-align:right">' . $value['price'] . ' $</h5></div>
              </div>';
    }
    
    // Complete the order details section
    echo '  </div>
            <div class="order-col">
                <div>Shiping</div>
                <div><strong>FREE</strong></div>
            </div>
            <div class="order-col">
                <div><strong>TOTAL</strong></div>
				<div><strong class="order-total">' . $total .' $</strong></div>

            </div>
        </div>
        <div class="payment-method">
            <!-- Payment method options here -->
        </div>
        <div class="input-checkbox">
            <!-- Checkbox for terms and conditions -->
        </div>
		<div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Cash
                                </label>
                                <div class="caption">
                                    <p>You will pay cash when you recive your order.</p>
                                </div>
                            </div>

    </div>
	
	'
	;
	
}
?>

				

					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<?php 
		include ('footer.php');
		?>

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	

</body>
</html>
