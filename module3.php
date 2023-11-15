<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>



    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Contact Form</h2>

    <?php
    $name = $email = $message = "";
    $nameErr = $emailErr = $messageErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }


        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
          
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
        } else {
            $message = test_input($_POST["message"]);
        }
    }

    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span style="color: red;"><?php echo $nameErr; ?></span>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span style="color: red;"><?php echo $emailErr; ?></span>

        <label for="message">Message:</label>
        <textarea id="message" name="message"><?php echo $message; ?></textarea>
        <span style="color: red;"><?php echo $messageErr; ?></span>

        <button type="submit">Submit</button>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        echo "<h2>Submitted Data:</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Message:</strong> $message</p>";
    }
    ?>

</body>
</html>
