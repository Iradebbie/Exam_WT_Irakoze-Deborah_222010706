<?php
include_once("connection/connection.php");

if(isset($_POST['fulls_name']) && isset($_POST['phone_number']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['gender']) && isset($_POST['status']) && isset($_POST['age']) && isset($_FILES['image'])){
    $fulls_name = $_POST['fulls_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];
    $age = $_POST['age'];

    // File upload
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $upload_path = 'uploads/' . $file_name;
    
    // Check if instructor_id is "Auto" or not
    if($_POST['instructor_id'] == 'Auto'){
        // Insert data into database
        $sql = "INSERT INTO instructor (fulls_name, phone_number, Email, Adress, gender, status, age, image) VALUES ('$fulls_name', '$phone_number', '$email', '$address', '$gender', '$status', '$age', '$upload_path')";
        if($conn->query($sql) === TRUE){
            // Upload image file
            move_uploaded_file($file_tmp, $upload_path);
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
        }
    } else {
        // Update data in database
        $instructor_id = $_POST['instructor_id'];
        $sql = "UPDATE instructor SET fulls_name='$fulls_name', phone_number='$phone_number', Email='$email', Adress='$address', gender='$gender', status='$status', age='$age'";
        if($file_name != ''){
            // If a new image is uploaded, update the image field
            $sql .= ", image='$upload_path'";
            // Upload new image file
            move_uploaded_file($file_tmp, $upload_path);
        }
        $sql .= " WHERE id='$instructor_id'";
        if($conn->query($sql) === TRUE){
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
        }
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid data"));
}
?>
