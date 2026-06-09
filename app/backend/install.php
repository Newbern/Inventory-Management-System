
<!-- Installation Page for Database Credentials -->
<form method="post" action="install.php">
    <input name="host" placeholder="Host">
    <input name="user" placeholder="Username">
    <input name="pass" placeholder="Password" type="password">
    <button type="submit">Install</button>
    <button name="delete" type="submit">Reinstall</button>
</form>



<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    # Getting Database Credentials
    $host = $_POST['host'] ?? '';
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $db_name = "inventory_management_system";

    # Checking to see if delete button is pressed to delete existing config file and database for reinstallation
    if (isset($_POST['delete'])) {
        # Deleting Existing Config File
        if (file_exists(__DIR__ . "/config.php")) {
            unlink(__DIR__ . "/config.php");
            $pdo = new PDO("mysql:host=$host", $user, $pass);
            $pdo->exec("DROP DATABASE IF EXISTS inventory_management_system");
            echo "Existing Config File Deleted! Please Refresh the Page to Reinstall.";
        }
        else {
            echo "No Config File Found to Delete!";
        }
    }

    # Checking if config file already exists to prevent overwriting existing configuration
    if (!file_exists(__DIR__ . "/config.php")) {
    
        # Validating Database Credentials
        try {
            # Connecting to Database if invalid returns False
            $pdo = new PDO("mysql:host=$host", $user, $pass);

            # Setting up Error mode if connection is invalid; will throw an exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Database Connection Successful!<br>";

            $path = __DIR__ . "/../database/setup.sql";

            # Getting SQL File Content
            if (!file_exists($path)) {

                throw new PDOException("SQL File Not Found!");
            }
            else {
                $sql = file_get_contents($path);
            }

            # Executing SQL Queries
            $pdo->exec($sql);
            echo "Database Setup Completed Successfully!";

            # Saving Database Credentials in a Config File
            $config_content = "<?php

return [
    'host' => " . var_export($host, true) .",
    'user' => " . var_export($user, true) .",
    'pass' => " . var_export($pass, true) .",
    'db_name' => " . var_export($db_name, true) .",
];";

            # Creating config file with database credentials
            file_put_contents(__DIR__ . "/config.php", $config_content);
            echo "<br>Configuration File Created Successfully!";

        }

        catch (PDOException $e) {
            # Displaying Error Message if Database Connection Fails
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    else {
        echo "Configuration File Already Exists! Press the Reinstall Button to Delete Existing Configuration and Database for Reinstallation.";
    }
}





