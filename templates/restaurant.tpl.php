<?php 
  declare(strict_types = 1); 

  require_once('database/restaurant.class.php')
?>

<?php function drawRestaurants(array $restaurants) { ?>
  <header>
    <h2>Artists</h2>
    <input id="searcrestaurant" type="text" placeholder="search">
  </header>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="https://picsum.photos/200?<?=$restaurant->id?>">
        <a href="restaurants.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menus) { ?>
  <h2><?=$restaurant->name?></h2>
  <section id="albums">
    <?php foreach ($albums as $album) { ?>
    <article>
      <img src="https://picsum.photos/200?<?=$album->id?>">
      <a href="album.php?id=<?=$album->id?>"><?=$album->title?></a>
      <p class="info"><?=$album->tracks?> tracks / <?=$album->length?> min</p>
    </article>
    <?php } ?>
  </section>
<?php } ?>