<?php
include('../database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["loginEmail"];
    $password = $_POST["loginPassword"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, user_email, user_password, user_role, user_img FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $flag = false;
    $user_id = null;
    $user_role = null;
    $user_img = null;

    while ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user["user_password"])) {
            $flag = true;
            $user_id = $user["user_id"];
            $user_role = $user["user_role"];
            $user_img = $user["user_img"];
            break;
        }
    }

    $stmt->close();

    if ($flag) {
        // Update the user's is_loggedIn column to 1
        $updateStmt = $conn->prepare("UPDATE users SET is_loggedIn = 1 WHERE user_id = ?");
        $updateStmt->bind_param("i", $user_id);
        $updateStmt->execute();
        $updateStmt->close();

        // Check and upload default image if user_img is empty
        if (empty($user_img)) {
            $defaultImagePath = './default-image.jpg';
            if (file_exists($defaultImagePath)) {
                // Read the image as binary data
                $defaultImageBinary = file_get_contents($defaultImagePath);

                // Update user_img column with default image
                $imgUpdateStmt = $conn->prepare("UPDATE users SET user_img = ? WHERE user_id = ?");
                $imgUpdateStmt->bind_param("bi", $defaultImageBinary, $user_id);
                $imgUpdateStmt->send_long_data(0, $defaultImageBinary);
                $imgUpdateStmt->execute();
                $imgUpdateStmt->close();
            }
        }

        // Redirect based on user role
        if ($user_role === "admin") {
            header('Location: ../dashbord/Tables_users.php');
        } elseif ($user_role === "user") {
            header('Location: ../index1.php');
        } else {
            // Handle other user roles as needed
            header('Location: ../index1.php'); // Default fallback
        }

        exit();
    } else {
        $_SESSION["loginError"] = "Email or Password incorrect";
        header('Location: login.php');
        exit();
    }

    $conn->close();
}
?>
