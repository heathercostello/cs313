<?php
// Start the session
session_start();
?>
<?php
require('dbConnect.php');
$db = get_db();

// $query = 'SELECT id, username, first_name, last_name FROM user_table';
// $stmt = $db->prepare($query);
// $stmt->execute();
// $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//SELECT id, username, first_name, last_name FROM user_table;
?>

<?php
$user_id = htmlspecialchars($_POST['user_id']);
$content = htmlspecialchars($_POST['grocery_list_content']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO grocery_list(user_table_id, grocery_list_name, content) VALUES
(:user_id, :content);');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();

$new_page = "userGroceryLists.php?id=$user_id";
header("Location: $new_page");
die();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Grocery List</title>
</head>
<body>
    <h1>Enter In A New Grocery List</h1>

    <?php
// define variables and set to empty values
$userNameErr = $firstNameErr = $lastNameErr = "";
$userName = $firstName = $lastName = $list = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["userName"])) {
    $userNameErr = "User name is required";
  } else {
    $name = test_input($_POST["userName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$userName)) {
      $userNameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["firstName"])) {
    $firstNameErr = "First name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters and white space allowed";
    }
  }
    
  if (empty($_POST["lastName"])) {
    $lastName = "";
  } else {
    $lastName = test_input($_POST["lastName"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
      $lastNameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["list"])) {
    $list = "";
  } else {
    $list = test_input($_POST["list"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  User Name: <input type="text" name="userName" value="<?php echo $userName;?>">
  <span class="error">* <?php echo $userNameErr;?></span>
  <br><br>
  First Name: <input type="text" name="firstName" value="<?php echo $firstName;?>">
  <span class="error">* <?php echo $firstNameErr;?></span>
  <br><br>
  Last Name: <input type="text" name="lastName" value="<?php echo $lastName;?>">
  <span class="error"><?php echo $lastNameErr;?></span>
  <br><br>
  Grocery List: <textarea name="list" rows="5" cols="40"><?php echo $list;?></textarea>
  <br><br>
  <input type="submit" name="submit" value="Confirm List Below">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $list;
echo "<br>";
?>

<a href="userGroceryList.php"><p>Go back and view the grocery lists</p></a>
</body>
</html>