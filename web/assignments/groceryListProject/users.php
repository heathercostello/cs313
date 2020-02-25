<?php  include('server.php'); ?>
<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'crud');

	// initialize variables
	$username = "";
	$firstName = "";
	$lastName = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$username = $_POST['username'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];

		mysqli_query($db, "INSERT INTO grocery_user (username, firstName, lastName) VALUES ('$username', '$firstName', '$lastName')"); 
		$_SESSION['message'] = "User Created"; 
		header('location: users.php');
	}?>
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
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
	<h1>Grocery List Users</h1>
	<table>
	<thead>
		<tr>
			<th>Username</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>

<?php

foreach ($users as $grocery_user)
{
	$id = $grocery_user['id'];
	$username = $grocery_user['username'];
	$firstName = $grocery_user['firstName'];
	$lastName = $grocery_user['lastName'];

	//echo "<li><p><a href='grocery_lists.php?grocery_user_id=$id'>$username</a></p></li>";
	echo "<tr><p><a href='grocery_lists.php?grocery_user_id=$id'>$username</a></p></tr>";
}
?>		


	<?php $results = mysqli_query($db, "SELECT * FROM grocery_user"); ?>

<table>
	<thead>
		<tr>
			<th>Username</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['firstName']; ?></td>
			<td><?php echo $row['lastName']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>


<hr>
<p><a href="createNewUser.php">Create A New User</a></p>

</body>
</html>