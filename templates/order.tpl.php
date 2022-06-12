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
      <input typ
      <input type="text" id="order-note" placeholder="leave an optional note"> 
      <label id="confirm-order">Confirm Order</label>
      <button type="submit" id="confirm-order-now">Order</button>
    </section>
<?php } ?>

<?php function drawNotOrdered() { ?>
  <p id="no-order"> No orders around here ;(</p>
<?php } ?>

<?php function drawOrderedCustomer(Order $order, array $dishes) { ?>
  <h2>Your Order</h2>
  <?=$order->price?>

<?php } ?>