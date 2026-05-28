<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>

<?php
session_start();
include("css.php");

if (isset($_POST["register"])) {

    require_once "conn.php";

    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $mname = mysqli_real_escape_string($conn, trim($_POST['mname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($fname) || empty($username) || empty($password) || empty($confirm_password)) 
        {
            $error = "Please fill in all required fields.";
        } 
        elseif ($password != $confirm_password) 
        {
            $error = "Passwords do not match.";
        } 
        else 
        {
        // Check existing username
        $check = "SELECT * FROM $tablelogin WHERE username='$username'";
        $check_result = mysqli_query($conn, $check);
        if (mysqli_num_rows($check_result) > 0) 
        {
            $error = "Username already exists.";
        } 
        else 
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO $tablelogin (username, password, fname, mname, lname)
                    VALUES ('$username', '$hashed_password', '$fname', '$mname', '$lname')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['username'] = $username;
                header("Location: login.php");
                exit;
            } else {
                $error = "Registration failed: " . mysqli_error($conn);
            }
        }
    }

    mysqli_close($conn);
}
?>

<body>
<div class="mx-auto p-2" style="width: 500px;">
<h2>Register Account</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
<form method="POST" name="formReg">
    <label>Username:</label><br>
    <input type="text" class="form-control" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" class="form-control" name="password" required><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" class="form-control" name="confirm_password" required><br><br>

    <label>First Name:</label><br>
    <input type="text" class="form-control" name="fname" required><br><br>

    <label>Middle Name:</label><br>
    <input type="text" class="form-control" name="mname"><br><br>

    <label>Last Name:</label><br>
    <input type="text" class="form-control" name="lname"><br><br>

    <button type="submit" class="btn btn-success w-100" name="register">Register</button>
</form>
</div>
<?php include("js.php"); ?>
</body>
</html>