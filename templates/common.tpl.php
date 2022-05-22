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
  <title><?= $title ?? 'Home' ?></title>
</head>
<body>
  
  <header class="responsive-header">
    <a href="index.php" class="logo">CompanyLogo</a>
  

    <?php if($session->isLoggedin()){?>
      <div class="login_register">
        <a href="/../pages/profile.php">Hello, <?= $session->getName() ?></a>
      </div>
    <?php } else { ?>
      <div class="login_register">
        <a href="/../pages/login.php" class="login">Login</a>
        <a href="/../pages/register.php" class="register">Register</a>
      </div>
    <?php } ?>
    </header>
    <hr>
    <main>
<?php } ?>

<?php function drawFooter() { ?>
    </main>
    <hr>
    <footer>

      LTW  &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>
