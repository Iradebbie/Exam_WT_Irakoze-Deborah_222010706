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
$course_id = "Auto";
$course_name = "";
$course_category = "";
$course_price = "";
$course_decription = "";
$lecture_ID = "";
$courseImage = "";

if(isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $sql = "SELECT * FROM courses WHERE id = $course_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $course_name = $row['course_name'];
        $course_category = $row['course_category'];
        $course_price = $row['course_price'];
        $course_decription = $row['course_decription'];
        $lecture_ID = $row['lecture_ID'];
        $courseImage = $row['courseImage'];
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
            <h3 class="text-center"><?php echo isset($_GET['id']) ? 'Edit course' : 'Add course'; ?></h3>
            <hr>
            <form id="course-form" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="course_name">ID</label>
                    <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo $course_id; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="course_name">Course Name</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $course_name; ?>">
                    <div class="error-message" id="course_name_error"></div>
                </div>
                <div class="form-group">
    <label for="course_category">Course Category</label>
    <select class="form-control" id="course_category" name="course_category">
        <?php
            $sql = "SELECT * FROM `categories`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["category"] . "</option>";
                }
            }
        ?>
    </select>
    <div class="error-message" id="course_category_error"></div>
</div>

                <div class="form-group">
                    <label for="course_price">Course Price</label>
                    <input type="text" class="form-control" id="course_price" name="course_price" value="<?php echo $course_price; ?>">
                    <div class="error-message" id="course_price_error"></div>
                </div>
                <div class="form-group">
                    <label for="course_decription">Course Description</label>
                    <textarea class="form-control" id="course_decription" name="course_decription"><?php echo $course_decription; ?></textarea>
                    <div class="error-message" id="course_decription_error"></div>
                </div>
                <div class="form-group">
    <label for="lecture_ID">Lecture Name</label>
    <select class="form-control" id="lecture_ID" name="lecture_ID">
        <?php
            $sql = "SELECT * FROM `lecture`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["Full_name"] . "</option>";
                }
            }
        ?>
    </select>
    <div class="error-message" id="lecture_ID_error"></div>
</div>

                <div class="form-group">
                    <label for="courseImage">Course Image</label>
                    <input type="file" id="courseImage" name="courseImage" class="form-control">
                    <div class="error-message" id="courseImage_error"></div>
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
        $('#course-form').submit(function(e){
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

            // Validate image file format
            var fileInput = $('#courseImage');
            var file = fileInput[0].files[0];
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if(file && !allowedExtensions.exec(file.name)){
                $('#courseImage_error').html('Please select a valid image file.');
                fileInput.addClass('error-border');
                error = true;
            }

            if(!error){
                start_loader();
                $.ajax({
                    url: "submit.php?id=1",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(resp){
                        if(resp.status == 'success'){
                            alert_toast(" successfully Done", 'success');
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        } else {
                            alert_toast(" successfully Done", 'success');
                            console.log(resp);
                        }
                        form[0].reset();

                        end_loader();
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
