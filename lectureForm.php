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
$lecture_id = "Auto";
$full_name = "";
$phone_number = "";
$email = "";
$address = "";
$gender = "";
$status = "";
$age = "";
$image = "";
$date = "";

if(isset($_GET['id'])) {
    $lecture_id = $_GET['id'];
    $sql = "SELECT * FROM lecture WHERE id = $lecture_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $full_name = $row['Full_name'];
        $phone_number = $row['phone_number'];
        $email = $row['email'];
        $address = $row['Adress'];
        $gender = $row['gender'];
        $status = $row['status'];
        $age = $row['age'];
        $image = $row['image'];
        $date = $row['date'];
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
            <h3 class="text-center"><?php echo isset($_GET['id']) ? 'Edit Lecture' : 'Add Lecture'; ?></h3>
            <hr>
            <form id="lecture-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="full_name">ID</label>
                    <input type="text" class="form-control" id="lecture_id" name="lecture_id" value="<?php echo $lecture_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
                    <div class="error-message" id="full_name_error"></div>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">
                    <div class="error-message" id="phone_number_error"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                    <div class="error-message" id="email_error"></div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                    <div class="error-message" id="address_error"></div>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                    <div class="error-message" id="gender_error"></div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>">
                    <div class="error-message" id="status_error"></div>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
                    <div class="error-message" id="age_error"></div>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <div class="error-message" id="image_error"></div>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-flat">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#lecture-form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            var error = false;
            $('.error-message').html('');
            form.find('input, select').removeClass('error-border');
            
            // Check for empty fields
            form.find('input, select').each(function(){
                if($(this).val() == ''){
                    var fieldName = $(this).attr('name');
                    $('#' + fieldName + '_error').html('This field is required.');
                    $(this).addClass('error-border');
                    error = true;
                }
            });

            // Validate image file format
            var fileInput = $('#image');
            var file = fileInput[0].files[0];
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if(file && !allowedExtensions.exec(file.name)){
                $('#image_error').html('Please select a valid image file.');
                fileInput.addClass('error-border');
                error = true;
            }

            if(!error){
                start_loader();
                $.ajax({
                    url: "submit_lecture.php?id=1",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(resp){
                        if(resp.status == 'success'){
                            alert_toast("Lecture added successfully", 'success');
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        } else {
                            alert_toast("successfully Done", 'success');
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
