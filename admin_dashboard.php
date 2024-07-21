<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit();
}

include('header.php');
?>

<div class="container">
  <h1 class="my-4">Admin Dashboard</h1>
  <p>Welcome, Admin! You can add products here.</p>
  <a href="add_product.php" class="btn btn-primary">Add Product</a>
</div>

<?php include('footer.php'); ?>
