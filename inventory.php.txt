<?php
include 'includes/db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $sql = "INSERT INTO inventory (item_name, quantity, description) VALUES (:item_name, :quantity, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['item_name' => $item_name, 'quantity' => $quantity, 'description' => $description]);
}

$sql = "SELECT * FROM inventory";
$stmt = $pdo->query($sql);
$inventory = $stmt->fetchAll();

?>

<?php include 'includes/header.php'; ?>

<h2>Inventory</h2>
<form method="POST" action="">
    <label for="item_name">Item Name</label>
    <input type="text" name="item_name" required>
    
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" required>
    
    <label for="description">Description</label>
    <textarea name="description"></textarea>

    <button type="submit">Add Item</button>
</form>

<h3>Current Inventory</h3>
<table>
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inventory as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['item_name']); ?></td>
            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
            <td><?php echo htmlspecialchars($item['description']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>
