<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.db.php');

  require_once('database/restaurant.class.php');
  require_once('database/menu.class.php');
  require_once('database/category.class.php');
  require_once('database/dish.class.php');


  require_once('templates/common.tpl.php');
  require_once('templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $menus      = Menu::getMenus($db, 3);
  $dishes     = Dish::getDishes($db, 3);
  $categories  = Category::getCategories($db, 3);

  drawHeader();
  drawRestaurant($restaurant, $menus, $categories, $dishes);
  drawFooter();                                                                                                                       
?>