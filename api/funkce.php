<?php
// údaje pro přístup do DB
$servername = "localhost";
$username = "joeuser";
$password = "BruhMoment";
$dbName = "joe";

function nacistDb(){
    $conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbName"]);

        // Ověřit spojení
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE TABLE skladby (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nazev VARCHAR(30),
        cena INT(6),
        soubor VARCHAR(50)
        )";

        if ($conn->query($sql) === true) {
            echo "Table created successfully";
        }

        $conn->close();
}

function zobrazitDb(){
    $conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbName"]);

    // Ověřit spojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
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
                "soubor" => $row["soubor"],
            ]); // uložíme do array
        }
    }
    $conn->close();

    return $pisnicky;
}

function zobrazitPodleId($id){
    $conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["dbName"]);

    // Ověřit spojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vybrat z DB
    $select = "SELECT * FROM skladby WHERE id=".$id;
    $result = $conn->query($select);
    $row = $result->fetch_assoc();
    $conn->close();

    return [
        "id" => $row["id"],
        "nazev" => $row["nazev"],
        "cena" => $row["cena"],
        "soubor" => $row["soubor"],
    ];
}
?>