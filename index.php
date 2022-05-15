<?php
    declare(strict_types = 1);

    session_start();

    require_once('database/connection.db.php');
    require_once('database/restaurant.class.php');
    require_once('database/customer.class.php');

    require_once('templates/common.tpl.php');

    $db = getDatabaseConnection();

    //$customers = Customer::getCostumer($db, 8);

    drawHeader();
    // drawMainPage();
    drawFooter();

?>
