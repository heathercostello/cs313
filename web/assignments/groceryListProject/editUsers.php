<?php
// Start the session
session_start();
?>
<?php
require('dbConnect.php');
$db = get_db();

$query = 'SELECT id, username, first_name, last_name FROM user_table';
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//SELECT id, username, first_name, last_name FROM user_table;
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