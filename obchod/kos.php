<?php
$servername = "localhost";
$username = "joeuser";
$password = "BruhMoment";
$dbName = "joe";
$cookie = "kosik";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE skladby (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nazev VARCHAR(30),
    cena INT(6)
    )";

if ($conn->query($sql) === false) {
    echo "Chyba";
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
$conn->close();
if (isset($_COOKIE[$cookie])) {
    for ($i = 0; $i < count($pisnicky); $i++) {
        if (strpos($_COOKIE[$cookie], strval($i)) !== false) {
            // skladba je v košíku

            // TODO: Zobrazit
        }
    }
}
?>
