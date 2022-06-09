<?php

$wholesaler_session = $_SESSION['wholesaler_email'];

$get_customer = "select * from wholesaler where wholesaler_email='$wholesaler_session'";

$run_customer = mysqli_query($con, $get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['wholesaler_id'];

$customer_name = $row_customer['wholesaler_name'];

$wholesaler_email = $row_customer['wholesaler_email'];

$customer_country = $row_customer['wholesaler_country'];

$customer_city = $row_customer['wholesaler_city'];

$customer_contact = $row_customer['wholesaler_contact'];

$customer_address = $row_customer['wholesaler_address'];

$customer_image = $row_customer['wholesaler_image'];

?>

<h1 align="center"> Edit Your Account </h1>

<form action="" method="post" enctype="multipart/form-data">
    <!--- form Starts -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer Name: </label>

        <input type="text" name="c_name" class="form-control" required value="<?php echo $customer_name; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer Email: </label>

        <input type="text" name="c_email" class="form-control" required value="<?php echo $wholesaler_email; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer Country: </label>

        <input type="text" name="c_country" class="form-control" required value="<?php echo $customer_country; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer City: </label>

        <input type="text" name="c_city" class="form-control" required value="<?php echo $customer_city; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer Contact: </label>

        <input type="text" name="c_contact" class="form-control" required value="<?php echo $customer_contact; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer Address: </label>

        <input type="text" name="c_address" class="form-control" required value="<?php echo $customer_address; ?>">


    </div><!-- form-group Ends -->

    <div class="form-group">
        <!-- form-group Starts -->

        <label> Customer Image: </label>

        <input type="file" name="c_image" class="form-control"><br>

        <img src="customer_images/<?php echo $customer_image; ?>" width="100" height="100" class="img-responsive">


    </div><!-- form-group Ends -->

    <div class="text-center">
        <!-- text-center Starts -->

        <button name="update" class="btn btn-primary">

            <i class="fa fa-user-md"></i> Update Now

        </button>


    </div><!-- text-center Ends -->


</form>
<!--- form Ends -->

<?php

if (isset($_POST['update'])) {

    $update_id = $customer_id;

    $c_name = $_POST['c_name'];

    $c_email = $_POST['c_email'];

    $c_country = $_POST['c_country'];

    $c_city = $_POST['c_city'];

    $c_contact = $_POST['c_contact'];

    $c_address = $_POST['c_address'];

    $c_image = $_FILES['c_image']['name'];

    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    move_uploaded_file($c_image_tmp, "wholesaler_images/$c_image");

    $update_customer = "update wholesaler set wholesaler_name='$c_name',wholesaler_email='$c_email',wholesaler_country='$c_country',wholesaler_city='$c_city',wholesaler_contact='$c_contact',wholesaler_address='$c_address',wholesaler_image='$c_image' where wholesaler_id='$update_id'";

    $run_customer = mysqli_query($con, $update_customer);

    if ($run_customer) {

        echo "<script>alert('Your account has been updated please login again')</script>";

        echo "<script>window.open('my_account.php','_self')</script>";
    }
}


?>