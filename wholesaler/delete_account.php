<center>

    <h1>Do You Reaaly Want To Delete Your Account!</h1>

    <form action="" method="post">

        <input class="btn btn-danger" type="submit" name="yes" value="Yes, I want to delete">

        <input class="btn btn-primary" type="submit" name="no" value="No, I Don,t want to delete">

    </form>

</center>

<?php

$c_email = $_SESSION['wholesaler_email'];

if (isset($_POST['yes'])) {

    $wholesaler_email = $_SESSION['wholesaler_email'];
    $seller_id = "";
    $get_seller = "select * from wholesaler where wholesaler_email='$wholesaler_email'";
    $run_get_seller = mysqli_query($con, $get_seller);
    while ($row_seller = mysqli_fetch_array($run_get_seller)) {
        $seller_id = $row_seller['wholesaler_id'];
    }
    

    $delete_customer = "delete from wholesaler where wholesaler_email='$c_email'";

    $delete_products = "DELETE FROM products WHERE seller_id='$seller_id'";

    $run_delete = mysqli_query($con, $delete_customer);

    if ($run_delete) {

        session_destroy();

        echo "<script>alert('Your Account Has Been Deleted! Good By')</script>";

        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if (isset($_POST['no'])) {

    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
}


?>