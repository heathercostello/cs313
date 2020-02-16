<?php
// Start the session
session_start();
?>

<?php
if (!isset($_GET['user_id']))
{
    die("Error, user id not specified...");
}
$user_id = htmlspecialchars($_GET['user_id']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('SELECT u.username, g.grocery_list_name, g.list_content FROM grocery_list g 
JOIN user_table u ON g.user_table_id = u.id
WHERE u.id =:id');
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$grocery_list_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$username = $grocery_list_rows[0]['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Grocery Lists</title>
</head>

<body>
<h1>Grocery List for <?php echo $username ?></h1> 

<?php
foreach ($grocery_list_rows as $grocery_list_row)
{
    $name = $grocery_list_row['grocery_list_name'];
    $content = $grocery_list_row['list_content'];
    echo "<p>Grocery List:$name<br> Items:$content</p>";
}
?>

<form method="post" action="newGroceryList.php">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <textarea name="grocery_list_content"></textarea>
    <input type="submit" value="Create List">
</form>

    
</body>
</html>