<?php
include 'header.php';

// Find users whose name contains the search text
$stmt = $db->prepare("SELECT * FROM users WHERE username LIKE ?");
$stmt->execute(['%' . $_GET['q'] . '%']);
?>
<h2>Search results</h2>
<?php
foreach ($stmt as $user) {
    echo "<p><a href='profile.php?id=" . $user['id'] . "'>" . htmlspecialchars($user['username']) . "</a></p>";
}
include 'footer.php';
?>
