<?php
require('dbConnect.php');
$db = get_db();

// From the reading:
// $stmt = $db->prepare('SELECT * FROM table WHERE id=:id AND name=:name');
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->execute();
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = 'SELECT id, username, firstName FROM grocery_user';
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Grocery List Users</title>
</head>
<body>
	<h1>Grocery List Users</h1>

	<ul>
<?php

foreach ($users as $grocery_user)
{
	$id = $grocery_user['id'];
	$username = $grocery_user['username'];
	$firstName = $grocery_user['firstName'];

	echo "<li><p><a href='grocery_lists.php?grocery_user_id=$id'>$username - $firstName</a></p></li>";
}
?>		
	</ul>

	<!-- <form method="post" action="insert_list.php">
	<input type="hidden" name="grocery_user_id" value="<?php echo $grocery_user_id; ?>">
	<textarea name="list_content"></textarea>
	<input type="submit" value="Add User">
	</form> -->

		<form method="post" action="insert_user.php">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        User Name: <input type="text" name="username" value="<?php echo $username;?>"><br>
        First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>"><br>
        <input type="submit" value="Create User">
        </form>

</body>
</html>