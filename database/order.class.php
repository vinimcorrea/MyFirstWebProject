<?php 

class Order
{
    public int      $orderId;
    public int      $customerId;
    public int      $restaurantId;
    public float    $price;
    public DateTime $Time;
    public string   $status;
    public string   $note;


    public function __construct(int $orderId, int $customerId, int $restaurantId, float $price, DateTime $datetime,  string $status, string $note)
    {
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->restaurantId = $restaurantId;
        $this->price = $price;
        $this->datetime = $datetime;
        $this->status = $status;
        $this->note = $note;
    }


    static function addOrder(PDO $db, int $restaurantId, int $customerId, float $price, string $note)
    {
        

        $date = new DateTime('now');
        $stmt2 = $db->prepare('INSERT INTO _Order VALUES(NULL,?,?,?,?,?)');
        $stmt2->execute(array($customerId, $restaurantId, "received", $date->format('YYYY-mm-dd HH:ii:ss'), $addressId));


        return $db->lastInsertId();

    }



}

?>