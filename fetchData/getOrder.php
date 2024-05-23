<?php
error_reporting(0);
// Fetch data from the lectures table
include_once("../connection/connection.php");

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['studentId']}</td>
                <td>{$row['courseName']}</td>
                <td>{$row['courseId']}</td>
                <td>{$row['date_']}</td>
                
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No orders found</td></tr>";
}
?>
