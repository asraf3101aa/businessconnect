</head>

<body>

  <header class="page-header">
    <!-- topline -->
    <div class="page-header__topline">
      <div class="container clearfix">

        <div class="currency">
          <a class="currency__change" href="customer/my_account.php?my_orders">
          <?php
          if(isset($_SESSION['customer_email'])){
            echo "Welcome : " . $_SESSION['customer_email'] . "";
           
          }
          elseif(isset($_SESSION['wholesaler_email'])){
            echo "Welcome : " . $_SESSION['wholesaler_email'] . ""; 
          }
          else
          { 
            echo "Welcome :Guest";
          }
?>
          </a>
        </div>
<?php
if(isset($_SESSION['customer_email']) || !isset($_SESSION['customer_email']) && $_SESSION['role'] != "ROLE_WHOLESALER"){
  ?>
        <div class="basket">
          <a href="../cart.php" class="btn btn--basket">
            <i class="icon-basket"></i>
            <?php items(); ?> items
          </a>
        </div>
        <?php
        }
        ?>
        
        
        <ul class="login">

<li class="login__item">
<?php
if(!isset($_SESSION['customer_email']) && !isset($_SESSION['wholesaler_email'])){
  echo '<a href="customer_register.php" class="login__link">Register</a>';
} 
  else
  { 
    if(isset($_SESSION['customer_email'])){

      echo '<a href="./my_account.php?my_orders" class="login__link">My Account</a>';
    }
    
  }   
?>  
</li>


<li class="login__item">
<?php
if(!isset($_SESSION['customer_email']) && !isset($_SESSION['wholesaler_email'])){
  echo '<a href="checkout.php" class="login__link">Sign In</a>';
} 
  else
  { 
      echo '<a href="../logout.php" class="login__link">Log out</a>';
  }   
?>  
  
</li>
</ul>
      
      </div>
    </div>
    <!-- bottomline -->
    <div class="page-header__bottomline">
      <div class="container clearfix">
        <div class="logo">
          <a class="logo__link" href="../index.php">
            <img class="logo__img" src="images/logo.png" alt="Business Connect logotype" width="150" height="7">
          </a>
        </div>

        <nav class="main-nav">
          <ul class="categories">


            <li class="categories__item">
              <a class="categories__link" href="shop.php">
                Shop
              </a>
            </li>

            <li class="categories__item">
              <a class="categories__link" href="../contact.php">
                Contact
              </a>
            </li>

          <li class="categories__item">
              <a class="categories__link" href="./my_account.php?my_orders">
                My Account
                <i class="icon-down-open-1"></i>
              </a>
              <div class="dropdown dropdown--lookbook">
                <div class="clearfix">
                  <div class="dropdown__half">
                    <div class="dropdown__heading">Account Settings</div>
                    <ul class="dropdown__items">
                      <li class="dropdown__item">
                        <a href="./my_account.php?my_wishlist" class="dropdown__link">My Wishlist</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="./my_account.php?my_orders" class="dropdown__link">My Orders</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="../cart.php" class="dropdown__link">View Shopping Cart</a>
                      </li>
                    </ul>
                  </div>
                  <div class="dropdown__half">
                    <div class="dropdown__heading"></div>
                    <ul class="dropdown__items">
                      <li class="dropdown__item">
                        <a href="./my_account.php?edit_account" class="dropdown__link">Edit Your Account</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="./my_account.php?change_pass" class="dropdown__link">Change Password</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="./my_account.php?delete_account" class="dropdown__link">Delete Account</a>
                      </li>
                    </ul>
                  </div>
                </div>
             

              </div>

            </li>

          </ul>
        </nav>
      </div>
    </div>
  </header>