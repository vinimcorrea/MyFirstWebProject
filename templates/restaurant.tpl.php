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
        <input id="search-restaurants" type="search" placeholder="Search..." autofocus required />  
      </form>
    </div>
  </header>
  <h3 id="title_ctg"> Categories </h3>
  <div class="categories-select">
    <form method="get">
    <select name="rest-category" id="search-restaurant-by-category">
        <option value="All">All</option>
        <?php foreach($categories as $category){ ?>
          <option value="<?=$category->name?>"><?=$category->name?></option>
        <?php } ?>
    </select>
    </form>
  </div>  
  <h3 id="title_rest"> Restaurants </h3>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <div class="rest_items">
        <img src="https://picsum.photos/200?" alt="Screen 2" <?=$restaurant->restaurantId?>">
        <span class="caption">
          <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
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

<?php function drawRestaurant(Restaurant $restaurant, array $categories, array $dishes, Address $address, bool $isOwner) { ?>

  <?php if($isOwner) {?>
    <div> 
      <a href="">edit restaurant</a>
    </div>

    <div>
      <a href="../pages/add_dish.php">add dish</a>
    </div>
  <?php } ?>



  <header class="restBanner">
    <img src="https://picsum.photos/200?" alt="banner" <?=$restaurant->restaurantId?>">
  </header>
  <div class="rest_design">
    <img src="https://picsum.photos/200?" alt="Screen 1" <?=$restaurant->restaurantId?>">
    <h1 class="RestaurantName"><?=$restaurant->restaurantName?></h1>
    <p id="reviewRest"><?=$restaurant->review?> </p>
  
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
  </div>

  <section id="restaurants">
  <input id="search-dishes" type="search" placeholder="Search..." autofocus required/>
    <?php foreach($categories as $category) { ?>
      <?php drawCategory($category, $dishes); ?>
      <?php } ?>
  </section>
<?php } ?>

<?php function drawCategory(Category $category, array $dishes){ ?>
      <?php foreach($dishes as $dish) { ?>
          <?php if($dish->categoryId === $category->categoryId){ ?>
            <div class="RestaurantCategory">
            <h2 class="CategoryName"><?=$category->name?></h2>
            <?php DrawDish($dish); ?>
          <?php } ?>
      <?php } ?>
  </div>
<?php } ?>

<?php function DrawDish(Dish $dish){ ?>
  <article id="dishes">
  <li class="restaurantDish">
    <span class="DishName">
      <p><?=$dish->name?></p>
    </span>
    <span class="DishDescription">
      <?=$dish->ingredients?>
    </span>
    <span class="DishPrice">
      <?=number_format($dish->price, 2, '.', '')?> €
    </span>
    <span class="DishIsVegan">
      <?=$dish->isVegan?>
    </span> 
  </li> 
  <form action="../actions/action_create_order.php" method="post">
  <input type="number"name="rest-name" required>
  <button type="submit" class="registerbtn">Purchase</button>
  </form>
  </article>
  
<?php } ?>


<?php function drawOwnerRestaurants(array $restaurants, array $categories){ ?>
  <h3 id="title_rest"> My Restaurants </h3>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?>
      
      <div class="rest_items">
        <img src="https://picsum.photos/200?" alt="Screen 2" <?=$restaurant->restaurantId?>">
        <span class="caption">
          <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
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