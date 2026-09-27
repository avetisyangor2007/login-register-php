<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: ../../views/users/login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<h2>Profile</h2>

<?php if (!empty($user['avatar'])): ?>
    <img src="/uploads/<?= htmlspecialchars($user['avatar']) ?>" width="150" alt="Avatar"><br><br>
<?php endif; ?>

<form action="../../actions/users/update.php" method="POST" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>"><br><br>

    <label>Surname:</label><br>
    <input type="text" name="surname" value="<?= htmlspecialchars($user['surname']) ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>"><br><br>

    <div>
        <label>Аватар профиля:</label><br>
        <input type="file" name="image"><br><br>
    </div>

    <button type="submit">Update</button>
</form>

<a href="../../actions/users/profile.php">Log out</a>