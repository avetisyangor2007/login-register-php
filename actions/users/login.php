<?php
session_start();
require_once '../../db.php';
header('Content-Type: application/json');

$email = trim($_POST['email'] ?? "");
$password = $_POST['password'] ?? "";

if (empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Fill in the field.']);
exit;
}

$email = mysqli_real_escape_string($db, $email);
$checkEmail = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

if (mysqli_num_rows($checkEmail) > 0) {
    $user = mysqli_fetch_assoc($checkEmail);

    if (password_verify($password, $user['password'])) {
    
    unset($user['password']);
    $_SESSION['user']= $user;
    echo json_encode(['status' => 'success', 'redirect' => '../../views/users/profile.php']);
exit;
    
}
}
echo json_encode(['status' => 'error', 'message' => 'Wrong Login or Password']);
exit;
