<?php
// Include database connection
include('connection.php');
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $review_text = $_POST["review"];
    $product_id = $_POST["product_id"]; // Assuming you're still using product_id in the URL parameter
    $user_id = $_POST['user_id'];

    // Insert the review data into the database
    $insert_sql = "INSERT INTO review (product_id, user_id, rating, review_text, review_date)
                    VALUES ('$product_id', '$user_id', '$rating', '$review_text', NOW())";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Review submitted successfully!";
        header('Location: ./product.php?product_id=' . $_POST["product_id"]);

    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}
?>
