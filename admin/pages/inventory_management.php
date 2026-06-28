<h1>Inventory Management</h1>
<p>Here you can manage your inventory. You can view current stock levels, add new products, and update existing product information.</p>


<form method="POST" action="?page=inventory_management">
    <h2>Add New Product</h2>
    <label for="name">Product Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="price">Price:</label><br>
    <input type="number" id="price" name="price" step="0.01" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" required><br><br>

    <button type="submit" name="add_product">Add Product</button>

</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    create_product($pdo, $name, $price, $description, $quantity);
    echo "<p>Product added successfully!</p>";
}