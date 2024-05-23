<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end mb-2">
                <button class="btn btn-outline-dark btn-flat btn-sm" type="button" id="empty_cart">Empty Cart</button>
            </div>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <h3><b>Cart List</b></h3>
                <hr class="border-dark">
                <?php 
                    $qry = $conn->query("SELECT * from cart WHERE user_id = {$_SESSION['id']}");
                    $cartItems = [];
                    while($row= $qry->fetch_assoc()):
                        $cartItems[] = $row;
                        $upload_path = 'uploads/'.$row['image'];
                        $img = "";
                        foreach($row as $k=> $v){
                            $row[$k] = trim(stripslashes($v));
                        }
                        if(is_dir($upload_path)){
                            $fileO = scandir($upload_path);
                            if(isset($fileO[2]))
                                $img = "uploads/".$row['image'];
                        }
                ?>
                    <div class="d-flex w-100 justify-content-between mb-2 py-2 border-bottom cart-item">
                        <div class="d-flex align-items-center col-8">
                            <span class="mr-2"><a href="javascript:void(0)" class="btn btn-sm btn-outline-danger rem_item" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></a></span>
                            <img src="<?php echo $row['image'] ?>" loading="lazy" class="cart-prod-img mr-2 mr-sm-2" alt="">
                            <div>
                                <p class="mb-1 mb-sm-1"><?php echo $row['course_name'] ?></p>
                                
                                <p class="mb-1 mb-sm-1"><small><b>Price:</b> <span class="price"><?php echo number_format($row['price']); echo "$"; ?></span></small></p>
                            </div>
                        </div>
                        <div class="col text-right align-items-center d-flex justify-content-end">
                            <h4><b class="total-amount"><?php echo number_format($row['price'] * $row['quantity']) ?></b></h4>
                        </div>
                    </div>
                <?php endwhile; ?>
                <div class="d-flex w-100 justify-content-between mb-2 py-2 border-bottom">
                    <div class="col-8 d-flex justify-content-end"><h4>Grand Total:</h4></div>
                    <div class="col d-flex justify-content-end"><h4 id="grand-total">-</h4></div>
                </div>
            </div>
        </div>
        <div class="d-flex w-100 justify-content-end">
            <a class="btn btn-sm btn-flat btn-dark" id="continueCheckout">Checkout</a>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('#empty_cart').click(function(){
            var confirmEmpty = confirm("Are you sure you want to empty your cart?");
            if (confirmEmpty) {
                $.ajax({
                    url: 'cartAction.php?f=empty_cart',
                    method: 'GET',
                    dataType: 'json',
                    success: function(resp){
                        if(resp.status == 'success'){
                            alert('Cart emptied successfully.');
                            location.reload();
                        }else{
                            alert('Failed to empty cart. Please try again.');
                        }
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                        alert('An error occurred while emptying cart.');
                    }
                });
            }
        });

        $('#continueCheckout').click(function(){
            var confirmCheckout = confirm("Are you sure you want to add the cart to the database?");
            if (confirmCheckout) {
                $.ajax({
                    url: 'cartAction.php?f=add_enrollment',
                    method: 'POST',
                    data: {
                        cartItems: <?php echo json_encode($cartItems); ?>
                    },
                    dataType: 'json',
                    success: function(resp){
                        if(resp.status == 'success'){
                            alert('Cart added successfully.');
                            alert_toast("Cart And Sale added successfully.",'success')

                            location.reload();
                        }else{
                            alert('Failed to add cart. Please try again.');
                            location.reload();

                        }
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                        alert('An error occurred while adding cart.');
                    }
                });
            }
        });
    });
</script>
