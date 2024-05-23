<?php
include_once("connection/connection.php");

if(isset($_POST['course_name']) && isset($_POST['course_category']) && isset($_POST['course_price']) && isset($_POST['course_decription']) && isset($_POST['lecture_ID']) && isset($_FILES['courseImage'])){
    $course_name = $_POST['course_name'];
    $course_category = $_POST['course_category'];
    $course_price = $_POST['course_price'];
    $course_decription = $_POST['course_decription'];
    $lecture_ID = $_POST['lecture_ID'];

    // File upload
    $file_name = $_FILES['courseImage']['name'];
    $file_tmp = $_FILES['courseImage']['tmp_name'];
    $upload_path = 'uploads/' . $file_name;
    
    // Check if course_id is "Auto" or not
    if($_POST['course_id'] == 'Auto'){
        // Insert data into database
        $sql = "INSERT INTO courses (course_name, course_category, course_price, course_decription, lecture_ID, courseImage) VALUES ('$course_name', '$course_category', '$course_price', '$course_decription', '$lecture_ID', '$upload_path')";
        if($conn->query($sql) === TRUE){
            // Upload image file
            move_uploaded_file($file_tmp, $upload_path);
            echo json_encode(array("status" => "success"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
        }
    } else {
        // Update data in database
        $course_id = $_POST['course_id'];
        $sql = "UPDATE courses SET course_name='$course_name', course_category='$course_category', course_price='$course_price', course_decription='$course_decription', lecture_ID='$lecture_ID'";
        if($file_name != ''){
            // If a new image is uploaded, update the courseImage field
            $sql .= ", courseImage='$upload_path'";
            // Upload new image file
            move_uploaded_file($file_tmp, $upload_path);
        }
        $sql .= " WHERE id='$course_id'";
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
