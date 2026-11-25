<?php
include 'header.php';

if (isset($_POST['username'])) {
    // Encrypt the password before saving
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (username, password, level) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['username'], $hash, $_POST['level']]);
    echo "<p class='alert alert-success'>Registered! Now <a href='login.php'>log in</a>.</p>";
}
?>
<h2>Register</h2>
<form method="post">
  <input name="username" class="form-control mb-2" placeholder="Username" required>
  <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
  <select name="level" class="form-select mb-2">
    <option value="1">Level 1 (post and comment)</option>
    <option value="2">Level 2 (post, comment and delete)</option>
  </select>
  <button class="btn btn-primary">Register</button>
</form>
<?php include 'footer.php'; ?>
