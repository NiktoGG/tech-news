<?php
include 'header.php';

// Save a new post (only if logged in)
if (isset($_POST['post']) && isset($_SESSION['id'])) {
    $stmt = $db->prepare("INSERT INTO posts (user_id, text) VALUES (?, ?)");
    $stmt->execute([$_SESSION['id'], $_POST['post']]);
}

// Save a new comment (only if logged in)
if (isset($_POST['comment']) && isset($_SESSION['id'])) {
    $stmt = $db->prepare("INSERT INTO comments (post_id, user_id, text) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['post_id'], $_SESSION['id'], $_POST['comment']]);
}

// Delete post or comment (only level 2 users)
if (isset($_GET['delete_post']) && isset($_SESSION['level']) && $_SESSION['level'] == 2) {
    $stmt = $db->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['delete_post']]);
}
if (isset($_GET['delete_comment']) && isset($_SESSION['level']) && $_SESSION['level'] == 2) {
    $stmt = $db->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$_GET['delete_comment']]);
}
?>

<!-- Bootstrap carousel -->
<div id="slides" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active"><img src="images/ai.jpg" class="d-block w-100 slide" alt="AI"></div>
    <div class="carousel-item"><img src="images/vr.jpg" class="d-block w-100 slide" alt="VR"></div>
    <div class="carousel-item"><img src="images/code.jpg" class="d-block w-100 slide" alt="Code"></div>
  </div>
  <button class="carousel-control-prev" data-bs-target="#slides" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
  <button class="carousel-control-next" data-bs-target="#slides" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
</div>

<!-- Form for new post (only for logged in users) -->
<?php if (isset($_SESSION['id'])) { ?>
  <form method="post" class="mb-4">
    <textarea name="post" class="form-control mb-2" placeholder="Write a post" required></textarea>
    <button class="btn btn-primary">Post</button>
  </form>
<?php } else { ?>
  <p class="alert alert-info">Log in to write posts and comments.</p>
<?php } ?>

<!-- Show all posts -->
<?php
$posts = $db->query("SELECT posts.*, users.username FROM posts JOIN users ON users.id = posts.user_id ORDER BY posts.id DESC");
foreach ($posts as $post) {
    include 'post.php';
}
include 'footer.php';
?>
