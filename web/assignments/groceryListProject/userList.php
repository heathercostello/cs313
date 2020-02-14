<?php
// Start the session
session_start();
?>
<?php


try
{
    $dbUrl = getenv('DATABASE_URL');

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}

// require('dbConnect.php');
// $db = get_db();

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

            echo "<li><p>$username - $firstname $lastname<p></li>";
        }

        ?>
        </ul>



<!-- my old -->
        <form action="userList.php" method="post">
            <?php
            foreach ($db->query('SELECT DISTINCT username FROM user_table') as $row) {                
                echo '<input type="radio" name="username" value="'. $row['username'] . '" >' . $row['username'] . '</br>';
            }
            ?>
            <input type="submit" value="View Grocery Lists">
        </form>
        
    
        
</body>
</html>