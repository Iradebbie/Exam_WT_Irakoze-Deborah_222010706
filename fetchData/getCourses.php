<?php
error_reporting(0);
// Fetch data from the courses table
include_once("../connection/connection.php");

$sql = "SELECT * FROM courses order by id desc";
$result = $conn->query($sql);
$x = 0;

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $x++;
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td><img src='" . $row["courseImage"] . "' class='rounded-image' onclick='viewImage(\"" . $row["courseImage"] . "\")'></td>"; // Added onclick event to view full-size image
        echo "<td>".$row["course_name"]."</td>";
        echo "<td>".$row["course_category"]."</td>";
        echo "<td>".$row["course_price"]."</td>";
        echo "<td>".$row["course_decription"]."</td>";
        echo "<td>".$row["lecture_ID"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td><a class='updateData' data-id='".$row["id"]."' class='btn btn-primary btn-sm'>Update</a> | <a class='deleteData' data-id='".$row["id"]."' class='btn btn-primary btn-sm'>Delete</a></td>"; // Action buttons
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}
?>

<script> 
    $(document).ready(function(){
        // Open modal with course form on Update link click
        $('.updateData').click(function(){
            var id = $(this).data('id');
            uni_modal("", "courseForm.php?id=" + id);
        });

        // Delete action
        $('.deleteData').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(confirm("Are you sure you want to delete this record?")){
                $.ajax({
                    url: "delete_course.php?id=" + id,
                    method: "GET",
                    success: function(resp){
                        if(resp.status == 'success'){
                            alert("Record deleted successfully");
                            // Reload the page or do any other action
                            location.reload();
                        } else {
                            alert("Record deleted successfully");
                        }
                    },
                    error: function(xhr, status, error){
                        alert("An error occurred while deleting the record");
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Function to view full-sized image in modal
        window.viewImage = function(src) {
            start_loader();
            var view = $("<img src='"+ src +"' class='full-image'>");
            $('#viewer_modal .modal-content img').remove();
            $('#viewer_modal .modal-content').append(view);
            $('#viewer_modal').modal({
                show: true,
                backdrop: 'static',
                keyboard: false,
                focus: true
            });
            end_loader();
        }
    });
</script>
