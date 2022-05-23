<?php function drawRegisterForm() { ?> 
  <form action="../actions/action_register.php" method="post">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>

    <div>
    <label for="user">User:</label>
        <select name="user-type">
            <option value="Owner">Owner</option>
            <option value="Customer">Customer</option>
        </select>
    </div>  

    <div>
      <label for="email">Email:</label>
      <input type="email" placeholder="email" name="email" required>
    </div>

    <div>
      <label for="psw">Password:</label>
      <input type="password" placeholder="password" name="password" required>  
    </div>

    <div>
      <label for="first-name">First Name:</label>
      <input type="text" placeholder="first name" name="first-name" required>
    </div> 
    
    <div> 
      <label for="last-name">Last Name:</label>
      <input type="text" placeholder="last name" name="last-name" required>
    </div> 

    <div>
      <label for="mobile">Mobile:</label>
      <input type="tel" placeholder="+351" name="mobile" pattern="[0-9]{9}" required>
    </div>
    
    <div>
      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
      <button type="submit" class="registerbtn">Register</button>
    </div>

  <div class="container signin">
    <p>Already have an account? <a href="../pages/login.php">Log in</a>.</p>
  </div>
</form>
  <?php } ?>


  <?php function drawLoginForm() { ?>
  <form action="../actions/action_login.php" method="post" class="login">
    <input type="email" name="login_email" id="login_email" placeholder="email">
    <input type="password" name="login_pswd" id= "login_pswd" placeholder="password">
    <button type="submit" name="login">Login</button>
  </form>
  <a href="register.php">Register</a>   
<?php } ?>


<?php function drawLogoutForm(string $name) { ?>
  <form action="action_logout.php" method="post" class="logout">
    <a href="profile.php"><?=$name?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>

<?php function drawRestaurantForm(){ ?>
  <form action="../actions/action_create_restaurant.php" method="post">
  <div class="container">
    <h1>Add Your Restaurant</h1>

    <div>
      <label for="rest-name">Name:</label>
      <input type="text" placeholder="name" name="rest-name" required>
    </div>

    <div>
      <label for="rest-price">Price:</label>
      <input type="text" placeholder="price" name="rest-price" required>  
    </div>
    

    <div>
      <label for="rest-addr-one">Address Line One:</label>
      <input type="text" placeholder="Address Line One" name="rest-addr-one" required>
    </div> 
    
    <div> 
      <label for="rest-addr-two">Address Line Two:</label>
      <input type="text" placeholder="last name" name="rest-addr-two">
    </div> 

    <div>
      <label for="rest-city">City:</label>
      <input type="text" name="rest-city" placeholder="city" required>
    </div>

    div>
      <label for="rest-country">Country:</label>
      <input type="text" name="rest-country" placeholder="country" required>
    </div>

    div>
      <label for="rest-postalcode">Postalcode:</label>
      <input type="tel" name="rest-postalcode" placeholder="4465-163" pattern="[0-9]{4}-[0-9]{3}" required>
    </div>
    
    <div>
      <p>create restaurant</p>
      <button type="submit" class="registerbtn">Register</button>
    </div>
</form>

<?php } ?>

<?php function drawDishForm(){ ?>
  <form action="../actions/action_create_dish.php" method="post">
  <div class="container">
    <h1>Add Your Restaurant</h1>

    <div>
      <label for="rest-name">Name:</label>
      <input type="text" placeholder="name" name="dish-name" required>
    </div>

    <div>
      <label for="dish-price">Price:</label>
      <input type="text" placeholder="price" name="dish-price" required>  
    </div>
    

    <div>
      <label for="dish-ing">Ingredients:</label>
      <input type="text" name="dish-ing" required>
    </div> 

    <div>
      <label for="dish-vegan">Vegan:</label>
      <input type="radio" id="isvegan" name="dish-vegan-yes" value="yes">
      <input type="radio" id="isvegan" name="dish-vegan-no" value="no">
    
    <div>
      <p>create dish</p>
      <button type="submit" class="registerbtn">submit</button>
    </div>
</form>

<?php } ?>

<?php function drawProfileForm(User $user){ ?>
  <h2>Profile</h2>
  <form action="../actions/action_edit_profile.php" method="post" class="profile">

    <label for="edit-password">Change Password:</label>
    <input id="edit-password" type="password" name="edit-password">

    <label for="edit-first-name">First Name:</label>
    <input id="edit-first-name" type="text" name="edit-first-name" placeholder="<?=$user->firstName?>">
    
    <label for="edit-last-name">Last Name:</label>
    <input id="edit-last-name" type="text" name="edit-last-name" placeholder="<?=$user->lastName?>">  

    <label for="edit-mobile">Mobile:</label>
    <input type="tel" placeholder="(+351) <?=$user->mobile?>" name="edit-mobile" pattern="[0-9]{9}">
    
    <button type="submit">Save</button>
  </form>
<?php } ?>


<?php function drawAddressForm(){ ?>
  <h2>Address</h2>
  <form action="/../actions/action_create_user_address.php" method="post" class="profile">

    <div class="address-form">
      <div>
        <label for="add-one-lb">Address Line One: *</label>
        <input id="add-one" type="text" name="add-one" required>
      </div>

      <div>
        <label for="add-two-lb">Address Line Two:</label>
        <input id="add-two" type="text" name="add-two">
      </div>

      <div>
        <label for="add-city-lb">City: *</label>
        <input id="add-city" type="text" name="add-city" required>  
      </div>

      <div>
        <label for="add-country-lb">Country: *</label>
        <input id="add-country" type="text" name="add-country" required>
      </div>

      <div>
        <label for="add-pc-lb">postalcode: *</label>
        <input type="add-pc" name="add-pc" pattern="[0-9]{4}-[0-9]{3}" required>  
      </div>

      <button type="submit">Save</button>
    </div>
  </form>
<?php } ?>