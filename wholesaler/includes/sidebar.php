<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<?php

$wholesaler_session = $_SESSION['wholesaler_email'];

$get_customer = "select * from wholesaler where wholesaler_email='$wholesaler_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_image = $row_customer['wholesaler_image'];

$customer_name = $row_customer['wholesaler_name'];

if(!isset($_SESSION['wholesaler_email'])){


}
else {

echo "

<center>

<img src='wholesaler_images/$customer_image' class='img-responsive'>

</center>

<br>

<h3 align='center' class='panel-title'> Name : $customer_name </h3>

";

}

?>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<ul class="nav nav-pills nav-stacked"><!-- nav nav-pills nav-stacked Starts -->

<li class="<?php if(isset($_GET['my_orders'])){ echo "active"; } ?>">

<a href="my_account.php?my_orders"> <i class="fa fa-list"> </i> My Orders </a>

</li>

<li class="<?php if(isset($_GET['insert_product'])){ echo "active"; } ?>">

<a href="my_account.php?insert_product"> <i class="fa fa-bolt"></i> Insert Products </a>

</li>

<li class="<?php if(isset($_GET['edit_account'])){ echo "active"; } ?>">

<a href="my_account.php?edit_account"> <i class="fa fa-pencil"></i> Edit Account </a>

</li>

<li class="<?php if(isset($_GET['change_pass'])){ echo "active"; } ?>">

<a href="my_account.php?change_pass"> <i class="fa fa-user"></i> Change Password </a>

</li>

<li class="<?php if(isset($_GET['my_products'])){ echo "active"; } ?>">

<a href="my_account.php?my_products"> <i class="fa fa-heart"></i> view products </a>

</li>

<li class="<?php if(isset($_GET['delete_account'])){ echo "active"; } ?>">

<a href="my_account.php?delete_account"> <i class="fa fa-trash-o"></i> Delete Account </a>

</li>

<li>

<a href="logout.php"> <i class="fa fa-sign-out"></i> Logout </a>

</li>


</ul><!-- nav nav-pills nav-stacked Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default sidebar-menu Ends -->