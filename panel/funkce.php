<?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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

    $sql = "DELETE FROM skladby WHERE id=" . $id;

    if ($conn->query($sql) === true) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
        exit(500);
    }
    $conn->close();
    exit();
}

function insert($nazev, $cena)
{
    // TODO
    echo "The insert function is called.";
    exit();
}
?>
