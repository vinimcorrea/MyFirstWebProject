<?php 
  declare(strict_types = 1); 

  require_once('database/restaurant.class.php');
  require_once('database/menu.class.php');
?>

<?php function drawMenu( Menu $menu, Restaurant $restaurant, array $parts) { ?>
  <h2><?=$menu->title?></h2>
  <h3><a href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a></h3>      
  <table id="parts">
    <tr><th scope="col">#</th><th scope="col">Title</th><th scope="col">Duration</th></tr>
    <?php foreach ($parts as $id => $part) { ?>
      <tr><td><?=$id + 1?></td><td><?=$part->name?></td><td><?=$part->time()?></td></tr>
    <?php } ?>
    </table>
<?php } ?>