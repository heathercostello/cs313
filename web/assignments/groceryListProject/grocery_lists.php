<?php

if (!isset($_GET['grocery_user_id']))
{
	die("Error, course id not specified...");
}

$grocery_user_id = htmlspecialchars($_GET['grocery_user_id']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('SELECT g.username, g.firstName, n.content FROM list n JOIN grocery_user g ON n.grocery_user_id = g.id WHERE g.id=:id');
$stmt->bindValue(':id', $grocery_user_id, PDO::PARAM_INT);
$stmt->execute();
$list_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grocery_user_username = $list_rows[0]['username'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Grocery Lists</title>
</head>
<body>
<h1>Grocery Lists for <?php echo $grocery_user_username;?></h1>

<?php
foreach ($list_rows as $list_row)
{
	$content = $list_row['content'];
	echo "<p>$content</p>";
}
?>

<form method="post" action="insert_list.php">
	<input type="hidden" name="grocery_user_id" value="<?php echo $grocery_user_id; ?>">
	<textarea name="list_content"></textarea>
	<input type="submit" value="Add List">
</form>

<p><a href="users.php">Go back to list of users</a></p>

</body>
</html>