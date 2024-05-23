<?php
session_start();
include_once("./connection/connection.php");

if(isset($_SESSION['valid'])){
    $course_Id = $_POST['courseId'];
    $course_name = $_POST['courseName'];
    $user_id = $_SESSION['id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    // Check if the product is already in the cart
    $check_query = "SELECT * FROM cart WHERE course_Id = '$course_Id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) > 0){
        // Product is already in the cart
        echo json_encode(array("status" => "error", "msg" => "Product already added to cart."));
    }else{
        // Insert the product into the cart
        $sql = "INSERT INTO cart (course_Id, course_name, user_id, price, quantity,image) VALUES ('$course_Id', '$course_name', '$user_id', '$price', '$quantity','$image')";
        if(mysqli_query($conn, $sql)){
            echo json_encode(array("status" => "success", "cart_count" => $_SESSION['id'] + 1));
        }else{
            echo json_encode(array("status" => "error", "msg" => "Failed to add product to cart."));
        }
    }
}else{
    echo json_encode(array("status" => "error", "msg" => "User not logged in."));
}
?>
