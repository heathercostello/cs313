<?php
require('dbConnect.php');
$db = get_db();

$query = 'SELECT id, username, firstName, lastName FROM grocery_user';
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Grocery List Users</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Create A New Grocery List User</h1>
    <!-- <form method="post" action="insert_user.php">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        User Name: <input type="text" name="username" value="<?php echo $username;?>"><br>
        First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>"><br>
        Last Name: <input type="text" name="lastName" value="<?php echo $lastName;?>"><br>
        <input type="submit" value="Create User">
        </form> -->

        <form method="post" action="insert_user.php" >
		<div class="input-group">
			<label>User Name:</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label> First Name:</label>
			<input type="text" name="firstName" value="<?php echo $firstName;?>">
        </div>
        <div class="input-group">
			<label> Last Name:</label>
			<input type="text" name="lastName" value="<?php echo $lastName;?>">
		</div>
		<div class="input-group">
			<button class="btn" type="submit" name="save" >Create User</button>
		</div>
	</form>

        <hr>
        <p class="btnTwo"><a href="users.php">Go back to list of users</a></p>

</body>
</html>