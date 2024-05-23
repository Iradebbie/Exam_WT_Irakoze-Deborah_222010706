<?php
error_reporting(0);
// Fetch data from the lectures table
include_once("../connection/connection.php");

$sql = "SELECT * FROM lecture order by id desc";
$result = $conn->query($sql);
$x = 0;

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $x++;
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["Full_name"]."</td>";
        echo "<td>".$row["phone_number"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["Adress"]."</td>";
        echo "<td>".$row["gender"]."</td>";
        echo "<td>".$row["status"]."</td>";
        echo "<td>".$row["age"]."</td>";
        echo "<td><img src='" . $row["image"] . "' class='rounded-image' onclick='viewImage(\"" . $row["image"] . "\")'></td>"; // Added onclick event to view image
        echo "<td>".$row["date"]."</td>";
        echo "<td><a onclick='viewImage(\"" . $row["image"] . "\")' data-id='".$row["id"]."' class='btn btn-primary btn-sm'>Profile</a>|<a class='updateData' data-id='".$row["id"]."' class='btn btn-primary btn-sm'>Update</a> | <a class='deleteData' data-id='".$row["id"]."' href='#'class='btn btn-primary btn-sm'>Delete</a></td>"; // Action buttons
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>No records found</td></tr>";
}
?>
<script> 
    $(document).ready(function(){
        // Open modal with lecture form on Update link click
        $('.updateData').click(function(){
            var id = $(this).data('id');
            uni_modal("", "lectureForm.php?id=" + id);
        });

        // Delete action
        $('.deleteData').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(confirm("Are you sure you want to delete this record?")){
                $.ajax({
                    url: "delete_lecture.php?id=" + id,
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

        // Function to view image in modal
        window.viewImage = function(src) {
            start_loader();
            var view;
            var t = src.split('.');
            t = t[1];
            if (t == 'mp4') {
                view = $("<video src='"+ src +"' controls autoplay></video>");
            } else {
                view = $("<img src='"+ src +"' />");
            }
            $('#viewer_modal .modal-content video, #viewer_modal .modal-content img').remove();
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
