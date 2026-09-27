<?php
require_once '../../db.php';

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($name) || empty($surname) || empty($phone) || empty($email) || empty($password) )
    {
    exit('Lracreq dashty');
}

$name = mysqli_real_escape_string($db, $name);
$surname = mysqli_real_escape_string($db, $surname);
$phone = mysqli_real_escape_string($db, $phone);
$email = mysqli_real_escape_string($db, $email);

$checkEmail = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
if (mysqli_num_rows($checkEmail) > 0 ) {
    exit('Ayspisi email arden goyutyun uni');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$data = mysqli_query($db, "INSERT INTO users (`name`,`surname`,`phone`,`email`,`password`) VALUES('$name', '$surname', '$phone', '$email', '$hashedPassword')");

header('Location:../../views/users/login.php');
exit;