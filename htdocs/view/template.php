<?php
session_start();
$_SESSION['id'] = 1;
$_SESSION['login'] = "test";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>

<?=$content?>

 <!-- JS, Popper.js, and jQuery -->
 <script src="assets/node_modules/jquery/dist/jquery.slim.js"></script>
 <script src="assets/node_modules/@popperjs/core/dist/umd/popper.js"></script>
 <script src="assets/node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
