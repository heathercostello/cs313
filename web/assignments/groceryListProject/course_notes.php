<?php

if (!isset($_GET['grocery_user_id']))
{
	die("Error, course id not specified...");
}

$grocery_user_id = htmlspecialchars($_GET['grocery_user_id']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('SELECT g.code, g.name, n.content FROM note n JOIN grocery_user g ON n.grocery_user_id = g.id WHERE g.id=:id');
$stmt->bindValue(':id', $grocery_user_id, PDO::PARAM_INT);
$stmt->execute();
$note_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grocery_user_code = $note_rows[0]['code'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Notes</title>
</head>
<body>
<h1>Grocery Lists for <?php echo $grocery_user_code;?></h1>

<?php
foreach ($note_rows as $note_row)
{
	$content = $note_row['content'];
	echo "<p>$content</p>";
}
?>

<form method="post" action="insert_note.php">
	<input type="hidden" name="grocery_user_id" value="<?php echo $grocery_user_id; ?>">
	<textarea name="note_content"></textarea>
	<input type="submit" value="Create Note">
</form>

</body>
</html>