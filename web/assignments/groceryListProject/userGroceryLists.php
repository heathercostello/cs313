<?php
// Start the session
session_start();
?>
<?php
require('dbConnect.php');
$db = get_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Grocery Lists</title>
</head>


<h1>Grocery Lists for User</h1> 
<body>
<form action="userGroceryList.php" method="post">
            <?php
            foreach ($db->query('SELECT DISTINCT grocery_list_name FROM grocery_list') as $row) {                
                echo '<input type="radio" name="grocery_list_name" value="'. $row['grocery_list_name'] . '" >' . $row['grocery_list_name'] . '</br>';
            }
            ?>
            <input type="submit" value="View List">
        </form>

<a herf="newGroceryList.html">Add new grocery list</a>
    
</body>
</html>