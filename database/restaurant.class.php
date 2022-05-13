<?php

class Restaurant{
    public int $id;
    public string $logo;
    public string $restaurantName;
    public string $street;
    public string $city;
    public string $province;
    public string $country;
    public string $review;
    public string $price;

    function __construct(int $id, string $logo, string $restaurantName, string $street, string $city, string $province, string $country, string $review, string $price){
        $this->id = $id;
        $this->logo = $logo;
        $this->restaurantName = $restaurantName;
        $this->street = $street;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->review = $review;
        $this->price = $price;
    }

    function save($db){
        $stmt = $db->prepare('
            UPDATE Restaurant SET restaurantName = ?
            WHERE RestaurantId = ?');

        $stmt->execute(array($this->RestauratName, $this->id));
    }
}

?>