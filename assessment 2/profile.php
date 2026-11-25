<?php
include 'header.php';

// Get user by the id in the URL, for example profile.php?id=1
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_GET['id']]);
$user = $stmt->fetch();
?>
<img src="images/robot.jpg" class="avatar" alt="profile picture">
<h2><?php echo htmlspecialchars($user['username']); ?></h2>
<p>User level: <?php echo $user['level']; ?></p>
<h4>Posts</h4>
<?php
$posts = $db->prepare("SELECT posts.*, users.username FROM posts JOIN users ON users.id = posts.user_id WHERE user_id = ?");
$posts->execute([$_GET['id']]);
foreach ($posts as $post) {
    include 'post.php';
}
include 'footer.php';
?>
