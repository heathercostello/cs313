<?php

require "dbConnect.php";
$db = get_db();

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