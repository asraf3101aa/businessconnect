<?php
session_start();
include("includes/db.php");
if (isset($_SESSION['wholesaler_email']) && $_SESSION['role'] === "wholesaler") {
    $Email = $_SESSION['wholesaler_email'];
    if (isset($_POST["reset"])) {



        if ($_POST['password'] === $_POST['confirmpassword']) {
            $psw = $_POST["password"];
        } else {
?>
            <script>
                alert("<?php echo "Password doesnt match " ?>");
            </script>
        <?php
            echo "<script>window.open('resetpassword.php','_self')</script>";
            exit();
        }
        $hash = password_hash($psw, PASSWORD_DEFAULT);

        if ($Email) {
            $new_pass = $hash;
            mysqli_query($con, "UPDATE wholesaler SET wholesaler_pass='$new_pass' WHERE wholesaler_email='$Email'");
            session_destroy();
        ?>
            <script>
                window.location.replace("wholesaler_login.php");
                alert("<?php echo "your password has been succesful reset" ?>");
            </script>
        <?php

        } else {
        ?>
            <script>
                alert("<?php echo "Please try again" ?>");
            </script>
    <?php
        }
    }
} else {
    session_destroy();
    ?>
    <script>
        window.location.replace("forgot_pass.php");
    </script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BC - Sign IN </title>
    <link rel="stylesheet" href="css/resetpassword.css">

    <link rel="stylesheet" href="css/logo-header.css">

    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo_con">

            <img src="images/LOGO.png" class="logo" alt="BC">
        </div>
    </header>

    <main>


        <div class="main-box">
            <div class="wrapper_N">

                <h2>Enter a new Password</h2>
                <!--            <p> Please enter a password containing numbers,alphabets & symbols for max</p>-->
                <form action="" method="post">

                    <div class="input-box">
                        <input type="password" name="password" placeholder="Create password" required>
                        <!--                    <span class="error">--><?php //echo $password_err;
                                                                        ?>
                        <!--</span>-->
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirmpassword" placeholder="Confirm password" required>
                        <!--                    <span class="error">--><?php //echo $password_err;
                                                                        ?>
                        <!--</span>-->
                    </div>
                    <div class="input-box button">
                        <input type="Submit" name="reset" value="Change password">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!--  JS connection-->


</body>

</html>