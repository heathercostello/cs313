<?php
require('dbConnect.php');
$db = get_db();

$query = 'SELECT id, username, firstName FROM grocery_user';
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Grocery List Users</title>
</head>
<body>
	<h1>Create A New Grocery List User</h1>
    <form method="post" action="insert_user.php">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        User Name: <input type="text" name="username" value="<?php echo $username;?>"><br>
        First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>"><br>
        <input type="submit" value="Create User">
        </form>

</body>
</html>