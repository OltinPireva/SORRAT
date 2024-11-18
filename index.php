<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$tasks = $pdo->prepare("SELECT * FROM tasks WHERE assigned_to = ?");
$tasks->execute([$user_id]);
$tasks = $tasks->fetchAll();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tasks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Your Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Deadline</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task) { ?>
                <tr>
                    <td><?= $task['task_name']; ?></td>
                    <td><?= $task['description']; ?></td>
                    <td><?= $task['deadline']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
