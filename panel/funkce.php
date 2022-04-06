<?php

if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "insert":
            if (isset($_POST["nazev"]) && isset($_POST["cena"])) {
                insert($_POST["nazev"], $_POST["cena"]);
            }
            break;
        case "delete":
            if (isset($_POST["id"])) {
                delete($_POST["id"]);
            } else {
                exit(400);
            }
            break;
    }
}

function delete($id)
{
    $servername = "localhost";
    $username = "joeuser";
    $password = "BruhMoment";
    $dbName = "joe";
    $conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $sql = "DELETE FROM skladby WHERE id=" . $id;

    if ($conn->query($sql) === true) {
        echo "Skladba odstraněna";
    } else {
        echo "Error deleting record: " . $conn->error;
        exit(500);
    }
    $conn->close();
    exit();
}

function insert($nazev, $cena)
{
    $servername = "localhost";
    $username = "joeuser";
    $password = "BruhMoment";
    $dbName = "joe";
    $conn = new mysqli($servername, $username, $password, $dbName);
    // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $insert = "INSERT INTO skladby (nazev,cena)
        VALUES ('".$nazev."',".$cena.")";
    if ($conn->query($insert) === TRUE) {
        echo "Skladba přidána";
    }
    else{
        echo "Chyba: ".$conn->error;
        exit(500);
    }
    exit();
}
?>