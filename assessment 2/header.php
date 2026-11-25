<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TechTalk</title>
  <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>

<!-- Menu with logo and search bar -->
<nav class="navbar navbar-dark bg-brand mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="images/logo.svg" height="30" alt="logo"> TechTalk</a>
    <form action="search.php" class="d-flex">
      <input name="q" class="form-control me-2" placeholder="Search users">
      <button class="btn btn-light">Search</button>
    </form>
    <div>
      <?php if (isset($_SESSION['id'])) { ?>
        <a class="text-white me-2" href="profile.php?id=<?php echo $_SESSION['id']; ?>">My profile</a>
        <a class="text-white" href="logout.php">Logout</a>
      <?php } else { ?>
        <a class="text-white me-2" href="login.php">Login</a>
        <a class="text-white" href="register.php">Register</a>
      <?php } ?>
    </div>
  </div>
</nav>
<div class="container">
