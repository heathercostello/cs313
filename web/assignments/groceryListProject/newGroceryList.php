<?php
$user_table_id = htmlspecialchars($_POST['user_table_id']);
$content = htmlspecialchars($_POST['grocery_list_content']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO grocery_list(user_table_id, content) VALUES
(:user_table_id, :content);');
$stmt->bindValue(':user_table_id', $user_table_id, PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

$new_page = "userGroceryLists.php?user_table_id=$user_table_id";
header("Location: $new_page");
die();

?>
