
<?php
require('dbConnect.php');
$db = get_db();

// From the reading:
// $stmt = $db->prepare('SELECT * FROM table WHERE id=:id AND name=:name');
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->execute();
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = 'SELECT id, username, firstName, lastName FROM grocery_user';
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Grocery List Users</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<h1>Grocery List Users</h1>


<?php
foreach ($users as $grocery_user)
{
	$id = $grocery_user['id'];
	$username = $grocery_user['username'];
	$firstName = $grocery_user['firstName'];
	$lastName = $grocery_user['lastName'];

	echo "<p><a href='grocery_lists.php?grocery_user_id=$id'>$username</a></p>";
}
?>		


<hr>
<p class="btnTwo"><a href="createNewUser.php">Create A New User</a></p>

</body>
</html>