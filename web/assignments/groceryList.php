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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Grocery List</title>
</head>

<body>
<div>

<h1>Grocery List</h1>

<?php

$statement = $db->prepare("SELECT username, first_name, last_name FROM user_table");
$statement->execute();

// Go through each result
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$username = $row['username'];
	$first_name = $row['first_name'];
	$velast_namerse = $row['last_name'];

	echo "<p><strong>First Name: $first_name Last Name:$last_name User Name:$username</strong>";
}

?>


</div>

</body>
</html>