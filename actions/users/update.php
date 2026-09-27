<?php
require_once '../../db.php';

session_start();

if (empty($_SESSION['user'])) {
    exit('mutqn argelvac e');
}

$userId = $_SESSION['user']['id'];

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if (empty($name) || empty($surname) || empty($phone) )
    {
    exit('Lracreq dashty');
}

$name = mysqli_real_escape_string($db, $name);
$surname = mysqli_real_escape_string($db, $surname);
$phone = mysqli_real_escape_string($db, $phone);

$sql = "UPDATE users SET `name` = '$name', `surname` = '$surname', `phone` = '$phone' WHERE id = '$userId' ";
$result = mysqli_query($db, $sql);

$_SESSION['user']['name'] = $name;
$_SESSION['user']['surname'] = $surname;
$_SESSION['user']['phone'] = $phone;

header('Location:../../views/users/profile.php');
    exit;