<?php
include_once("connection/connection.php");

if(isset($_POST['full_name']) && isset($_POST['phone_number']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['gender']) && isset($_POST['status']) && isset($_POST['age']) && isset($_FILES['image'])){
    $full_name = $_POST['full_name'];
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
    
    // Check if lecture_id is "Auto" or not
    if($_POST['lecture_id'] == 'Auto'){
        // Insert data into database
        $sql = "INSERT INTO lecture (Full_name, phone_number, email, Adress, gender, status, age, image) VALUES ('$full_name', '$phone_number', '$email', '$address', '$gender', '$status', '$age', '$upload_path')";
        if($conn->query($sql) === TRUE){
            // Upload image file
            move_uploaded_file($file_tmp, $upload_path);
            echo json_encode(array("status" => "success"));
            header('location:./?p=manageLecture&message=insert');

        } else {
            echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
        }
    } else {
        // Update data in database
        $lecture_id = $_POST['lecture_id'];
        $sql = "UPDATE lecture SET Full_name='$full_name', phone_number='$phone_number', email='$email', Adress='$address', gender='$gender', status='$status', age='$age'";
        if($file_name != ''){
            // If a new image is uploaded, update the image field
            $sql .= ", image='$upload_path'";
            // Upload new image file
            move_uploaded_file($file_tmp, $upload_path);
        }
        $sql .= " WHERE id='$lecture_id'";
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
