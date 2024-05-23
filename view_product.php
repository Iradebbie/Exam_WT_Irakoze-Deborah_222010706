<?php 
 $products = $conn->query("SELECT * FROM `courses`  where md5(id) = '{$_GET['id']}' ");
 if($products->num_rows > 0){
     foreach($products->fetch_assoc() as $k => $v){
         $$k= stripslashes($v);
     }
    $upload_path = 'uploads/'.$courseImage;
    $img = "";
    if(is_dir($upload_path)){
        $fileO = scandir($upload_path);
        if(isset($fileO[2]))
            $img = "uploads/".$courseImage;
        // var_dump($fileO);
    }
     
 }
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0 " loading="lazy" id="display-img" src="<?php echo $courseImage ?>" alt="..." />
                <div class="mt-2 row gx-2 gx-lg-3 row-cols-4 row-cols-md-3 row-cols-xl-4 justify-content-start">
                     
             
                 </div>
            </div>
            <div class="col-md-6">
                <!-- <div class="small mb-1">SKU: BST-498</div> -->
                <h1 class="display-5 fw-bolder border-bottom border-primary pb-1"><?php echo $course_name ?></h1>
                <p class="m-0"><small>By: <?php echo $lecture_ID ?></small></p>
                <div class="fs-5 mb-5">
                 <span id="price"><?php echo $course_price ;echo "$"; ?></span>
                <br>
                <span><small><b>Available Stock:</b> <span id="avail"><?php echo "3"; ?></span></small></span>
                </div>
                <form action="" id="add-cart">
                <div class="d-flex">
                    <input type="hidden" name="price" value="<?php echo $course_price ?>">
                    <input type="hidden" name="courseId" value="<?php echo $id ?>">
                    <input type="hidden" name="courseName" value="<?php echo $course_name ?>">
                    <input type="hidden" name="image" value="<?php echo $courseImage ?>">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" name="quantity" />
                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
                </form>
                <p class="lead"><?php echo $course_decription; ?></p>
                
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related Courses</h2>
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php 
            $courses = $conn->query("SELECT * FROM `courses`  order by rand() limit 4 ");
            while($row = $courses->fetch_assoc()):
                $upload_path = 'uploads/'.$row['courseImage'];
                $img = "";
                if(is_dir($upload_path)){
                    $fileO = scandir($upload_path);
                    if(isset($fileO[2]))
                        $img = "uploads/".$row['courseImage'];
                    // var_dump($fileO);
                }
                 
        ?>
            <div class="col mb-5">
                <div class="card h-100 product-item">
                    <!-- Product image-->
                    <img class="card-img-top w-100" src="<?php echo $row['courseImage'] ?>" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $row['course_name'] ?></h5>
                            <!-- Product price-->
                                 <span><b>Price: </b><?php echo $row['course_price'] ?></span>
                             <p class="m-0"><small>Lecture: <?php echo $row['lecture_ID'] ?></small></p>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-flat btn-primary "   href=".?p=view_product&id=<?php echo md5($row['id']) ?>">View</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script>
$(function(){
 
    $('#add-cart').submit(function(e){
        e.preventDefault();
        if(!<?php echo isset($_SESSION['valid']) ? 'true' : 'false'; ?>){
            uni_modal("","login.php");
            return false;
        }
        start_loader();
        $.ajax({
            url:'addCart.php',
            data:$(this).serialize(),
            method:'POST',
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status=='success'){
                    alert_toast("Product added to cart.",'success')
                    $('#cart-count').text(resp.cart_count)
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                }
                end_loader();
            }
        })
    })
})

</script>