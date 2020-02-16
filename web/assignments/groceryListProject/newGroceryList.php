<?php
$user_id = htmlspecialchars($_POST['user_id']);
$list_content = htmlspecialchars($_POST['list_content']);

// echo "$user_id\n";
// echo $list_content;

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO grocery_list(user_table_id, list_content) VALUES
(:user_table_id, :list_content);');
$stmt->bindValue(':user_table_id', $user_table_id, PDO::PARAM_INT);
$stmt->bindValue(':list_content', $list_content, PDO::PARAM_STR);
$stmt->execute();

$new_page = "userGroceryLists.php?user_id=$user_id";
header("Location: $new_page");
die();

?>
