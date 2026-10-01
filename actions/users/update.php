<?php
session_start();
require_once '../../db.php';
header('Content-Type: application/json');


if (empty($_SESSION['user'])) {
     echo json_encode(['status' => 'error', 'message' => 'Entry prohibited']);
    exit;
}

$userId = (int)$_SESSION['user']['id'];

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if (empty($name) || empty($surname) || empty($phone)) {
    echo json_encode(['status' => 'error', 'message' => 'Fill in the field.']);
    exit;
}


$avatarName =$_SESSION['user']['avatar'] ?? null;

if (!empty($_FILES['image']['name'])) {
    $file =$_FILES['image'];

    if ($file['size'] > 2 * 1024 * 1024) {
       echo json_encode(['status' => 'error', 'message' => 'File too big (max. 2 MB)']);
exit;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));$allowedExt = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext,$allowedExt)) {
        echo json_encode(['status' => 'error', 'message' => 'You can only upload images. (jpg, jpeg, png)']);
exit;
    }

    $avatarName = uniqid() . '.' .$ext;
    move_uploaded_file($file['tmp_name'], '../../uploads/' .$avatarName);
}


$dbName = mysqli_real_escape_string($db,$name);
$dbSurname = mysqli_real_escape_string($db, $surname);$dbPhone = mysqli_real_escape_string($db,$phone);
$dbAvatar =$avatarName ? "'" . mysqli_real_escape_string($db,$avatarName) . "'" : "NULL";

$sql = "UPDATE users SET `name` = '$dbName', `surname` = '$dbSurname', `phone` = '$dbPhone', `avatar` = $dbAvatar WHERE id =$userId";
mysqli_query($db,$sql);


$_SESSION['user']['name'] =$name;
$_SESSION['user']['surname'] =$surname;
$_SESSION['user']['phone'] =$phone;
$_SESSION['user']['avatar'] =$avatarName;

echo json_encode(['status' => 'success', 'redirect' => '../../views/users/profile.php']);
exit;