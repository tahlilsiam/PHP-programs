<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
         //print_r($_POST); //to debug

         if(isset($_POST["submit"])){
            $name= $_POST["fullname"];
            $email= $_POST["email"];
            $password= $_POST["password"]; 
            $re_pass= $_POST["rewritePassword"];

            $err =array(); // to catch any error

            if(empty($name) OR empty($email) OR empty($password) OR empty($re_pass)){
                array_push($err,"All fileds are required");
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($err,"Please Provide a valide email");
            }

            if(strlen($password)<8){
                array_push($err,"Password must be atleast 8 Character ");
            }

            if ($password !== $re_pass){
                array_push($err,"Password does not match");
            }
            require_once "db.php";
            $sql = "SELECT * FROM user WHERE email ='$email'";
            $result= mysqli_query($connection, $sql);
            $rowcount = mysqli_num_rows($result);

            if($rowcount >0){
                array_push($err, "Email Already Exists");
            }
            if(count($err)>0){
                foreach ($err as $error ) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
                
                $sql = "INSERT INTO user (full_name, email, password) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($connection);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt, "sss", $name , $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Successfully Registered</div>";
                }
                else{
                    die("Something went worng");
                }
            }

         }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control"name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password"class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="rewritePassword" placeholder="Rewrite Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register"name="submit">
            </div>
            
        </form>

    </div>
    
</body>
</html>