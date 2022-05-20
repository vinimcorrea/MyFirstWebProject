<?php function drawRegisterForm() { ?>
<form action="action_register.php">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>


    <label for="user">User :</label>
        <select name="user" id="user">
            <option value="owner">Owner</option>
            <option value="customer">Customer</option>
            <option value="deliver">Deliver</option>
        </select>
    <br><br>

    <label for="first-name"><b>First Name</b></label>
    <input type="text" placeholder="Enter your first name" name="first-name" id="first-name" required>
    <br><br>

    <label for="last-name"><b>Last Name</b></label>
    <input type="text" placeholder="Enter your last name" name="last-name" id="last-name" required>
    <br><br>

    <label for="gender">Gender :</label>
        <select name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    <br><br>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>
    <br><br>

  
    <label for="mobile"><b>Mobile</b></label>
    <input type="number" placeholder="Enter your mobile number" name="mobile" id="mobile" required>
    <br><br>

    <label for="adress"><b>Adress</b></label>
    <input type="text" placeholder="Enter your adress" name="adress" id="adress" required>
    <br><br>

    <label for="city"><b>City</b></label>
    <input type="text" placeholder="City" name="city" id="city" required>
    

    <label for="state"><b>State</b></label>
    <input type="text" placeholder="State" name="state" id="state" required>
    

    <label for="country"><b>Country</b></label>
    <input type="text" placeholder="Country" name="country" id="country" required>
    <br><br>

    <label for="birthday">Date of Birthday:</label>
    <input type="date" id="birthday" name="birthday">
    <br><br>
  

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
    <br><br>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="#">Log in</a>.</p>
  </div>
</form>
  <?php } ?>


  <?php function drawLoginForm() { ?>
  <form action="action_login.php" method="post" class="login">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <button type="submit">Login</button>
  </form>
  <a href="register.php">Register</a>   
<?php } ?>


<?php function drawLogoutForm(string $name) { ?>
  <form action="action_logout.php" method="post" class="logout">
    <a href="profile.php"><?=$name?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>