<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.db.php');
  require_once('database/restaurant.class.php');
  require_once('database/menu.class.php');
  require_once('database/parts.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/menu.tpl.php');

  $db = getDatabaseConnection();

  $album = Album::getMenu($db, intval($_GET['id']));
  $artist = Artist::getRestaurant($db, $menu->restaurant);
  $tracks = Track::getMenuParts($db, intval($_GET['id']));

  drawHeader();
  drawMenu($menu, $restaurant, $parts);
  drawFooter();
?>