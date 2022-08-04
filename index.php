<?php require_once('db/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html * {
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
    </style>
    <title>Students table</title>
</head>
<body>
    
</body>
</html>

<?php

echo "hello";
$students = $db->query("SELECT * FROM `etudiants`");
$students = $students->fetchAll(PDO::FETCH_ASSOC);

var_dump($students);