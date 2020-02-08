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
echo $userName;
echo "<br>";
echo $firstName;
echo "<br>";
echo $lastName;
echo "<br>";
echo $list;
echo "<br>";
?>
</body>
</html>