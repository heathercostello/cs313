<?php
// Start the session
session_start();
?>
<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://postgres:password@localhost:5432/cs313db";
}

$dbopts = parse_url($dbUrl);

print "<p>$dbUrl</p>\n\n";

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

try {
 $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex) {
 print "<p>error: $ex->getMessage() </p>\n\n";
 die();
}

foreach ($db->query('SELECT now()') as $row)
{
 print "<p>$row[0]</p>\n\n";
}

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

        <form action="userList.php" method="post">
            <?php
            foreach ($db->query('SELECT DISTINCT username FROM user_table') as $row) {                
                echo '<input type="radio" name="username" value="'. $row['username'] . '" >' . $row['username'] . '</br>';
            }
            ?>
            <input type="submit">
        </form>
        
        
        <?php
        if (isset($_POST['username'])) {
            echo '<p> In If Statement</p>';
            $string = 'SELECT * FROM user_table WHERE username = ' . '"' . $_POST['username'] . '"';
            echo $string;
            foreach ($db->query($string) as $row ) {
                echo '<a href="details.php?id="' . $_POST['id'] . '"><p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'];
                echo '</strong></a></p>';
                /* echo  ' - ' . '"' . $row['content'] . '"';
                echo '</p>'; */
            }
        }
        else {
            echo '<p> In Else Statement</p>';
            foreach ($db->query('SELECT * FROM scriptures') as $row ) {
                echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'];
                echo '</strong>';
                echo  ' - ' . '"' . $row['content'] . '"';
                echo '</p>';
            }
        }
        ?>
        
</body>
</html>