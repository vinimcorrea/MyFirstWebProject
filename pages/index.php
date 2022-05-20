<?php
    declare(strict_types = 1);

    session_start();

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');

    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/restaurant.tpl.php');

    $db = getDatabaseConnection();

    $restaurants = Restaurant::getRestaurants($db, 3);
    $categories  = Category::getCategories($db, 3);

    drawHeader();
    drawRestaurants($restaurants, $categories);
    drawFooter();

?>
