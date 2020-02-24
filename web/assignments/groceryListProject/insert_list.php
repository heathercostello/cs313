<?php

$grocery_user_id = htmlspecialchars($_POST['grocery_user_id']);
$content = htmlspecialchars($_POST['list_content']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO list(grocery_user_id, content) VALUES (:grocery_user_id, :content);');
$stmt->bindValue(':grocery_user_id', $grocery_user_id, PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

$new_page = "grocery_lists.php?grocery_user_id=$grocery_user_id";

header("Location: $new_page");
die();

?>