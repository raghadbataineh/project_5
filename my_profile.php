<?php
include ('navbar.php');
include './check_login.php';
	if (!isset($loggedInUserId)) {	
		header("Location: ../login/login.php");
	}



//    session_start();

// login area 



// checkUserExistence


function checkUserExistence($conn, $uemail, $uphone, $loggedin_id)
{
    $sql = "SELECT user_id, user_email, user_phone FROM users";
    $result = $conn->query($sql);

    while ($user = $result->fetch_assoc()) {
        if ($user["user_email"] == $uemail && $user["user_id"] !== $loggedin_id) {
            $_SESSION["errMsgEM"] = "Email Already Exists";
        }

        if ($user["user_phone"] == $uphone && $user["user_id"] !== $loggedin_id) {
            $_SESSION["errMsgPH"] = "Phone already exists";
        }
    }

    if (isset($_SESSION["errMsgEM"])) {
        header('Location: my_profile.php');
        exit();
    }
	if (isset($_SESSION["errMsgPH"])) {
        header('Location: my_profile.php');
        exit();
    }
}




$image="";
  
  
  $user_id = mysqli_real_escape_string($conn, $loggedInUserId);
  $query = "SELECT * FROM users WHERE user_id='$user_id' ";
  $query_run = mysqli_query($conn, $query);

  if(mysqli_num_rows($query_run) > 0)
  {
	  $user = mysqli_fetch_array($query_run);
  }

$sub="";
if(isset($_POST['submit'])){

 $user_name=$_POST ['user_name'];
 $user_email=$_POST['email'];
 $user_address=$_POST['address'];
 $id=$_POST['user_id'];
 $user_phone=$_POST['phone'];
 $loggedin_id = $loggedInUserId;

 if (!empty($_FILES['image']['tmp_name'])) {
	$image = file_get_contents($_FILES['image']['tmp_name']);
} else {
	$image = $user['user_img'];
}




checkUserExistence($conn, $user_email, $user_phone, $user_id);


    // Update user information
    $sql = "UPDATE users SET  
                user_name='$user_name',
                user_email='$user_email',
                user_img=?,
                user_location='$user_address',
                user_phone='$user_phone' 
            WHERE user_id='$id'";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $image);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $sub = "updated done";
    }



}
elseif(isset($_POST['cancel'])){
header('location: index.php');
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

	<link href="style_profile.css" rel="stylesheet">

	<title>profile</title>
</head>

<body>

	<div class="container mt-5">
		<div class="row gutters">
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
				<div class="card h-100">
					<div class="card-body">
						<!-- action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" -->
						<form method="POST" enctype="multipart/form-data"  id="updateForm">
							<div class="account-settings">
								<div class="user-profile">
									<div class="user-avatar">




									</div>
									<h5 class="user-name">Welcome</h5>

									<h5 class="user-name">
										<?php echo $user['user_name'];?>
									</h5>
									<h6 class="user-name">
										<?php echo $user['user_email'];?>
									</h6>
									<?php echo '<img id="userImg" src="data:image/jpeg;base64,' . base64_encode($user["user_img"]) . '" alt="Image">';?><br><br>


								</div>

							</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
				<div class="card h-100">
					<div class="card-body">

						<div class="row gutters">




							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mb-2 text-primary">Personal Details</h6>
							</div>



							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<input type="hidden" class="form-control" name="user_id" id="fullName"
									placeholder="Enter full name" value=<?php echo $user['user_id']; ?>>
								<div class="form-group">






									<label for="fullName">Full Name</label>
									<input type="text" class="form-control" name="user_name" id="uname"
										placeholder="Enter full name" value="<?php echo  $user['user_name'];?>">
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="eMail">Email</label>
									<input type="email" class="form-control" name="email" id="email"
										placeholder="Enter email ID" value=<?php echo $user['user_email']; ?>>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" name="phone" id="phone"
										placeholder="Enter phone number" value=<?php echo $user['user_phone']; ?>>
								</div>
							</div>

			


							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="phone">Image</label>
									<input type="file" class="form-control" name="image" id="image" accept="image/*">
								</div>
							</div>
							





						</div>
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<h6 class="mt-3 mb-2 text-primary">Address</h6>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="Street">Address</label>
									<input type="name" class="form-control" name="address" id="Street"
										placeholder="Enter Street" value=<?php echo $user['user_location']; ?>>
								</div>
							</div>


						</div><br>
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<span><?php
	if (isset($_SESSION["errMsgEM"])) {
		echo "<small style='font-size: 12px' class='signup-signin-error'> " . $_SESSION["errMsgEM"] . "</small>";
	}
	if (isset($_SESSION["errMsgPH"])) {
		echo "<br><small style='font-size: 12px' class='signup-signin-error'> " . $_SESSION["errMsgPH"] . "</small>";
	}
	session_destroy();
	?></span>



								<div class="text-right">
									<button type="submit" id="submit" name="cancel"
										class="btn btn-secondary">Cancel</button>
									<button type="submit" id="submit" name="submit"
										class="btn btn-primary">Update</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>

let updateForm = document.getElementById("updateForm");

let regexName = /^[a-zA-Z ]{8,}$/;
let regexUsername = /^[A-Za-z0-9_]+$/;
let regexEmail = /^[A-Za-z0-9._%+-]+@(?:[A-Za-z0-9-]+\.)+(?:com|net|org|edu|ru|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$/i;
let regexPhoneNumber = /^(\+\d{1,3})?\d{10}$/;

// Handle form submission
function handleSubmit(e) {
  e.preventDefault();

  let username = document.getElementById("uname").value;
  let email = document.getElementById("email").value;
  let phone = document.getElementById("phone").value;

  checkInputs( username, email, phone);
}

updateForm.addEventListener("submit", handleSubmit);

function checkInputs( username, email, phone) {
  let errorMessage = '';

  if (username == "") {
    errorMessage = "Don't forget to fill in all the fields";
  }
  else if (!regexName.test(username)) {
    errorMessage = "Name must only contain letters and at least 8 characters";
  }
  else if (!regexEmail.test(email)) {
    errorMessage = "Email is invalid";
  }
  else  if (!regexPhoneNumber.test(phone)) {
    errorMessage = "Phone invalid";
  }


	if (errorMessage !== '') {
    preventSubmittion(errorMessage);
  } else {
    updateForm.removeEventListener("submit", handleSubmit);
    updateForm.submit();
  }
}
function preventSubmittion(errorMessage) {
  if (errorMessage !== '') {
    Swal.fire({
      icon: 'info',
      title: 'Update info Failed',
      text: errorMessage,
      footer: 'Fix the issue and try again'
    })
  }
}

	</script>
		<?php include ('footer.php'); ?>

</body>

</html>

