<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Template</title>
    <link rel="stylesheet" href="<?php echo $CSS; ?>">
</head>
<body>
    <header style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; padding: 10px; background-color: #f0f0f0;">
        <nav>
            <ul style="list-style: none; display: flex; gap: 15px; margin: 0; padding: 0;">
                <li><a href="?page=home">Home</a></li>
                <li><a href="?page=test">Test</a></li>
                <li><a href="?page=signin">Sign In</a></li>
                <li><a href="?page=login">Login</a></li>
                <li><a href="?page=404">404</a></li>
                <li><a href="/app/database/install.php">Install</a></li>
                <li><a href="?page=admin">Admin</a></li>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="logout" style="background: none; border: none; color: blue; cursor: pointer; padding: 0;">Logout</button>
                </form>
            </ul>
        </nav>
    </header>

    <?php include $HTML ?>
    <script src="<?php echo $JS; ?>"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location: index?page=login");
    exit();
}

