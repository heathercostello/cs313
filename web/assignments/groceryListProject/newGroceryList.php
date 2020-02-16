<?php
require('dbConnect.php');
$db = get_db();

$user_id = htmlspecialchars($_POST['user_id']);
$list_content = htmlspecialchars($_POST['list_content']);

// echo "$user_id\n";
// echo $list_content;

 if ($stmt->execute()) { 
  // it worked
$stmt = $db->prepare('INSERT INTO grocery_list(user_id, list_content) VALUES
(:user_id, :list_content);');

echo "ONE";

$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

echo "TWO";

$stmt->bindValue(':list_content', $list_content, PDO::PARAM_STR);

echo "THREE";

$stmt->execute();
 } else{
   echo "execute statment not working";
 }

echo "FOUR";


$new_page = "userGroceryLists.php?user_id=$user_id";
header("Location: $new_page");
// die();

echo "FIVE";

?>
