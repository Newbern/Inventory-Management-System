<h1>Sign up!</h1>
<form method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $email && $password) {
        foreach (get_user($pdo) as $user) {
            if ($user['username'] === $username) {
                echo "<p>Username already exists. Please choose another.</p>";
                return;
            }
            if ($user['email'] === $email) {
                echo "<p>Email already registered. Please use another.</p>";
                return;
            }
        }
        user_create($pdo, $username, $password, $email);
        echo "<p>User created successfully!</p>";
    } else {
        echo "<p>Please fill in all fields.</p>";
    }
}   