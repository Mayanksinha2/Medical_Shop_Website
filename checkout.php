<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medical_shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $total_price = $_POST['total_price'];

  $sql = "INSERT INTO orders (user_id, total_price) VALUES ('$user_id', '$total_price')";

  if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id;
    echo "Order placed successfully. Order ID: " . $order_id;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  // Clear the cart
  $sql = "DELETE FROM cart WHERE user_id='$user_id'";
  $conn->query($sql);
  
  $conn->close();
}
?>

<?php include('header.php'); ?>
<div class="container">
  <h1 class="my-4">Checkout</h1>
  <form method="post" action="checkout.php">
    <div class="form-group">
      <label for="total_price">Total Price:</label>
      <input type="text" class="form-control" id="total_price" name="total_price" required>
    </div>
    <button type="submit" class="btn btn-primary">Place Order</button>
  </form>
</div>
<?php include('footer.php'); ?>
