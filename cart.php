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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];
  $quantity = 1; // Default quantity

  $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";

  if ($conn->query($sql) === TRUE) {
    echo "Product added to cart.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$sql = "SELECT p.id, p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id='$user_id'";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>
<div class="container">
  <h1 class="my-4">Shopping Cart</h1>
  <?php
  if ($result->num_rows > 0) {
    $total_price = 0;
    while($row = $result->fetch_assoc()) {
      $total_price += $row['price'] * $row['quantity'];
      echo "<div class='card'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
      echo "<p class='card-text'>Price: $" . $row['price'] . "</p>";
      echo "<p class='card-text'>Quantity: " . $row['quantity'] . "</p>";
      echo "</div>";
      echo "</div>";
    }
    echo "<div class='mt-4'>";
    echo "<h4>Total Price: $" . $total_price . "</h4>";
    echo "<form method='post' action='checkout.php'>";
    echo "<input type='hidden' name='total_price' value='" . $total_price . "'>";
    echo "<button type='submit' class='btn btn-primary'>Proceed to Checkout</button>";
    echo "</form>";
    echo "</div>";
  } else {
    echo "<p>Your cart is empty.</p>";
  }
  $conn->close();
  ?>
</div>
<?php include('footer.php'); ?>
