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
        nazev VARCHAR(30),
        cena INT(6)
        )";

if ($conn->query($sql) === true) {
    echo "Table created successfully";
}

// Vybrat z DB
$select = "SELECT * FROM skladby";
$result = $conn->query($select);
$pisnicky = [];

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        array_push($pisnicky, [
            "id" => $row["id"],
            "nazev" => $row["nazev"],
            "cena" => $row["cena"],
        ]); // uložíme do array
    }
}

$pocet = count($pisnicky);
if ($pocet == 1) {
    $slovo = "skladba";
} elseif ($pocet > 1 && $pocet < 5) {
    $slovo = "skladby";
} else {
    $slovo = "skladeb";
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
            <li class="active"><a href="/">Domů</a></li>
            <li><a href="/about">O mně</a></li>
            <li><a href="/obchod">Obchod</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Obchod</h1>
        <h2><?php echo $pocet . " " . $slovo; ?></h2>
        <div class="seznam">
        <?php for ($i = 0; $i < $pocet; $i++) {
            echo "<div class='skladba'><img src='https://via.placeholder.com/300'><br><p class='nazev'>" .
                $pisnicky[$i]["nazev"] .
                "</p> <p class='cena'>" .
                $pisnicky[$i]["cena"] .
                " Kč</p></div>";
        } ?>
        </div>
    </div>
</body>

</html>