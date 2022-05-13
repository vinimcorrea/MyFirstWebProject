<?php
    $id = $_GET['id'];

    $db = new PDO('sqlite:database/database.sql');

    $stmt = $db-> prepare('SELECT * FROM Restaurant WHERE RestaurantId = ?');

    
    
?>