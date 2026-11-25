<?php
// Connect to the database
session_start();
$db = new PDO('sqlite:social.db');

// Create tables
$db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username TEXT, password TEXT, level INTEGER)");
$db->exec("CREATE TABLE IF NOT EXISTS posts (id INTEGER PRIMARY KEY, user_id INTEGER, text TEXT, image TEXT, likes INTEGER DEFAULT 0)");
$db->exec("CREATE TABLE IF NOT EXISTS comments (id INTEGER PRIMARY KEY, post_id INTEGER, user_id INTEGER, text TEXT)");

// Add example user, post and comment (only first time)
$count = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
if ($count == 0) {
    $hash = password_hash("password123", PASSWORD_DEFAULT);
    $db->exec("INSERT INTO users (username, password, level) VALUES ('igor', '$hash', 2)");
    $db->exec("INSERT INTO users (username, password, level) VALUES ('anna', '$hash', 1)");
    $db->exec("INSERT INTO posts (user_id, text, image) VALUES (1, 'AI is changing how we write code!', 'images/ai.jpg')");
    $db->exec("INSERT INTO comments (post_id, user_id, text) VALUES (1, 2, 'Great post!')");
}
?>
