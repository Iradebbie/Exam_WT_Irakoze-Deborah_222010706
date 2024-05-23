<?php include_once("./connection/connection.php"); ?>

<div class="page">
    <div class="left">
        <h1> Categories</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Categories</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul>
    </div>
    <a id="create_category" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Add New Category</span>
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
        <h2>All Categories</h2>
        <a href="#" class="btn">View All</a>
    </div>

    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Category</td>
                <td>Description</td>
                <td>Status</td>
                <td>Date Created</td>
            </tr>
        </thead>

        <tbody>
            <?php include_once("fetchData/getCategory.php"); ?>
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
</style>

<script>
    $('#updateData').click(function(){
        uni_modal("", "categoryForm.php?id=1")
    });

    // Function to fetch and update category data
    function updateCategoryData() {
        $.ajax({
            url: "fetchData/getCategory.php",
            method: "GET",
            success: function(data) {
                // Update the table body with the fetched data
                $('.DataTable tbody').html(data);
            },
            error: function(xhr, status, error){
                console.log("An error occurred while fetching category data.");
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
        updateCategoryData();
        hideLoadingImage();
    }, 3000);

    // Open categoryForm.php when "Add New Category" button is clicked
    $('#create_category').click(function(){
        uni_modal("", "categoryForm.php")
    });
</script>
