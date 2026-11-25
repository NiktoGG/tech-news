<!-- One post with likes and comments -->
<div class="card mb-3">
  <div class="card-body">
    <b><a href="profile.php?id=<?php echo $post['user_id']; ?>"><?php echo htmlspecialchars($post['username']); ?></a></b>
    <p><?php echo htmlspecialchars($post['text']); ?></p>
    <?php if ($post['image']) { ?><img src="<?php echo $post['image']; ?>" class="post-img mb-2" alt="post picture"><?php } ?>

    <br>
    <button class="btn btn-outline-primary btn-sm" onclick="like(this, <?php echo $post['id']; ?>)">Like (<span><?php echo $post['likes']; ?></span>)</button>
    <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 2) { ?>
      <a class="btn btn-outline-danger btn-sm" href="index.php?delete_post=<?php echo $post['id']; ?>">Delete</a>
    <?php } ?>
    <hr>

    <?php
    $comments = $db->prepare("SELECT comments.*, users.username FROM comments JOIN users ON users.id = comments.user_id WHERE post_id = ?");
    $comments->execute([$post['id']]);
    foreach ($comments as $c) {
        echo "<p><b>" . htmlspecialchars($c['username']) . ":</b> " . htmlspecialchars($c['text']);
        if (isset($_SESSION['level']) && $_SESSION['level'] == 2) {
            echo " <a class='text-danger' href='index.php?delete_comment=" . $c['id'] . "'>delete</a>";
        }
        echo "</p>";
    }
    ?>

    <?php if (isset($_SESSION['id'])) { ?>
      <form method="post" action="index.php" class="d-flex">
        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
        <input name="comment" class="form-control me-2" placeholder="Write a comment" required>
        <button class="btn btn-primary btn-sm">Send</button>
      </form>
    <?php } ?>
  </div>
</div>
