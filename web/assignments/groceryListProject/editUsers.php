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
    <h1>Edit Information for User</h1>
    
    <form method="post" action="edit_user.php">
        <input type="hidden" name="username" value="<?php echo $_GET["username"]; ?>">
        <div class="input-group">
        User Name: <input type="text" name="username" value="<?php echo $username;?>"><br>
        </div>
        <div class="input-group">
        First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>"><br>
        </div>
        <div class="input-group">
        Last Name: <input type="text" name="lastName" value="<?php echo $lastName;?>"><br>
        </div>
        <input class="btn" type="submit" value="Edit User">
        </form>

        <hr>
        <p><a href="users.php">Go back to list of users</a></p>

</body>
</html>