<?php
declare(strict_types=1);

class Restaurant{
    public int    $restaurantId;
    public string $restaurantName;
    public string $street;
    public string $city;
    public string $province;
    public string $country;
    public string $review;
    public string $price;
    public int    $ownerId;

    function __construct(int $id, string $logo, string $restaurantName, string $street, string $city, string $province, string $country, string $review, string $price){
        $this->id = $id;
        $this->restaurantName = $restaurantName;
        $this->street = $street;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->review = $review;
        $this->price = $price;
        $this->ownerId = $ownerId;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE Restaurant SET restaurantName = ?
            WHERE RestaurantId = ?');

        $stmt->execute(array($this->RestauratName, $this->id));
    }

    static function getRestaurant(PDO $db, int $id): Restaurant
    {
        $stmt = $db->prepare('SELECT restaurantId, name, category FROM Restaurant WHERE restaurantId = ?');
        $stmt->execute(array($id));

        $restaurant = $stmt->fetch();

        return new Restaurant(
            $restaurant['RestaurantId'],
            $restaurant['RestaurantName'],
            $restaurant['Street'],
            $restaurant['City'],
            $restaurant['Province'],
            $restaurant['Country'],
            $restaurant['Review'],
            $restaurant['Price'],
            $restaurant['OwnerId']
        );
    }

}

?>