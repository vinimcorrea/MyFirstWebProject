<?php 
  declare(strict_types = 1); 
?>

<?php function drawProfile(User $user){ ?>

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

 
        <a href="" class="edit_profile">Change Password </a>

    </section>

<?php } ?>

<?php function drawProfileAddress(User $user){ ?>
    


<?php } ?>