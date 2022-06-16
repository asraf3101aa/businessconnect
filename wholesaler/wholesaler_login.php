<?php
session_start();
include("../includes/db.php");
include("../functions/functions.php");
include("../includes/header.php");
include("../includes/main.php");

?>
    <div class="box" ><!-- box Starts -->

<div class="box-header" ><!-- box-header Starts -->

<center>

<h1>Login</h1>

<p class="lead" >Already have an Account?</p>


</center>





</div><!-- box-header Ends -->

<form action="" method="post" ><!--form Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label>Email</label>

<input type="text" class="form-control" name="c_email" required >

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label>Password</label>

<input type="password" class="form-control" name="c_pass" required >

<h4 align="center">

<a href="forgot_pass.php"> Forgot Password </a>

</h4>

</div><!-- form-group Ends -->

<div class="text-center" ><!-- text-center Starts -->

<button name="login" value="Login" class="btn btn-primary" >

<i class="fa fa-sign-in" ></i> Log in


</button>

</div><!-- text-center Ends -->


</form><!--form Ends -->

<center><!-- center Starts -->

<a href="../customer_register.php" >

<h3>Don't have an account? Register Here</h3>

</a>

<a href="../checkout.php" >

<h4>Are you a Retailer? Login here</h4>

</a>


</center><!-- center Ends -->


</div><!-- box Ends -->
    
<?php
    include ("includes/footer.php") 
    ?>
    </body>
    </html>

<?php

if (isset($_POST['login'])) {

    $wholesaler_email = $_POST['c_email'];

    $wholesaler_pass = $_POST['c_pass'];

    $select_customer = "select * from wholesaler where wholesaler_email='$wholesaler_email'";

    $run_customer = mysqli_query($con, $select_customer);

    $get_ip = getRealUserIp();

    $check_customer = mysqli_num_rows($run_customer);

    $data = mysqli_fetch_assoc($run_customer);
    $hash_password = $data["wholesaler_pass"];
    if (!password_verify($wholesaler_pass, $hash_password)) {
        echo "<script>alert('password or email is wrong')</script>";

        exit();
    } 
    if ($check_customer == 1) {
        

        $_SESSION['wholesaler_email'] = $wholesaler_email;
        $_SESSION['role'] = "ROLE_WHOLESALER";

        echo "<script>alert('You are Logged In')</script>";

        echo "<script>window.open('my_account.php?my_orders','_self')</script>";
    }
}

?>


</body>
</html>