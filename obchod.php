<?php
    $servername = "localhost";
    $username = "joeuser";
    $password = "BruhMoment";
    $dbName = "joe";

    $conn = new mysqli($servername, $username, $password, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "CREATE TABLE skladby (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nazev VARCHAR(30)
        )";
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
        
    $insert = "INSERT INTO skladby (nazev)
        VALUES ('Vysoký jalovec')";
    if ($conn->query($insert) === TRUE) {
        echo "New record created successfully";
    } else {
    echo "Error: " . $insert . "<br>" . $conn->error;
    }

    $select = "SELECT * FROM skladby";
    $result = $conn->query($select);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obchod | RoBítz</title>
    <link rel="stylesheet" href="./obchod.css">
</head>

<body>
    <nav class="navbar">
        <ul class="nav">
            <li class="active"><a href="#0">Domů</a></li>
            <li><a href="#0">O mně</a></li>
            <li><a href="#0">Obchod</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Obchod</h1>
        <h2>X skladeb</h2>
    </div>
</body>

</html>