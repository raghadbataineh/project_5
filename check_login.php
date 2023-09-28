<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === "logout") {
    // Update the is_loggedIn value for all users to 0

    $updateQuery = "UPDATE users SET is_loggedIn = 0";
    mysqli_query($conn, $updateQuery);
    
}

// Check if there's a logged-in user
$query = "SELECT * FROM users WHERE is_loggedIn = 1";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}


// If a logged-in user is found
if (mysqli_num_rows($result) > 0) {
    $loggedInUser = mysqli_fetch_assoc($result);

    // Now you can use the $loggedInUser array to access the logged-in user's data
    $loggedInUserId = $loggedInUser['user_id'];
    $loggedInUserName = $loggedInUser['user_name'];
    $loggedInUserEmail = $loggedInUser['user_email'];
    $loggedInUserImg = $loggedInUser['user_img'];
    $loggedInUserPhone = $loggedInUser['user_phone'];
    $loggedInUserRole = $loggedInUser['user_role'];
    $loggedInUserLocation = $loggedInUser['user_location'];

} 
?>