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
    <title>Create Grocery List Users</title>
</head>
<body>
    <h1>Create a Grocery List User</h1>
        <ul>

        <form method="post" action="newUser.php">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        User Name: <input type="text" name="userName" value="<?php echo $userName;?>"><br>
        First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>"><br>
        Last Name: <input type="text" name="lastname" value="<?php echo $lastname;?>"><br>
        <input type="submit" value="Create User">
        </form>
        </ul>
         
        
</body>
</html>