<?php

$username = htmlspecialchars($_POST['username']);
$firstName = htmlspecialchars($_POST['firstName']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('INSERT INTO grocery_user(username, firstName) VALUES (:username, :firstName);');
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
$stmt->execute();

$new_page = "users.php?username=$username";

header("Location: $new_page");
die();

?>