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

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>
<div class="container">
  <h1 class="my-4">Products</h1>
  <div class="row">
  <?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<div class='col-md-4'>";
      echo "<div class='card'>";
      echo "<img class='card-img-top' src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
      echo "<div class='card-body'>";
      echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
      echo "<p class='card-text'>" . $row['description'] . "</p>";
      echo "<p class='card-text'>Price: $" . $row['price'] . "</p>";
      echo "<form method='post' action='cart.php'>";
      echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
      echo "<button type='submit' class='btn btn-primary'>Add to Cart</button>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
  } else {
    echo "<p>No products available.</p>";
  }
  $conn->close();
  ?>
  </div>
</div>
<?php include('footer.php'); ?>
