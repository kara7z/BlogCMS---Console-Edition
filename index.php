<?php
$conn = new mysqli("localhost", "root", "password", "database");

if ($conn->connect_error) {
    die("Connection failed");
}

echo "Connected successfully";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <ol>
                <li>hello</li>
                <li>hello</li>
                <li>hello</li>
                <li>hello</li>
                <li>hello</li>
            </ol>
        </nav>
    </header>
    
</body>
</html>