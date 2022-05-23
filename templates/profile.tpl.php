<?php 
  declare(strict_types = 1); 

?>

<?php function drawProfile(PDO $db, User $user, $address){ ?>

    <section>
        <div>
            <a href="../pages/edit_profile.php" class="edit_profile">Edit</a>
            <?= ": " . $user->email ?>
        </div>
        
        <div>
            <?= $user->name() ?>
        </div>

        <div>
            <?= $user->mobile ?>
        </div>

        <?php if($user->getAddressStatus($db)){ ?>
            <div>
                <a href="../pages/address.php" class="edit_profile">Update Address</a>
            </div>
            
            <div>
                <h3><?= $user->name() ?>'s Address</h3>
            </div>

            <div>
                <?= $address->addressOne ?>
            </div>

            <div>
                <?= $address->addressTwo ?>
            </div>

            <div>
                <?= $address->city?>
            </div>

            <div>
                <?= $address->country?>
            </div>

            <div>
                <?= $address->postalcode?>
            </div>

        <?php } else { ?>
            <div>
                <a href="../pages/address.php" class="edit_profile">Add Address</a>
            </div>
        <?php } ?>

        <?php if($user->isOwner){ ?>
            <div>
                <a href="../pages/address.php" class="edit_profile">Your restaurants</a>
            </div>  
        <?php } ?>

        <div>
            <a href="../actions/action_logout.php" class="edit_profile">Sign Out</a>
        </div>
    

    </section>

<?php } ?>
