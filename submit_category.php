<?php
include_once("./connection/connection.php");

$response = array('status' => 'error', 'message' => 'An error occurred');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($category != '' && $description != '' && $status != '') {
        if ($category_id == 'Auto') {
            // Insert new category
            $sql = "INSERT INTO categories (category, description, status) VALUES ('$category', '$description', '$status')";
        } else {
            // Update existing category
            $sql = "UPDATE categories SET category='$category', description='$description', status='$status' WHERE id='$category_id'";
        }

        if ($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'Category saved successfully';
        } else {
            $response['message'] = 'Error: ' . $conn->error;
        }
    } else {
        $response['message'] = 'Please fill all the required fields';
    }
}

echo json_encode($response);
?>
