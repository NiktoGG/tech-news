<?php
include 'header.php';
$result = "";

if (isset($_POST['username'])) {
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    // Check the password against the saved hash
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['level'] = $user['level'];
        $result = "ok";
    } else {
        $result = "wrong";
    }
}
?>
<h2>Login</h2>
<!-- JavaScript shows the message here -->
<p id="message"></p>
<form method="post">
  <input name="username" class="form-control mb-2" placeholder="Username" required>
  <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
  <button class="btn btn-primary">Login</button>
</form>
<script>var loginResult = "<?php echo $result; ?>";</script>
<?php include 'footer.php'; ?>
