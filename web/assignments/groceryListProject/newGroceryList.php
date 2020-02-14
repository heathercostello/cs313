<?php
$user_id = htmlspecialchars($_POST['user_id']);
$content = htmlspecialchars($_POST['grocery_list_content']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO grocery_list(user_table_id, grocery_list_name, content) VALUES
(:user_id, :content);');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

$new_page = "userGroceryLists.php?id=$user_id";
header("Location: $new_page");
die();

?>
