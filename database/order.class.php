<?php 

class Order
{
    public int      $orderId;
    public string   $customerId;
    public int      $restaurantId;
    public float    $price;
    public DateTime $Time;
    public string   $status;
    public string   $note;
    public ?int     $customer_addressId;  


    public function __construct(int $orderId, string $customerId, int $restaurantId, float $price, DateTime $datetime,  string $status, string $note, int $customer_addressId)
    {
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->restaurantId = $restaurantId;
        $this->price = $price;
        $this->datetime = $datetime;
        $this->status = $status;
        $this->note = $note;
        $this->customer_addressId = $customer_addressId;
    }


    static function createOrder(PDO $db, int $restaurantId, string $customerId, float $price, string $note, int $customer_addressId)
    {
    
        $date = new DateTime('now');
        $stmt = $db->prepare('
        INSERT INTO _Order(CustomerId, RestaurantId, TotalPrice, DateTime, Status, Note, AddressId) 
        VALUES(:CustomerId, :RestaurantId, :TotalPrice, :DateTime, :Status, :Note, :AddressId)');

    
        if($stmt->execute([
            ':CustomerId'       => $customerId,
            ':RestaurantId'     => $restaurantId,
            ':TotalPrice'       => $price,
            ':DateTime'         => $date->format('d-M-Y H:i:s'),
            ':Status'           => "Received",
            ':Note'             => $note,   
            ':AddressId'        => $customer_addressId
        ]));
    }

    static function getOrder(PDO $db, int $restaurantId, string $customerId, float $price, string $note, int $customer_addressId) : Order
    {
    
        $date = new DateTime('now');
        $stmt = $db->prepare('
        INSERT INTO _Order(CustomerId, RestaurantId, TotalPrice, DateTime, Status, Note, AddressId) 
        VALUES(:CustomerId, :RestaurantId, :TotalPrice, :DateTime, :Status, :Note, :AddressId)');

    
        if($stmt->execute([
            ':CustomerId'       => $customerId,
            ':RestaurantId'     => $restaurantId,
            ':TotalPrice'       => $price,
            ':DateTime'         => $date->format('d-M-Y H:i:s'),
            ':Status'           => "Received",
            ':Note'             => $note,   
            ':AddressId'        => $customer_addressId
        ]));
    }

    static function getOwnerOrders(PDO $db, int $restaurantId, string $customerId, float $price, string $note, int $customer_addressId) : array
    {
    
        $date = new DateTime('now');
        $stmt = $db->prepare('
        INSERT INTO _Order(CustomerId, RestaurantId, TotalPrice, DateTime, Status, Note, AddressId) 
        VALUES(:CustomerId, :RestaurantId, :TotalPrice, :DateTime, :Status, :Note, :AddressId)');

    
        if($stmt->execute([
            ':CustomerId'       => $customerId,
            ':RestaurantId'     => $restaurantId,
            ':TotalPrice'       => $price,
            ':DateTime'         => $date->format('d-M-Y H:i:s'),
            ':Status'           => "Received",
            ':Note'             => $note,   
            ':AddressId'        => $customer_addressId
        ]));
    }



}

class OrderedDish
{
    public int $orderId;
    public int $dishId;
    public int $quantity;

    /**
     * @param int $orderId
     * @param int $dishId
     * @param int $quantity
     */
    public function __construct(int $orderId, int $dishId, int $quantity)
    {
        $this->orderId  = $orderId;
        $this->dishId   = $dishId;
        $this->quantity = $quantity;
    }


    static function getOrderDishes(PDO $db, int $orderId): array
    {
        $stmt = $db->prepare('
        SELECT Dish.DishId, Name, Price, Ingredients, Vegan, RestaurantId, ImageId
        FROM OrderedDish, Dish 
        WHERE Dish.DishId = OrderedDish.DishId
        AND OrderId = ?');
        $stmt->execute(array($orderId));
        $dishes = array();

        while ($order = $stmt->fetch()) {
            $dishes[] = Dish::getDish($db, $order['dishId']);
        }

        return $dishes;
    }

    static function addDishToOrder(PDO $db, $orderId, $dishId, $quantity)
    {
        $stmt = $db->prepare('
        INSERT INTO OrderedDish(OrderId, DishId, quantity) 
        VALUES(:OrderId, :DishId, :quantity)');

        $stmt->execute([
            ':OrderId'         => $orderId,
            ':DishId'          => $dishId,
            ':quantity'        => $quantity
        ]); 
    }
}

?>