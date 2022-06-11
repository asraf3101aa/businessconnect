<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
include("includes/header.php");
include("includes/main.php");

?>
    <div class="main-box">

    <div class="wrapper_W">
        <div class="heading">
            <h2>Log IN</h2>
        </div>

        <form action="" method ="post">

            <div class="input-box">
                <input type="email" name="c_email" placeholder="Enter your email" value="<?php echo isset($_POST['email'])? trim($_POST['email']):'';?>" required>
            </div>


            <div class="input-box">
                <input type="password" name="c_pass" placeholder="Enter password" required>
            </div>

            <div class="input-box button" id="wlbtn" >
                <input type="Submit" name="login" value="Sign In">
            </div>
            <div class="text">
                <h3> <a href="forgot_pass.php">Forgot password? click here</a></h3>
            </div>

            <div class="text" id="spaceing">
                <h3> <a href="../checkout.php">Are you a retailer? Login here</a></h3>
            </div>
            <div class="text" id="spaceing">
                <h3> <a href="../customer_register.php">Don't have an account? Register here</a></h3>
            </div>
        </form>
    </div>

    </div>
    
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