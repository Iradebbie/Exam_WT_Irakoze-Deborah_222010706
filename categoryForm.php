<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
    .error-message {
        color: red;
    }
    .error-border {
        border: 1px solid red !important;
    }
</style>

<?php 
include_once("./connection/connection.php");
$category_id = "Auto";
$category = "";
$description = "";
$status = "";
$date_created = "";

if(isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id = $category_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $category = $row['category'];
        $description = $row['description'];
        $status = $row['status'];
        $date_created = $row['date_created'];
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <h3 class="float-right">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h3>
        <div class="col-lg-12">
            <h3 class="text-center"><?php echo isset($_GET['id']) ? 'Edit Category' : 'Add Category'; ?></h3>
            <hr>
            <form id="category-form">
                <div class="form-group">
                    <label for="category_id">ID</label>
                    <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $category_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>">
                    <div class="error-message" id="category_error"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
                    <div class="error-message" id="description_error"></div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>">
                    <div class="error-message" id="status_error"></div>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-flat"><?php echo isset($_GET['id']) ? 'Update' : 'Add'; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#category-form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            var error = false;
            $('.error-message').html('');
            form.find('input, textarea').removeClass('error-border');
            
            // Check for empty fields
            form.find('input, textarea').each(function(){
                if($(this).val() == ''){
                    var fieldName = $(this).attr('name');
                    $('#' + fieldName + '_error').html('This field is required.');
                    $(this).addClass('error-border');
                    error = true;
                }
            });

            if(!error){
                start_loader();
                $.ajax({
                    url: "submit_category.php<?php echo isset($_GET['id']) ? '?id=' . $category_id : ''; ?>",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(resp){
                        if(resp.status == 'success'){
                            alert_toast("Category saved successfully", 'success');
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        } else {
                            alert_toast("An error occurred", 'error');
                            console.log(resp);
                        }
                        end_loader();
                        form[0].reset();
                    },
                    error: function(xhr, status, error){
                        alert_toast("An error occurred", 'error');
                        console.log(xhr.responseText);
                        end_loader();
                    }
                });
            }
        });
    });
</script>
