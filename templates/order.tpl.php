<?php 
  declare(strict_types = 1); 

?>

<?php function drawOrderTable(){ ?>
    <h2>Shopping Cart</h2>
    <section id="cart">
      <table>
        <thead>
          <tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr>
        </thead>
        <tfoot>
          <tr><th colspan="1">Total:</th><th id="total-price-order">0</th></tr>
        </tfoot>
      </table>
      <div id="order-btn-container">
      <button type="submit" id="order-btn">Order</button>
      </div>  
    </section>
<?php } ?>

<?php function drawNotOrdered() { ?>
  <p id="no-order"> No orders around here ;(</p>
<?php } ?>

<?php function drawOrderedCustomer(Order $order, array $dishes) { ?>
  <div class="user-order">
  <h2 class="order-customer-title">Your Order status: <?=$order->status?></h2>
  <p id="date-order">
  <?=$order->datetime?>
  </p>
  <label>Total Price:</label>
  <p id="dish-price">
  <?=$order->price?>
  </p>

  <?php foreach($dishes as $dish){ ?>
    <p>
    <?=$dish['quantity']?>x
    <?=$dish['Name']?>
  </p>
  <?php }?>
  </div>
<?php } ?>

<?php function drawOrderedOwner(array $dishes, $order, Restaurant $restaurant){ ?>
   <div class="order-organization">
    <div class ="user-data">
      <h4>Date and Time</h4>
      <p><?=$order['DateTime']?></p>
      </div>
      <div class ="user-data">
      <h4>Food Order</h4>
      <p>
      <?php foreach($dishes as $dish){ ?>
        <?=$dish['quantity']?>x
        <?=$dish['Name']?>
      <?php }?>
      </p>
      </div>
      
      <div class="user-data">
      <h4>Price</h4>
      <p><?=$order['TotalPrice']?></p>
      </div>
      <div class="user-data">
      <h4 customer-order-id="<?=$order['OrderId']?>">Customer Name:</h4>
      <p>
      <?=$order['FirstName']?>
      <?=$order['LastName']?>
      </p>
      </div>
      <div class ="user-data">
      <h4>Customer Address:</h4>
      <p>
        <?=$order['AddressLineOne']?>
        <?=$order['AddressLineTwo']?>
        <?=$order['City']?>
        <?=$order['Country']?>
        <?=$order['postalcode']?>
      </p>
      </div>
      <div class ="user-data">
        <?php if($order['Status'] == "Delivered") {?>
          <h4>Order is delivered!</h4>
          <form method="post" action="../actions/action_delete_order.php">
          <input type="number" name="package-order-id" class="hide" value="<?=$order['OrderId']?>">
          <button type="submit" id="delete-btn"><img src="../images/assets/delete-icon.jpeg" width="35" height="35"></button>
          </form>
        <?php } else {?>
          <h4>Change Status:</h4>
          <p><?=$order['Status']?></p>
          <form method="post" action="../actions/action_change_order_status.php">
          <select name="change-order-status" class="select-form">
            <option value="" disabled selected>Select Status</option>
            <option value="Received">Received</option>
            <option value="Preparing">Preparing</option>
            <option value="Ready">Ready</option>
            <option value="Delivered">Delivered</option>
          </select>
          <input type="number" class="hide" name="package-order-id" value="<?=$order['OrderId']?>">
          <button type="submit" id="register-btn">submit</button>
          </form>
      <?php } ?>
    </div>
  </div>

<?php }?>

<?php function drawNoAddress() { ?>
  <p id="no-address">Add your address to create your first order!</p>
<?php } ?>

<?php function drawOrderBeingProcessed() { ?>
  <p id="order-processed">Your order is being processed! See it's status in "My Orders"</p>
<?php } ?>

<?php function drawRestaurantOrder(Restaurant $restaurant){ ?>
  <div id="user-container">
  <h2>You have received orders!</h2>
  <h4>From your restaurant: <?=$restaurant->restaurantName?></h4>
<?php } ?>