<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical Shop</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-success">
  <a class="navbar-brand text-white" href="index.php"><h3>Medical Shop</h3></a>

  <ul class="navbar-nav ml-auto">
      <!-- <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> -->
      <li class="nav-item"><a class="nav-link" href="about.php"><h5>About Us</h5></a></li>
      <li class="nav-item"><a class="nav-link" href="contact.php"><h5>Contact Us</h5></a></li>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($_SESSION['role'] == 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><h5>Dashboard</h5></a></li>
          <li class="nav-item"><a class="nav-link" href="add_product.php"><h5>Add Product</h5></a></li>
          <li class="nav-item"><a class="nav-link" href="products.php"><h5>Products</h5></a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="products.php"><h5>Products</h5></a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php"><h5>Cart</h5></a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="logout.php"><h5>Logout</h5></a></li>
      <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="register.php"><h5>Register</h5></a></li>
        <li class="nav-item"><a class="nav-link" href="login.php"><h5>Login</h5></a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
