<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/profile.php'));
    

    require_once(__DIR__ . '/../database/connection.db.php');
    
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/address.class.php');


    require_once(__DIR__ . '/../templates/forms.tpl.php');

    $db = getDatabaseConnection();

    $user = User::getUser($db, $session->getEmail());
    //if (!$user->IsOwner) die(header('Location: ../pages/profile.php')); // add 404 page not found


    $add = Address::createAddress($db, $_POST['rest-addr-one'], $_POST['rest-addr-two'],$_POST['rest-city'], $_POST['rest-country'], $_POST['rest-postalcode']);

    $Addressid = $db->lastInsertId();

    $category = Category::getCategoryByName($db, $_POST['rest-category']);

    $restaurant = Restaurant::createRestaurant($db, $user, $_POST['rest-name'], $_POST['rest-review'], $_POST['rest-price'], $category->categoryId);

    $RestaurantId = $db->lastInsertId();

    $stmt = $db-> prepare('
        INSERT INTO RestaurantAddress(RestaurantId, AddressId) 
        VALUES(:RestaurantId, :AddressId)'
    );

    $stmt->execute([
        ':RestaurantId' => $RestaurantId,
        ':AddressId'    => $Addressid   
    ]);

    header('Location: ../pages/profile.php');
?>