<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/menu.class.php');
  require_once(__DIR__ . '/../database/category.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');


  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $menus      = Menu::getMenus($db, 3);
  $dishes     = Dish::getDishes($db, 3);
  $categories  = Category::getCategories($db, 3);

  drawHeader($session);
  drawRestaurant($restaurant, $menus, $categories, $dishes);
  drawFooter();                                                                                                                       
?>