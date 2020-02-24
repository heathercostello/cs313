<?php
require('dbConnect.php');
$db = get_db();

// From the reading:
// $stmt = $db->prepare('SELECT * FROM table WHERE id=:id AND name=:name');
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->execute();
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = 'SELECT id, username, name FROM grocery_user';
$stmt = $db->prepare($query);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

foreach ($courses as $grocery_user)
{
	$id = $grocery_user['id'];
	$username = $grocery_user['username'];
	$name = $grocery_user['name'];

	echo "<li><p><a href='grocery_lists.php?grocery_user_id=$id'>$username - $name</a></p></li>";
}
?>		
	</ul>

</body>
</html>