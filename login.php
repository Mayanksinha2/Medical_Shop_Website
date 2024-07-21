<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['role'] = $row['role'];
      if ($row['role'] == 'admin') {
        header("Location: admin_dashboard.php");
      } else {
        header("Location: products.php");
      }
      exit();
    } else {
      echo "Invalid password.";
    }
  } else {
    echo "No user found with that email.";
  }
  
  $conn->close();
}
?>

<?php include('header.php'); ?>
<div class="contain">
  <h1 class="my-4">Login</h1>
  <form method="post" action="login.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
<?php include('footer.php'); ?>
