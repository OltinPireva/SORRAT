<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'library');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO books (title, author, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $author, $stock);
    
    if ($stmt->execute()) {
        echo "<script>alert('Book added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding book: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author" required>
            <input type="number" name="stock" placeholder="Stock" required>
            <button type="submit">Add Book</button>
        </form>

        <h3>Current Books</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Stock</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['author']); ?></td>
                <td><?php echo htmlspecialchars($row['stock']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>