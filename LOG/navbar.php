
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

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
				<?php
					
					if (isset($loggedInUserId)) {
						
						echo '<ul class="header-links pull-left">';
						echo '<form method="post" style="display: inline;" >'; 
						echo '<input type="hidden" name="action" value="logout">';
						echo '<button type="submit" class="btn btn-danger" style="margin: 15px; " >Logout</button>';
						echo '</form>';		
						echo '<li>' .'<img class="rounded-circle" src="data:image/jpeg;base64,' . base64_encode($loggedInUserImg) . '" style="  height: 50px; width: 50px; border-radius: 50%;" alt="Image">'.'</li>';        
						echo '<li><a href="./my_profile.php"><b> '.$loggedInUserName .'</b></a></li>';
						echo '</ul>';
					} else {


						echo '<a href="login/login.php" class="btn btn-danger pull-left"><b>Log in</b></a>';
					}
					
					?>




					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-phone"></i> +962-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> Electro@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Irbid-Jordan</a></li>
					</ul>
					
				</div>
			</div>
			<!-- /TOP HEADER -->
			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->
						<!-- ACCOUNT -->
						<div class="col-md-9 clearfix"> 
							<div class="header-ctn">
							<!-- Contact Us Link -->
							<div class="about-link">
                                    <a href="index1.php">Home</a>
                            </div>
								<div class="contact-link">
                                    <a href="contactus.php">Contact Us</a>
                                </div>
                    
                            <!-- About Us Link -->
                                    <div class="about-link">
                                    <a href="aboutus.php">About Us</a>
                            </div>

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- Cart -->
								<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<?php 
								$num_items_in_cart = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;
										?>
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>

									<!-- drop down menu that contains products,quantity,total -->
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- end of cart drop down menu -->
								<!-- /Cart -->

								
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		