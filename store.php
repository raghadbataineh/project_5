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

    </head>
	<body>

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index1.php">Home</a></li>
							<li><a href="store.php?show_all=1">All products</a></li>

							
							
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
					<!-- ASIDE -->
					
					<!-- /ASIDE -->
					<!-- store top filter -->
					<div class="store-filter clearfix">
							<!-- Price filter form -->
							<form method="get">
								<label for="min_price">Min Price:</label>
								<input type="number" id="min_price" name="min_price" value="<?= $minPrice ?>">
								<label for="max_price">Max Price:</label>
								<input type="number" id="max_price" name="max_price" value="<?= $maxPrice ?>">
								<input type="submit" value="Apply Filter" style="background-color:#7895CB;padding:5px;border:1px solid #7895CB;color:white ">
							</form>
													
							
							
						</div>
						<!-- /store top filter -->
					<?php 
					$minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
					$maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : 1000; // Adjust this upper limit as needed
					
					// Get the selected sorting order
					$sortOrder = "asc";
					if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sort_order'])) {
						$sortOrder = $_GET['sort_order'];
					}
					
					// Query to retrieve filtered and sorted data from the database
					$sql = "SELECT * FROM products WHERE products_price >= ? AND products_price <= ? ORDER BY products_price $sortOrder";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("ii", $minPrice, $maxPrice);
					$stmt->execute();
					$result = $stmt->get_result();
					if (!isset($_GET['show_all'])){
					if (!isset($_GET['Category_id'])){
					while ($product = mysqli_fetch_assoc($result)) {?>
					<div class="col-md-4 col-xs-6">
								<form action="product.php?product_id=<?=$product['product_id']?>" method="post" class="product-card">
	
									<div class="product">
										<div class="product-img">
										<img src="data:image/jpeg;base64,<?=base64_encode($product["products_img"])?>" style="height: 270px; width: 100%;" alt="shirt">
	
										
										</div>
										<div class="product-body">
											<p class="product-category">Category</p>
											<h5 class="product-name" style="text-align:center"> <?=$product['products_name']?></h5>
											<input type="hidden" name="	product_id " value="<?=$product['product_id']?>">
								<input type="hidden" name="name" value="<?=$product['products_name']?>">
								<input type="hidden" name="price" value="<?=$product['products_price']?>">
								<h6 class="product-name" style="text-align:center"> <?=$product['products_description']?></h6>
								<!-- <input type="number" name="products_quantity"  class="form-control"> -->
	
	
											</form>
											<h5 class="product-price" style="text-align:center"> <?=number_format($product['products_price'],2)?></h5>										<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
	
											</div>
											
										</div>
										<div class="add-to-cart">
										<input type="submit" name="view-btn" class="add-to-cart-btn" value="View Product">
										</div>
									</div>
								</div>
							<?php }}} ?>
							</div>
					<!-- STORE -->

					<div id="aside" class="col-md-3">
						
						


						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="product-widget">
								<div class="product-img">
									<img src="./img/product01.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Laptops</p>
									<h3 class="product-name"><a href="#">HP icore7 </a></h3>
									<h4 class="product-price">$350.00 </h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="./img/product02.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Computer Accessories</p>
									<h3 class="product-name"><a href="#">Gaming Headset</a></h3>
									<h4 class="product-price">$15.00 <del class="product-old-price">$20.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="./img/product1.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Cameras</p>
									<h3 class="product-name"><a href="#">Nikon Camera</a></h3>
									<h4 class="product-price">$450.00 <del class="product-old-price">$500.00</del></h4>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>

					<div id="store" class="col-md-9">
						

						<!-- store products -->
						

						<div class="row">
						<?php 
						if (isset($_GET['show_all']) && $_GET['show_all'] == 1) {
							$query = "SELECT * FROM products";
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_assoc($result)) {?>
								<div class="col-md-4 col-xs-6">
								<form action="product.php?product_id=<?=$row['product_id']?>" method="POST" class="product-card">
	
									<div class="product">
										<div class="product-img">
										<img src="data:image/jpeg;base64,<?=base64_encode($row["products_img"])?>" style="height: 270px; width: 100%;" alt="shirt">
	
										
										</div>
										<div class="product-body">
											<p class="product-category">Category</p>
											<h5 class="product-name" style="text-align:center"> <?=$row['products_name']?></h5>
											<input type="hidden" name="	product_id " value="<?=$row['product_id']?>">
								<input type="hidden" name="name" value="<?=$row['products_name']?>">
								<input type="hidden" name="price" value="<?=$row['products_price']?>">
								<h6 class="product-name" style="text-align:center"> <?=$row['products_description']?></h6>
	
	
											</form>
											<h5 class="product-price" style="text-align:center"> <?=number_format($row['products_price'],2)?></h5>										<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
	
											</div>
											
										</div>
										<div class="add-to-cart">
										<input type="submit" name="view-product-name" class="add-to-cart-btn" value="View Product">
										</div>
									</div>
								</div>
							<?php } 



						}elseif (isset($_GET['Category_id'])) {
							$category_id = $_GET['Category_id'];
							
							// Fetch products related to the selected category
							$query = "SELECT * FROM products WHERE Category_id = ?";
							$stmt = $conn->prepare($query);
							$stmt->bind_param("i", $category_id);
							$stmt->execute();
							$result = $stmt->get_result(); 

							while ($row = $result->fetch_assoc()) {?>
							<!-- product -->
							<div class="col-md-4 col-xs-6">
							<form action="product.php?product_id=<?=$row['product_id']?>" method="post" class="product-card">

								<div class="product">
									<div class="product-img">
									<img src="data:image/jpeg;base64,<?=base64_encode($row["products_img"])?>" style="height: 270px; width: 100%;" alt="shirt">

									
									</div>
									<div class="product-body">
										<p class="product-category"><?=$row['products_name']?></p>
										<h5 class="product-name" style="text-align:center"> <?=$row['products_name']?></h5>
										<input type="hidden" name="	product_id " value="<?=$row['product_id']?>">
							<input type="hidden" name="name" value="<?=$row['products_name']?>">
							<input type="hidden" name="price" value="<?=$row['products_price']?>">
							<h6 class="product-name" style="text-align:center"> <?=$row['products_description']?></h6>


										</form>
										<h5 class="product-price" style="text-align:center"> <?=number_format($row['products_price'],2)?></h5>										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>

										</div>
										
									</div>
									<div class="add-to-cart">
									<input type="submit" name="view-product-name" class="add-to-cart-btn" value="View Product">
									</div>
								</div>
							</div>
							<?php }


							 } ?>
							<!-- /product -->

						

							
						<!-- /store products -->

						
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		
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
