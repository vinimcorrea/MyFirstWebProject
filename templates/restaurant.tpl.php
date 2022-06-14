<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/category.class.php');
  require_once(__DIR__ . '/../database/menu.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');
?>

<?php function drawRestaurants(array $restaurants, array $categories) { ?>
  <header class="main_rest">
    <div class="searchRestaurant">
      <p id="title-main-page"> What you need is here.</p>
      <p id="second-title-main-page">Ask and receive wherever you are.</p>
      <form class="mainsearch" onsubmit="event.preventDefault();" role="search">
        <input id="search-restaurants" type="search" placeholder="Search Restaurants..." autofocus required />  
      </form>
    </div>
  </header>
  <h2 class="title">Categories</h2>
  <div class="categories-select">
    <form method="get">
    <select name="rest-category" id="search-restaurant-by-category">
    <option value="" disabled selected>Select Your Desired Category</option>
        <?php foreach($categories as $category){ ?>
          <option value="<?=$category->name?>"><?=$category->name?></option>
        <?php } ?>
    </select>
    </form>
  </div>  
  <h2 class="title">Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <div class="rest_items">
        <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
        <img src="../images/restaurants/thumbs_small/<?=$restaurant->imageId?>.jpg" alt="Screen 2" <?=$restaurant->restaurantId?>">
        </a>
        <span class="caption">
          <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
              <?=$restaurant->restaurantName?>
          </a>
          <?php $db = getDatabaseConnection(); ?>
          <?php $category = Category::getCategory($db, $restaurant->categoryId)?>
          <p><?=$category->name?></p>
        </span>
      </div>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $categories, array $dishes, Address $address, bool $isOwner, int $bannerImageId, Session $session) { ?>



  <header class="restBanner">
    <img src="../images/banners/originals/<?=$bannerImageId?>.jpg" alt="banner" <?=$bannerImageId?>">
  </header>
  <div class="rest_design">
    <div id="design-right">
    <img src="../images/restaurants/thumbs_small/<?=$restaurant->imageId?>.jpg" alt="Screen 1" <?=$restaurant->restaurantId?>">
    <h1 class="RestaurantName"><?=$restaurant->restaurantName?></h1>
    <p id="rest-price-cifer"><?=$restaurant->price?></p>
    
  <?php if ($session->isLoggedIn())
    drawMarkRestaurantAsFavorite(Restaurant::isFavoriteRestaurantDB($session->getEmail(), $restaurant->restaurantId));
    ?>
    </div>
    <?php if($isOwner) {?>
    <div id="restaurant-tools">  
      <a href="../pages/edit_restaurant.php"><img src="../images/assets/pencil-icon.png" width="50" height="50"></a>
      <a href="../pages/add_dish.php"><img src="../images/assets/add-dish-icon.png" width="50" height="50" id="add-dish-icon"></a>
    </div>
  <?php } ?>
  </div>

  <div class="user-data">
    <p><?= $address->addressOne?>, <?= $address->addressTwo?>. <?= $address->city?></p>
  </div>

  <input id="search-dishes" type="search" placeholder="Search Dishes" autofocus required/>
  <section id="restaurants">
    <?php foreach($categories as $category) { ?>
      <?php drawCategory($category, $dishes); ?>
      <?php } ?>
  </div>
  </section>
<?php } ?>

<?php function drawCategory(Category $category, array $dishes){ ?>
    <?php $alreadyDrawnCategoryTitle = false?>
    <div class="restaurant-container">
      <?php foreach($dishes as $dish) { ?>
          <?php if($dish->categoryId === $category->categoryId){ ?>
            <?php if(!$alreadyDrawnCategoryTitle) {?>
              <div id="category-title">
              <h2 class="title"><?=$category->name?></h2>
              </div>
              <?php $alreadyDrawnCategoryTitle =true;?>
            <?php } ?>
            <div class="RestaurantCategory" dish-id="<?=$dish->dishId?>">
            <?php DrawDish($dish); ?>
          <?php } ?>
            </div>
      <?php } ?>
    </div>
<?php } ?>

<?php function DrawDish(Dish $dish){ ?>
    <img src="../images/dishes/thumbs_small/<?=$dish->imageId?>.jpg" alt="Screen 1">
    <div>
    <h3 id="dish-name"><?=$dish->name?></h3>
    <p id="dish-price"><?=number_format($dish->price, 2, '.', '')?></p>
    <p class="DishIngredients">
      <?=$dish->ingredients?>
    </p>
</div>
  <input class="quantity" type="number" value="1" min="1">
  <button type="submit" id="register-btn">Purchase</button>
  
<?php } ?>


<?php function drawOwnerRestaurants(array $restaurants, array $categories){ ?>
  <hr>
  <h2 class="title">My Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?>
      
      <div class="rest_items">
        <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
          <img src="../images/restaurants/thumbs_small/<?=$restaurant->imageId?>.jpg" alt="Screen 2" <?=$restaurant->restaurantId?>">
        </a>
        <span class="caption">
          <a href="/../pages/restaurant.php?id=<?=$restaurant->restaurantId?>">
              <?=$restaurant->restaurantName?>
          </a>
          <?php $db = getDatabaseConnection(); ?>
          <?php $category = Category::getCategory($db, $restaurant->categoryId)?>
          <p><?=$category->name?></p>
        </span>
      </div>
      </article>
    <?php } ?>
  </section>

<?php } ?>


<?php 

function drawMarkRestaurantAsFavorite(bool $isChecked){ ?>
  <?php 
    $imageUrl = $isChecked ? "../images/assets/favorite-star-full.png"
        :  "../images/assets/favorite-star-empty.png"
            ?>
    <form action="../actions/action_favorite_restaurant.php" method="post">
      <label><input name="isChecked" type="checkbox" class="hide" value="<?=$isChecked?"true":"false"?>" <?=$isChecked? "checked = 'checked'":""?> ></label>
      <button type="submit" id="favorite-btn"><img src="<?=$imageUrl?>" width="20" height="20"></button>
    </form>

<?php } ?>
