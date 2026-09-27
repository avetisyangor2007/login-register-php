<?php
require_once '../../db.php';

$email = trim($_POST['email'] ?? "");
$password = $_POST['password'] ?? "";

if (empty($email) || empty($password)) {
    exit('Lracreq dashty');
}

$email = mysqli_real_escape_string($db, $email);
$checkEmail = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

if (mysqli_num_rows($checkEmail) > 0) {
    $user = mysqli_fetch_assoc($checkEmail);

    if (password_verify($password, $user['password'])) {
    session_start();
    unset($user['password']);
    $_SESSION['user']= $user;
    header('Location:../../views/users/profile.php');
    exit;
}
}
exit('sxal login kam password');
