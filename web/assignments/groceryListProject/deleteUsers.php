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
    <h1>Delete User</h1>
    
    <form method="post" action="delete_user.php">
    <label>Deleting the User will be perminant</label><br>
        <input class="btnDelete" type="submit" value="Delete User">
        </form>

        <p class="btnTwo"><a href="users.php">Go back to list of users</a></p>

</body>
</html>