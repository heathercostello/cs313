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
    <title>Create Grocery List Users</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Edit Information for<?php echo $grocery_user_username;?></h1>
    
    <form method="post" action="edit_user.php">
        <input type="hidden" name="username" value="<?php echo $_GET["username"]; ?>">
        User Name: <input type="text" name="username" value="<?php echo $username;?>"><br>
        First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>"><br>
        Last Name: <input type="text" name="lastName" value="<?php echo $lastName;?>"><br>
        <input type="submit" value="Edit User">
        </form>

        <hr>
        <p><a href="users.php">Go back to list of users</a></p>

</body>
</html>