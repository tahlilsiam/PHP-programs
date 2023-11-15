<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 1</title>
</head>
<body>

    <h2>Simple Calculator</h2>

    <form method="post" action="">
        <label for="num1">First number:</label><br>
        <input type="text" name="num1" id="num1" required><br/>

        <label for="num2">Enter the second number:</label><br>
        <input type="text" name="num2" id="num2" required><br>

        <button type="submit" name="calculate">Calculate</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];

        $result = $num1 + $num2;

        echo "<p>The sum of $num1 and $num2 is: $result</p>";
    }
    ?>

</body>
</html>
