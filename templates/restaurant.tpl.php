<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/category.class.php');
  require_once(__DIR__ . '/../database/menu.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');
?>

<?php function drawRestaurants(array $restaurants, array $categories) { ?>
  <header class="main_rest">
    <div class="searchRestaurant">
      <p> What you need is here.<br>Ask and receive wherever you are. 
      </p>
      <form class="mainsearch" onsubmit="event.preventDefault();" role="search">
        <label class="lb-searchbar" for="search">Search for stuff</label>
        <input id="search" type="search" placeholder="Search..." autofocus required />
        <button class="btn-searchbar" type="submit">Go</button>    
      </form>
    </div>
  </header>
  <h3 id="title_rest"> Restaurants </h3>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <div class="rest_items">
        <img src="https://picsum.photos/200?" alt="Screen 2" <?=$restaurant->id?>">
        <span class="caption">
          <a href="/../pages/restaurant.php?id=<?=$restaurant->id?>">
              <?=$restaurant->restaurantName?>
          </a>
          <div class="rest_review">
          <?=$restaurant->review?>
          </div>
          <?php $db = getDatabaseConnection(); ?>
          <?php $category = Category::getCategory($db, $restaurant->categoryId)?>
          <p><?=$category->name?></p>
        </span>
      </div>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menus, array $categories, array $dishes) { ?>
  <header class="restBanner">
    <img src="https://picsum.photos/200?" alt="banner" <?=$restaurant->id?>">
  </header>
  <div class="rest_design">
    <img src="https://picsum.photos/200?" alt="Screen 1" <?=$restaurant->id?>">
    <h1 class="RestaurantName"><?=$restaurant->restaurantName?></h1>
    <p id="reviewRest"><?=$restaurant->review?> </p>
  
  </div>

  <section id="restaurants">
  <input id="search" type="search" placeholder="Search..." autofocus required/>
    <?php foreach($menus as $menu) { ?>
      <?php drawMenu($menu, $dishes, $categories); ?>
      <?php } ?>
  </section>
<?php } ?>

<?php function drawMenu(Menu $menu, array $dishes, array $categories){ ?>
  <div class="RestaurantMenu">
  <h2 class="MenuName"><?=$menu->menuName?></h2>
    <?php foreach($categories as $category){ ?>
      <h3 class="CategoryName"><?=$category->name?><h3>
        <?php foreach($dishes as $dish) { ?>
            <?=$dish->categoryId?>
            <br>
            <?=$category->categoryId?>
            <?php if($dish->categoryId === $category->categoryId){ ?>
  
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
      <?=$dish->ingredients?>
    </span>
    <span class="DishPrice">
      <?=number_format($dish->price, 2, '.', '')?>
    </span>
    <span class="DishIsVegan">
      <?=$dish->isVegan?>
    </span> 
  </li>

<?php } ?>
