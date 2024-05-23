<?php
session_start();
include_once("./connection/connection.php");

if(isset($_GET['f'])){
    switch($_GET['f']){
        case 'empty_cart':
            if(isset($_SESSION['valid'])){
                $user_id = $_SESSION['id'];
                $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
                if(mysqli_query($conn, $sql)){
                    echo json_encode(array("status" => "success"));
                }else{
                    echo json_encode(array("status" => "error", "msg" => "Failed to empty cart."));
                }
            }else{
                echo json_encode(array("status" => "error", "msg" => "User not logged in."));
            }
            break;

        case 'add_enrollment':
            if(isset($_SESSION['valid'])){
                $user_id = $_SESSION['id'];
                $cartItems = $_POST['cartItems'];
                $errors = 0;

                foreach($cartItems as $item) {
                    $course_id = $item['course_Id'];
                    $course_name = $item['course_name'];
                    $sql1 = "DELETE FROM cart WHERE user_id = '$user_id'";
 
                    $sql = "INSERT INTO enrollment (studentId, courseName, courseId) VALUES ('$user_id', '$course_name', '$course_id')";
                    $sql2 = "INSERT INTO sales (studentId, courseName, courseId) VALUES ('$user_id', '$course_name', '$course_id')";
                    $sql3 = "INSERT INTO orders (studentId, courseName, courseId) VALUES ('$user_id', '$course_name', '$course_id')";
                    if(!mysqli_query($conn, $sql)){
                        $errors++;
                    }
                    if(!mysqli_query($conn, $sql3)){
                        $errors++;
                    }
                    if(!mysqli_query($conn, $sql1)){
                        $errors++;
                    }
                    if(!mysqli_query($conn, $sql2)){
                        $errors++;
                    }
                }

                if($errors == 0){
                    echo json_encode(array("status" => "success"));
                }else{
                    echo json_encode(array("status" => "error", "msg" => "Failed to add enrollment."));
                }
            }else{
                echo json_encode(array("status" => "error", "msg" => "User not logged in."));
            }
            break;
    }
}
?>
