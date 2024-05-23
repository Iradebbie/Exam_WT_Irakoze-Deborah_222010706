<?php
include_once("./connection/connection.php");

// Fetch categories from the database
$categories = [];
$categoryQry = $conn->query("SELECT * FROM categories");
while($row = $categoryQry->fetch_assoc()){
    $categories[] = $row;
}

// Get the total number of items in the cart for the current user
$cartCount = 0;
if(isset($_SESSION['valid'])){
    $user_id = $_SESSION['id'];
    $cartQry = $conn->query("SELECT COUNT(*) as count FROM cart WHERE user_id = '$user_id'");
    if($cartQry && $cartQry->num_rows > 0) {
        $cartCount = $cartQry->fetch_assoc()['count'];
    }
}
?> 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid px-4 px-lg-5">
        <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>            <?php if (isset($_SESSION['valid'])){ ?>

        <a class="navbar-brand" href="./">
            <!-- Your logo and short name here -->
            <img src="myImages/avatar.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            <?php echo "<b>".$_SESSION['role']."</b> ".$_SESSION['first_name']." ".$_SESSION['last_name']; ?>
        </a>
<?php } else{ ?>

    <a class="navbar-brand" href="./">
            <!-- Your logo and short name here -->
            <b><i>Artificial intelligence courses</i></b>
        </a>
    <?php } ?>
    <?php if (!isset($_SESSION['valid'])){?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCourses" role="button" data-toggle="dropdown" aria-expanded="false">Courses</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownCourses">
                        <?php foreach($categories as $category): ?>
                            <li><a class="dropdown-item" href="#"><?php echo htmlspecialchars($category['category']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                </li>
                 <li class="nav-item"><a class="nav-link" href="./?p=cart">Cart <span class="badge badge-dark"><?php echo $cartCount; ?></span></a></li>

                <?php }else if(isset($_SESSION['valid']) && $_SESSION['role']=='Student'){ ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCourses" role="button" data-toggle="dropdown" aria-expanded="false">Courses</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownCourses">
                        <?php foreach($categories as $category): ?>
                            <li><a class="dropdown-item" href="#"><?php echo htmlspecialchars($category['category']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                 <li class="nav-item"><a class="nav-link" href="./?p=cart">Cart <span class="badge badge-dark"><?php echo $cartCount; ?></span></a></li>
                 <li class="nav-item"><a class="nav-link" href="./?p=manageOrder">Order</a></li>

                 <?php }else if(isset($_SESSION['valid']) && $_SESSION['role']=='Admin'){ ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="./">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCourses" role="button" data-toggle="dropdown" aria-expanded="false">Courses</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownCourses">
                        <?php foreach($categories as $category): ?>
                            <li><a class="dropdown-item" href="#"><?php echo htmlspecialchars($category['category']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageCourses">Course</a></li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageInstructor">Instructor</a></li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageLecture">Lecture</a></li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageCategory">Category</a></li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageSales">Sales</a></li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageLogs">Logs</a></li>
                <li class="nav-item"><a class="nav-link" href="./?p=manageEnrollment">Enrollment</a></li>

                    <?php }else{} ?>
            </ul>
            <?php if(isset($_SESSION['valid'])){ ?>
                <div class="d-flex align-items-center">
                <a class="btn btn-outline-dark ml-2" id="login-btn" href="logout.php">LogOut</a>
            </div>

         <?php   }else{ ?>
            <div class="d-flex align-items-center">
                <a class="btn btn-outline-dark ml-2" id="login-btn" href="#">Login</a>
            </div>
            <?php } ?>
        </div>
    </div>
</nav>



<script>
  $(function(){
    $('#login-btn').click(function(){
      uni_modal("","login.php")
    })
    $('#navbarResponsive').on('show.bs.collapse', function () {
        $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function () {
        if($('body').offset.top == 0)
          $('#mainNav').removeClass('navbar-shrink')
    })
  })

 
</script>