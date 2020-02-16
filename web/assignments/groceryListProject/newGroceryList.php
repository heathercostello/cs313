<?php
require('dbConnect.php');
$db = get_db();

$user_id = htmlspecialchars($_POST['user_id']);
$list_content = htmlspecialchars($_POST['list_content']);

// echo "$user_id\n";
// echo $list_content;

$stmt = $db->prepare('INSERT INTO grocery_list(user_table_id, list_content) VALUES
(:user_table, :list_content);');
$stmt->bindValue(':user_table', $user_table, PDO::PARAM_INT);
$stmt->bindValue(':list_content', $list_content, PDO::PARAM_STR);

echo "THREE";

$stmt->execute();


echo "FOUR";


$new_page = "userGroceryLists.php?user_id=$user_id";
header("Location: $new_page");
die();

echo "FIVE";

?>
