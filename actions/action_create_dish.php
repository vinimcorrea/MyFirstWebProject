<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: ../pages/profile.php'));
    

    require_once(__DIR__ . '/../database/connection.db.php');
    
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');


    require_once(__DIR__ . '/../templates/forms.tpl.php');

    $db = getDatabaseConnection();

    $user = User::getUser($db, $session->getEmail());


    $categories  = Category::getCategories($db, 3);
    foreach($categories as $category){
        if($category->name == $_POST['dish-categ']){
            $categoryId = $category->categoryId;
            $need = true;
        }
    }

    if(!$need){
        $category = Category::createCategory($db, $_POST['dish-categ']);
        $categoryId = $db->lastInsertId();
    }

    $vegan_dish = false;

    if(!empty($_POST['dish-vegan'])){
        $dish = Dish::createDish($db, $_POST['dish-name'], $_POST['dish-price'], $_POST['dish-ing'], boolval(1), $categoryId, $_SESSION['id']);
    } else {
        $dish = Dish::createDish($db, $_POST['dish-name'], $_POST['dish-price'], $_POST['dish-ing'], boolval(0), $categoryId, $_SESSION['id']);
    }


    header('Location: ../pages/restaurant.php?id=' . $_SESSION['id']);
?>