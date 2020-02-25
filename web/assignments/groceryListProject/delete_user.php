<?php

$username = htmlspecialchars($_POST['username']);
$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);

require('dbConnect.php');
$db = get_db();

$stmt = $db->prepare('DELETE FROM grocery_user WHERE id=$id');
// $stmt->bindValue(':username', $username, PDO::PARAM_STR);
// $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
// $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
$stmt->execute();

$new_page = "users.php?username=$username";

header("Location: $new_page");
die();

?>