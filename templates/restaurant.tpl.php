<?php 
  declare(strict_types = 1); 

  require_once('database/restaurant.class.php')
?>

<?php function drawRestaurants(array $restaurants) { ?>
  <header>
    <h2>Restaurant</h2>
    <input id="searchrestaurant" type="text" placeholder="search">
  </header>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="https://picsum.photos/200?<?=$restaurant->RestaurantId?>">
        <a href="restaurants.php?id=<?=$restaurant->RestaurantId?>"><?=$restaurant->name?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menus) { ?>
  <h1 class="RestaurantName"><?=$restaurant->name?></h1>
  <a href="restaurant.php?id=<?=$restaurant->restaurantId?>">
    <img class="RestaurantLogo" src="<?=""?>" alt="Restaurant's Logo">
  </a>
  <section id="restaurants">
    <?php foreach ($albums as $album) { ?>
    <article>
      <img src="https://picsum.photos/200?<?=$album->id?>">
      <a href="album.php?id=<?=$album->id?>"><?=$album->title?></a>
      <p class="info"><?=$album->tracks?> tracks / <?=$album->length?> min</p>
    </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawMenu(Menu $menu, array $dishes, array $categories){ ?>
  <h2 class="MenuName"><?=$menu->$name?></h2>
  <div class="RestaurantMenu">
    <?php foreach($categories as $category){ ?>
      <h3 class="CategoryName"><?=$category->$name?><h3>
      
        <?php foreach($dishes as $dish) { ?>
          <?php if($dish->CategoryId === $category->CategoryId){?>
            <?php DrawDish($dish) ?>
          <?php } ?>
        <?php } ?>
      <?php } ?>
  </div>
<?php } ?>

<?php function DrawDish(Dish $dish){ ?>
  <li class="restaurantDish">
    <span class="DishName">
      <a href="menu.php?id=<?=$dish->dishId?>"><?=$dish->name?></a>
    </span>
    <span class="DishDescription">
      <?=$dish->description?>
    </span>
    <span class="DishPrice">
      <?=number_format($dish->price, 2, '.', '')?>
    </span>
    <span class="DishIsVegan">
      <?=$dish->isVegan?>
    </span> 
  </li>

<?php } ?>
