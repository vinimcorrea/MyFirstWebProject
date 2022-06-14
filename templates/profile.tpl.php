<?php 
  declare(strict_types = 1); 

?>

<?php function drawProfile(PDO $db, User $user, $address){ ?>

<section>   
    <a href="../pages/edit_profile.php" id="profile-link">Edit Profile</a>

    <?php if($user->getAddressStatus($db)){ ?>
        <a href="../pages/address.php" id="profile-link">Update Address</a>
    <?php } else { ?>
        <a href="../pages/address.php" id="profile-link">Add Address</a>
    <?php } ?>

    <div id="user-container">
        <h2 class="title">Information</h2>
        <div class="user-data">
            <h4>Email</h4>
            <p><?=$user->email?></p>
        </div>

        <div class="user-data">
            <h4>Phone</h4>
            <p><?=$user->mobile?></p>
        </div>
    </div>

        <?php if($user->getAddressStatus($db)){ ?>
            <div class="user-address">

            <div class="user-data">
                <h4>Address Line</h4>
                <p><?=$address->addressOne?></p>
            </div>

            <div class="user-data">
                <h4>Address Complement</h4>
                <p><?=$address->addressTwo?></p>
            </div>

            <div class="user-data">
                <h4>City</h4>
                <p><?= $address->city?></p>
            </div>

            <div class="user-data">
                <h4>Country</h4>
                <p><?= $address->country?></p>
            </div>

            <div class="user-data">
                <h4>Postalcode</h4>
                <p><?= $address->postalcode?></p>
            </div>

        <?php } ?>
        </div>

    </section>

<?php } ?>

<?php function drawFavorite(array $restaurants) {?>
    <h2 class="user-fav-rest">Your favorite restaurants</h2>
    <section id="restaurants">
    <?php foreach($restaurants as $restaurant){ ?>
        <div class="rest_items">
        <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
            <img src="../images/restaurants/thumbs_small/<?=$restaurant->imageId?>.jpg" alt="Screen 2" <?=$restaurant->restaurantId?>">
            </a>
        <span class="caption">
          <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
              <?=$restaurant->restaurantName?>
            </a>
        </span>
        </div>
    <?php } ?>
    </section>

<?php } ?>