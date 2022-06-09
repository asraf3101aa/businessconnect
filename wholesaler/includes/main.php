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
          <a href="cart.php" class="btn btn--basket">
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

      echo '<a href="customer/my_account.php?my_orders" class="login__link">My Account</a>';
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
              <a class="categories__link"href="../contact.php">
                Contact Us
               
              </a>
            </li>

            <li class="categories__item">
              <a class="categories__link" href="../shop.php">
                Shop
              </a>
            </li>

            <li class="categories__item">
              <a class="categories__link" >
                Local Stores
              </a>
            </li>


          </ul>
        </nav>
      </div>
    </div>
  </header>