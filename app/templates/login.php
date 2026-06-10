<h1>Login</h1>
<form method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="test" class="form-control" id="username" name="username" placeholder="Username or Email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $users = get_user($pdo);
        foreach ($users as $user) {
            if (($user['username'] === $username || $user['email'] === $username) && $user['password'] === $password) {
                echo "<p>Login successful! Welcome, {$user['username']}.</p>";
                echo "<br><p>{$user['id']}</p>";
                $_SESSION['user_id'] = $user['id'];
                return;
            }
        }
        echo "<p>Invalid username or password.</p>";
    } else {
        echo "<p>Please fill in all fields.</p>";
    }
}