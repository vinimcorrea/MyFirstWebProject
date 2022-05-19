<?php declare(strict_types = 1); ?>

<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Deliever Shop</title>
</head>
<body>
  
  <header class="responsive-header">
    <a href="#default" class="logo">CompanyLogo</a>
    <!--
    <div class="responsive-header-container">
      <button type="button" tabindex="0" class="btn-container">
        <span class="icon-container">
          <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="22" height="2" rx="1" fill="#717171">
            </rect>
            <rect y="8" width="22" height="2" rx="1" fill="#717171">
            </rect>
            <rect y="16" width="22" height="2" rx="1" fill="#717171">
            </rect>
          </svg>
        </span> 
      </button>
    </div>
    -->
    <div class="login_register">
      <a href="login.php" class="login">Login</a>
      <a href="register.php" class="register">Register</a>
    </div>
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

<?php function drawLoginForm() { ?>
  <form action="action_login.php" method="post" class="login">
    <button type="button" class="sign-up">Register</button>
    <button type="button" class="sign-in">Login</button>
  </form>
<?php } ?>

<?php function drawLogoutForm(string $name) { ?>
  <form action="action_logout.php" method="post" class="logout">
    <a href="profile.php"><?=$name?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>