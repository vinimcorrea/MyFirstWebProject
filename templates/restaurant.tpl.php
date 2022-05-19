<?php 
  declare(strict_types = 1); 

  require_once('database/restaurant.class.php')
?>

<?php function drawRestaurants(array $restaurants) { ?>
  <header>
    <div class="searchRestaurant">
      <p> What you need is here. Ask and receive wherever you are. 
      </p>
      <form onsubmit="event.preventDefault();" role="search">
        <label for="search">Search for stuff</label>
        <input id="search" type="search" placeholder="Search..." autofocus required />
        <button type="submit">Go</button>    
      </form>
    </div>
  </header>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <div class="rest_items">
        <img src="https://picsum.photos/200? alt="Screen 2" <?=$restaurant->id?>">
        <span class="caption">
          <a href="restaurants.php?id=<?=$restaurant->id?>">
              <?=$restaurant->restaurantName?>
          </a>
        </span>
      </div>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menus, array $categories, array $dishes) { ?>
  <h1 class="RestaurantName"><?=$restaurant->RestaurantName?></h1>
  <a href="restaurant.php?id=<?=$restaurant->RestaurantId?>">
    <img class="RestaurantLogo" src="<?=""?>" alt="Restaurant's Logo">
  </a>
  <?=$restaurant->Review?>
  <section id="restaurants">
    <?php foreach($menus as $menu) { ?>
      <?php if($menu->RestaurantId == $restaurant->RestaurantId) {?>
        <?php drawMenu($menu, $dishes, $categories); ?>
        <?php } ?>
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
            <?php DrawDish($dish); ?>
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
