<?php

if (!isset($_GET['grocery_user_id']))
{
	die("Error, user id not specified...");
}

$grocery_user_id = htmlspecialchars($_GET['grocery_user_id']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('SELECT g.username, g.firstName, g.lastName, l.content FROM list l JOIN grocery_user g ON l.grocery_user_id = g.id WHERE g.id=:id');
$stmt->bindValue(':id', $grocery_user_id, PDO::PARAM_INT);
$stmt->execute();
$list_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grocery_user_username = $list_rows[0]['username'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Grocery Lists</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Grocery Lists for <?php echo $grocery_user_username;?></h1>
<div class="lists">
<?php
foreach ($list_rows as $list_row)
{
	$content = $list_row['content'];
	echo "<p>$content</p>";
}
?>
</div>
<form method="post" action="insert_list.php">
	<input type="hidden" name="grocery_user_id" value="<?php echo $grocery_user_id; ?>">
	<textarea name="list_content"></textarea>
	<input class="btnTwo" type="submit" value="Add List">
</form>

<p class="btnTwo"><a href="users.php">Go back to list of users</a></p>


<p class="edit_btn"><a href="editUsers.php">Edit User <?php echo $grocery_user_username;?></a></p>
<p class="del_btn"><a href="deleteUsers.php">Delete User <?php echo $grocery_user_username;?></a></p>

</body>
</html>