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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is an actual image or fake image
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if ($check !== false) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$target_file')";

      if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "File is not an image.";
  }
  
  $conn->close();
}
?>

<?php include('header.php'); ?>
<div class="contain">
  <h1 class="my-4">Add Product</h1>
  <form method="post" action="add_product.php" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Product Name:</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="text" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
  </form>
</div>
<?php include('footer.php'); ?>
