<?php

session_start();



include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");



?>


<!-- MAIN -->
<main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">Connect</span> with us
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>


<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->





<div class="col-md-12" ><!-- col-md-12 Starts -->

<div class="box" ><!-- box Starts -->

<div class="box-header" ><!-- box-header Starts -->

<center><!-- center Starts -->

<h2> Register A New Account </h2>



</center><!-- center Ends -->

</div><!-- box-header Ends -->

<form action="customer_register.php" method="post" enctype="multipart/form-data" ><!-- form Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label>Your Name</label>

<input type="text" class="form-control" name="c_name" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label>Your Email</label>

<input type="text" class="form-control" name="c_email" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label>Your Phone</label>

<input type="text" class="form-control" name="c_contact" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label>Register as</label>

<select class="form-control" name="role" required>
  <option value="ROLE_RETAILER">Retailer</option>
  <option value="ROLE_WHOLESALER">Wholesaler</option>
</select>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label>Your Password </label>

<input type="password" class="form-control" id="pass" name="c_pass" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label>Confirm Password </label>

<input type="password" class="form-control confirm" id="con_pass" required>

</div><!-- form-group Ends -->






<div class="text-center"><!-- text-center Starts -->

<button type="submit" name="register" class="btn btn-primary">

<i class="fa fa-user-md"></i> Register

</button>

<a href="checkout.php" >

<h4>Already have an account? Login here</h4>

</a>

</div><!-- text-center Ends -->

</form><!-- form Ends -->

</div><!-- box Ends -->

</div><!-- col-md-12 Ends -->



</div><!-- container Ends -->
</div><!-- content Ends -->

</body>

</html>

<?php
$email_err = $name_err = $contact_number_err = $role_err = $password_err = $confirm_password_err = "";
$name_regex = $phone_regex = $password_regex = "";
$password = "";
$c_email = $c_contact = $c_name = $c_pass = "";
$name_regex = "/^[a-zA-Z]{3,20}(?: [a-zA-Z]+){0,2}$/";
$phone_regex = "/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/";
$password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/";

if (isset($_POST['register'])) {

  //validity check
  

  //check for email
  if (empty(trim($_POST["c_email"]))) {
    $email_err = "Email cannot be blank";
    echo "<script>alert('Enter your email')</script>";
  } else if (!filter_var(trim($_POST["c_email"], FILTER_VALIDATE_EMAIL))) {
    $email_err = "Enter valid email";
    echo "<script>alert('Enter valid email')</script>";
  } else {
    $c_email = trim($_POST['c_email']);
  }

  //check for name
  if (!preg_match($name_regex, (trim($_POST['c_name'])))) {
    $name_err = "Enter Valid name";
    echo "<script>alert('Enter valid name')</script>";
  } else {
    $c_name = trim($_POST['c_name']);
  }

  //check for phone number
  if (!preg_match($phone_regex, (trim($_POST['c_contact'])))) {
    $contact_number_err = "Enter valid australian phone number";
    echo "<script>alert('Enter valid number')</script>";
  } else {
    $c_contact = trim($_POST['c_contact']);
  }

  //check for role
  if (empty(trim($_POST['role']))) {
    $role_err = "Select a role";
  } else {
    $role = $_POST['role'];
  }

  // Check for password
  if (!preg_match($password_regex, (trim($_POST['c_pass'])))) {
    $password_err = "Password must contain an uppercase letter,a lowercase letter and numbers with minimum length 6";
    echo "<script>alert('Password must contain an uppercase letter,a lowercase letter and numbers with minimum length 6')</script>";
  } else {
    $password = trim($_POST['c_pass']);
  }

  // Check for confirm password field
  if (trim($_POST['c_pass']) !=  trim($_POST['c_cnfrm_password'])) {
    $password_err = "Passwords should match";
    echo "<script>alert('Passwords fields should match')</script>";
  }

  $c_pass = password_hash($password, PASSWORD_DEFAULT);









  if (empty($email_err) && empty($name_err) && empty($contact_number_err) && empty($role_err) && empty($password_err)) {

    if ($role === 'ROLE_RETAILER') {


      $c_ip = getRealUserIp();


      $get_email = "select * from customers where customer_email='$c_email'";

      $run_email = mysqli_query($con, $get_email);

      $check_email = mysqli_num_rows($run_email);

      if ($check_email == 1) {

        echo "<script>alert('This email is already registered, try another one')</script>";

        exit();
      }

      $customer_confirm_code = mt_rand();


      require "Mail/phpmailer/PHPMailerAutoload.php";
      $mail = new PHPMailer;

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';

      $mail->Username = 'suipservices@gmail.com';
      $mail->Password = 'qxxsxcxtrnjggwvg';

      $mail->setFrom('suipservices@gmail.com', 'Verify Email');
      // get email from input
      $mail->addAddress($c_email);

      // HTML body
      $mail->isHTML(true);
      $mail->Subject = "Email Confirmation Message";
      $mail->Body = "

            <h2>
            Email Confirmation By businessconnect.com $c_name
            </h2>
            
            <a href='localhost/businessconnect/customer/my_account.php?$customer_confirm_code'>
            
            Click Here To Confirm Email
            
            </a>
            
            ";

      if (!$mail->send()) {
?>
        <script>
          alert("<?php echo " Invalid Email " ?>");
        </script>
      <?php
      } else {
      ?>
        <script>
          alert("<?php echo " Check your email for account confirmation " ?>");
        </script>
      <?php
      }

      $insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_contact,customer_ip,customer_confirm_code) values ('$c_name','$c_email','$c_pass','$c_contact','$c_ip','$customer_confirm_code')";


      $run_customer = mysqli_query($con, $insert_customer);

      $sel_cart = "select * from cart where ip_add='$c_ip'";

      $run_cart = mysqli_query($con, $sel_cart);

      $check_cart = mysqli_num_rows($run_cart);

      if ($check_cart > 5) {

        $_SESSION['customer_email'] = $c_email;


        echo "<script>window.open('cart.php','_self')</script>";
      } else {

        $_SESSION['customer_email'] = $c_email;
        $_SESSION['role']= $role;

        echo "<script>window.open('index.php','_self')</script>";
      }
    }

    if ($role === 'ROLE_WHOLESALER') {


      $c_ip = getRealUserIp();


      $get_email = "select * from wholesaler where wholesaler_email='$c_email'";

      $run_email = mysqli_query($con, $get_email);

      $check_email = mysqli_num_rows($run_email);

      if ($check_email == 1) {

        echo "<script>alert('This email is already registered, try another one')</script>";

        exit();
      }

      $wholesaler_confirm_code = mt_rand();


      require "Mail/phpmailer/PHPMailerAutoload.php";
      $mail = new PHPMailer;

      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';

      $mail->Username = 'suipservices@gmail.com';
      $mail->Password = 'qxxsxcxtrnjggwvg';

      $mail->setFrom('suipservices@gmail.com', 'Verify Email');
      // get email from input
      $mail->addAddress($c_email);

      // HTML body
      $mail->isHTML(true);
      $mail->Subject = "Email Confirmation Message";
      $mail->Body = "

            <h2>
            Email Confirmation By businessconnect.com $c_name
            </h2>
            
            <a href='localhost/businessconnect/wholesaler/my_account.php?$wholesaler_confirm_code'>
            
            Click Here To Confirm Email
            
            </a>
            
            ";

      if (!$mail->send()) {
      ?>
        <script>
          alert("<?php echo " Invalid Email " ?>");
        </script>
      <?php
      } else {
      ?>
        <script>
          alert("<?php echo " Check your mail for account confirmation " ?>");
        </script>
      <?php
      }
      $insert_customer = "insert into wholesaler (wholesaler_name,wholesaler_email,wholesaler_pass,wholesaler_contact,wholesaler_ip,wholesaler_confirm_code) values ('$c_name','$c_email','$c_pass','$c_contact','$c_ip','$wholesaler_confirm_code')";


      $run_customer = mysqli_query($con, $insert_customer);



      $_SESSION['wholesaler_email'] = $c_email;
      $_SESSION['role']= $role;

      echo "<script>window.open('wholesaler/my_account.php?my_orders','_self')</script>";
    }
  }
}

?>