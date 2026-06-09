<div>
    <h1>Reading</h1>
    <p>Create and Read Products.</p>
    
        # Example of using the get_inventory function
        <form method="POST" class="inventory-form">
            <input name="product_name" type="text"  placeholder="Product Name">
            <input name="price" type="number" placeholder="Price">
            <textarea name="description" placeholder="Product Description"></textarea>
            <input name="quantity" type="number" placeholder="Quantity">
            <button type="submit" name="create_product">Create Product</button>
            <!-- Buttons to trigger create_product and get_inventory functions -->
        </form>
        <hr>
        <form method="POST" class="inventory-form">
            <button type="submit" name="get_inventory">Get Inventory</button>
            <button type="submit" name="get_user">Get User</button>
            <button type="submit" name="get_sales">Show Sales</button>
        </form>
        
    <?php


    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['create_product'])) {
            $product_name = $_POST['product_name'] ?? 'Sample Product';
            $price = $_POST['price'] ?? 0.00;
            $description = $_POST['description'] ?? 'Sample Description';
            $quantity = $_POST['quantity'] ?? 0;

            create_product($pdo, $product_name, $price, $description, $quantity);
            echo "Product Created!";
        }
        elseif (isset($_POST['get_inventory'])) {
            foreach (get_products($pdo) as $product) {
                echo "<form method='POST'><input type='hidden' name='product_id' value='" . $product['id'] . "'><input type='number' name='quantity' placeholder='Quantity to Buy'><button type='submit' name='buy_product'>Buy</button></form>";
                echo "Product Name: " . $product['name'] . "<br>";
                echo "Price: $" . $product['price'] . "<br>";
                echo "Description: " . $product['description'] . "<br>";
                echo "Quantity: " . $product['quantity'] . "<br>";
                echo "<img style='width:120px; aspect-radio: 1/1' src='" . $product['url'] . "' alt='Product Image'><br><hr>";

            }
        }
        elseif (isset($_POST['get_user'])) {
            foreach (get_user($pdo) as $user) {
                echo "Username: " . $user['username'] . "<br>";
                echo "Password: " . $user['password'] . "<br>";
                echo "Email: " . $user['email'] . "<br>";
                echo "<hr>";
            }
        }
        elseif (isset($_POST['get_sales'])) {
            // Implement logic to retrieve and display sales data
            foreach (get_sales($pdo) as $sale) {
                echo "Product ID: " . $sale['product_id'] . "<br>";
                echo "Quantity Sold: " . $sale['quantity'] . "<br>";
                echo "Sale Date: " . $sale['sale_date'] . "<br>";
                echo "<hr>";
            }
        }




        elseif (isset($_POST['buy_product'])) {
            $product_id = $_POST['product_id'] ?? 0;
            $quantity = $_POST['quantity'] ?? 0;
            if ($quantity <= 0) {
                echo "Please enter a valid quantity.";
                return;
            }
            else {
                buy_product($pdo, $product_id, $quantity);
                echo "Product Bought!";
            }
        }
    }
    ?>
</div>