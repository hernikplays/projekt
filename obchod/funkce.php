<?php
$servername = "localhost";
$username = "joeuser";
$password = "BruhMoment";
$dbName = "joe";
$cookie = "kosik";

if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "nastav":
            if (isset($_POST["hodnota"])) {
                setcookie($cookie, $_POST["hodnota"], time() + 86400 * 30, "/"); // 86400 = 1 den
                echo "Nastaveno";
            } else {
                exit(400);
            }
            exit();
            break;
        case "clear":
            setcookie($cookie, "", time() - 3600, "/");
            break;
        default:
            exit(400);
            break;
    }
}

?>
