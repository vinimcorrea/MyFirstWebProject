<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if ($session->isLoggedIn()){
        $session->addMessage('error', 'You are already logged in');
    };

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../templates/forms.tpl.php');

    $db = getDatabaseConnection();


    if($_POST['owner'] === "Owner"){
        $isOwner = true;
    } else {
        $isOwner = false;
    }

    $user = User::createUser($db, $_POST['email'], $_POST['password'],$_POST['first-name'], $_POST['last-name'], $_POST['mobile'], $isOwner);

    $customer = User::getCustomerWithPassword($db, $_POST['email'], $_POST['password']);

    if ($customer) {
        $session->setId($customer->id);
        $session->setName($customer->name());
        $session->addMessage('success', 'Login successful!');
      } else {
        $session->addMessage('error', 'Wrong password!');
      }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>