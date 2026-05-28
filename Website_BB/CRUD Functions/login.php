<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<?php
session_start();
include("css.php");

if (isset($_POST["login"])) {

    require_once "conn.php";

    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = trim($_POST['password']);

    // Validation
    if (empty($username) || empty($password)) {
        $error = "Please fill in all required fields.";
    } else {
        // Check username exists
        $sql = "SELECT * FROM $tablelogin WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) == 0) {
            $error = "Invalid username or password.";
        } else {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }
    }

    mysqli_close($conn);
}
?>

<body>
<div class="mx-auto p-2" style="width: 500px;">
<h2>Login</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
<form method="POST" name="formLogin">
    <label>Username:</label><br>
    <input type="text" class="form-control" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" class="form-control" name="password" required><br><br>

    <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
</form>
<p style="text-align:center; margin-top:15px;">Don't have an account? <a href="register.php">Register here</a></p>
</div>
<?php include("js.php"); ?>
</body>
</html>