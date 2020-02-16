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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grocery List Users</title>
</head>
<body>
    <h1>Grocery List Users</h1>
        <ul>
        <?php

        foreach ($users as $user)
        {
            $id = $user['id'];
            $username = $user['username'];
            $firstname = $user['first_name'];
            $lastname = $user['last_name'];

            echo "<li><p><a href='userGroceryLists.php?user_id=$id'>$username - $firstname $lastname<p></li>";
        }

        ?>
        </ul>
<?php
echo "<h2><a href='newUser.php'>Create new user</a></h2>";
?>
         
        
</body>
</html>