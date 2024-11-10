<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        echo "Login successful!";
    } else {
        echo "Invalid credentials!";
    }
}

?>

<?php include 'includes/header.php'; ?>

<h2>Login</h2>
<form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" name="username" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<?php include 'includes/footer.php'; ?>
