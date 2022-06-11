<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/order.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/order.tpl.php');

  $db = getDatabaseConnection();


  //$orders = Order::getCustomerOrders($db, $userId);

   
  drawHeader($session);
  drawOrderTable();
  drawFooter();                                                                                                                       
?>