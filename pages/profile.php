<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: ../index.php'));

  require_once(__DIR__ . '/../database/address.class.php');
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/profile.tpl.php');

  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

  $user    = User::getUser($db, $session->getEmail());

  $address = Address::getAddressWithEmail($db, $session->getEmail());

  drawHeader($session);
  drawProfile($db, $user, $address);
  drawFooter();

?>