<?php declare(strict_types = 1); 
  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../css/style.css">
  <script src="../javascript/script.js" defer></script>
  <title>Faustino Express Delivery</title>
</head>
<body>
  <header class="responsive-header">
  <?php if($session->isLoggedin()){?>
  <input id="toggle1" type="checkbox"/>
  <label class="hamburger1" for="toggle1">
      <div class="top"></div>
      <div class="meat"></div>
      <div class="bottom"></div>
  </label>

  <a href="../index.php"><img src="../images/logo/deliver-logo.png" id="logo" width="120" "alt="my logo"/></a>
  <div class="login_register">
    <a href="/../pages/profile.php">Hello, <?= $session->getName() ?></a>
  </div>

  <nav class="menu1">
      <div class="user-options">
        <a href="/../pages/order.php">My Orders</a>
      </div>
      <div class="user-options">
        <a href="/../pages/favorites.php">Favorites</a>
      </div>

      <?php if($session->isOwner()){?>
      <div class="user-options">
        <a href="/../pages/order_received.php">Orders Received</a>
      </div>
      <div class="user-options">
        <a href="../pages/add_category.php" class="edit_profile">Add Category</a>
      </div>
      <div class="user-options">
        <a href="../pages/add_restaurant.php" class="edit_profile">Add restaurant</a>
      </div>  
      <?php } ?>
      <div class="user-options">
        <a href="../actions/action_logout.php" class="edit_profile">Sign Out</a>
      </div>
      </nav>
    <?php } else { ?>
      <a href="../index.php"><img src="../images/logo/deliver-logo.png" width="120" "alt="my logo"/></a>
      <div class="login_register">
        <a href="/../pages/register.php" class="register">Register</a>
        <a href="/../pages/login.php" class="login">Login</a>
      </div>
    <?php } ?>
    </header>
    <hr>
    <main>
<?php } ?>

<?php function drawFooter() { ?>
    </main>
    <hr>
    <footer class="site-footer">
      <div class="footer-container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
         <a href="#">LTW FEUP</a>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
            </ul>
          </div>
        </div>
      </div>
</footer>
  </body>
</html>
<?php } ?>
