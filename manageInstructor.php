<?php include_once("./connection/connection.php"); ?>

<div class="page">
    <div class="left">
        <h1> Instructors</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Instructors</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul> 
    </div>
    <a id="create_instructor" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Add New Instructor</span>
    </a>
</div>

<?php if(isset($_GET['message']) && ($_GET['message'] == 'edit' || $_GET['message'] == 'insert')): ?>
    <div id="successMessage" class="success-message">Record <?php echo $_GET['message']; ?>ed successfully!</div>
<?php elseif(isset($_GET['message']) && $_GET['message'] == 'delete'): ?>
    <div id="successMessage" class="success-message">Record deleted successfully!</div>
<?php endif; ?>

<!-- Loading image -->
<div id="loadingImage" class="loading-image">
    <img src="myImages/loading__.gif" alt="Loading...">
</div>

<div class="DataTable" style="display: none;">
    <div class="cardHeader">
        <h2>All Instructors</h2>
        <a href="#" class="btn">View All</a>
    </div>

    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Full Name</td>
                <td>Phone Number</td>
                <td>Email</td>
                <td>Address</td>
                <td>Gender</td>
                <td>Status</td>
                <td>Age</td>
                <td>Image</td>
                <td>Date</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php include_once("fetchData/getInstructor.php"); ?>
        </tbody>
    </table>
</div>

<style>
    .success-message {
        opacity: 1;
        background-color: lightgreen;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .loading-image {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        display: block;
    }

    .loading-image img {
        width: 100px;
        height: 100px;
    }
    .rounded-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
</style>

<script> 
    // Function to fetch and update instructor data
    function updateInstructorData() {
        $.ajax({
            url: "fetchData/getInstructor.php",
            method: "GET",
            success: function(data) {
                // Update the table body with the fetched data
                $('.DataTable tbody').html(data);
            },
            error: function(xhr, status, error){
                console.log("An error occurred while fetching instructor data.");
            }
        });
    }

    // Show loading image initially
    var loadingImage = document.getElementById('loadingImage');
    var dataTable = document.querySelector('.DataTable');

    // Function to show loading image
    function showLoadingImage() {
        loadingImage.style.display = 'block';
        dataTable.style.display = 'none';
    }

    // Function to hide loading image
    function hideLoadingImage() {
        loadingImage.style.display = 'none';
        dataTable.style.display = 'block';
    }

    // Call the function to fetch and update data every 3 seconds
    setInterval(function() {
        showLoadingImage();
        updateInstructorData();
        hideLoadingImage();
    }, 3000);

    // Open instructorForm.php when "Add New Instructor" button is clicked
    $('#create_instructor').click(function(){
        uni_modal("","instructorForm.php")
    });
</script>
