<?php
// Add 1 like to the post
include 'db.php';
$stmt = $db->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
$stmt->execute([$_GET['id']]);
?>
