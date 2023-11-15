<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even or Odd Checker</title>
</head>
<body>

    <h2>Even or Odd Checker</h2>

    <?php

    for ($i = 1; $i <= 10; $i++) {

        if ($i % 2 == 0) {
            echo "<p>$i is even.</p>";
        } else {
            echo "<p>$i is odd.</p>";
        }
    }
    ?>

</body>
</html>
