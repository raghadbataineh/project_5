<?php 
// include ('connection.php');
include ('navbar.php');
include ('check_login.php');


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
    .cta-btn {
        background-color: white;
        color:black;
        border-radius: 10%;
        padding: 10px;
        margin-top: 100px;
        transition: background-color 0.3s, transform 0.3s;
		
    }

    .cta-btn:hover {
        background-color: #7895CB;
		font-weight: bolder;
        transform: scale(1.05);
    }
</style>

    </head>
	<body>
		

		




		
		
				


		<div class="row">
    <?php
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        ?>
		<!--  -->
        <div class="col-md-4 col-xs-6">
            <div class="shop" style="padding: 10px; text-align: center;">
                <div class="shop-img">
				<img src="data:image/jpeg;base64,<?=base64_encode($row["Category_img"])?>" style="height: 270px; width: 70%;" alt="shirt">
                </div>
                <div class="shop-body">
                    <h5 style="font-size: 20px; margin: 10px 0;"><?= $row['Category_name'] ?></h5>
                    <form action="store.php?Category_id=<?= $row['Category_id'] ?>" method="post">
                        <input type="hidden" name="Category_id" value="<?= $row['Category_id'] ?>">
                        <input type="hidden" name="Category_name" value="<?= $row['Category_name'] ?>">
                        <button type="submit" class="cta-btn" style="color: black;">Shop now <i class="fa fa-arrow-circle-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
   
					<!-- /shop -->

					<!-- shop -->
					
		<!-- /SECTION -->

		

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="store.php">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top selling</h3>
							
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="./img/product06.png" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Laptops</p>
												<h3 class="product-name"><a href="#">Lenovo Laptop</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"> <a href="store.php">View more</a></button>
											</div>
										</div>
										<!-- /product -->

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="./img/product02.png" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Accessories</p>
												<h3 class="product-name"><a href="#">Headset for gaming</a></h3>
												<h4 class="product-price">$20.00 </h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
											
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"> <a href="store.php">View more</a></button>
											</div>
										</div>
										<!-- /product -->

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="./img/product08.png" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Laptops</p>
												<h3 class="product-name"><a href="#">Dell Laptop</a></h3>
												<h4 class="product-price">$1200.00 </h4>
												<div class="product-rating">
												</div>
											
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"> <a href="store.php">View more</a></button>
											</div>
										</div>
										<!-- /product -->

										

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="./img/product09.png" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Cameras</p>
												<h3 class="product-name"><a href="#">HD Camera</a></h3>
												<h4 class="product-price">$280.00 </h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><a href="store.php">View more</a> </button>
											</div>
										</div>
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		
		

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
