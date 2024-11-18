<?php
session_start();
include('db.php');

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $assigned_to = $_POST['assigned_to'];

    $stmt = $pdo->prepare("INSERT INTO tasks (task_name, description, deadline, assigned_to) VALUES (?, ?, ?, ?)");
    $stmt->execute([$task_name, $description, $deadline, $assigned_to]);
}

$employees = $pdo->query("SELECT * FROM users WHERE role = 'employee'")->fetchAll();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <form action="admin.php" method="POST">
        <label for="task_name">Task Name:</label>
        <input type="text" name="task_name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="deadline">Deadline:</label>
        <input type="date" name="deadline" required><br>

        <label for="assigned_to">Assign to:</label>
        <select name="assigned_to" required>
            <?php foreach ($employees as $employee) { ?>
                <option value="<?= $employee['id']; ?>"><?= $employee['username']; ?></option>
            <?php } ?>
        </select><br>

        <button type="submit">Assign Task</button>
    </form>
</body>
</html>
