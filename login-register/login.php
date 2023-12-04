<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "db.php";

        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // Check for errors
        if ($stmt === false) {
            die("Error in SQL statement: " . mysqli_error($connection));
        }

        if ($user) {
            if (password_verify($password, $user["password"])) {
                header("Location: index.php");
                exit(); // Stop script execution
            } else {
                echo "<div class='alert alert-danger'>Password does not match</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Email does not match</div>";
        }
    }
?>

<!-- Your HTML form code remains unchanged -->
<form action="login.php" method="post">
    <!-- Your form fields here -->
</form>


    <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control"name="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <input type="password"class="form-control" name="password" placeholder="Enter Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
            </div>
            
        </form>

    </div>
    
</body>
</html>