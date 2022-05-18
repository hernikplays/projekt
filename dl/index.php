<?php
session_start();
include "../api/funkce.php";
if (isset($_SESSION["stahnout"]) && isset($_GET["id"])) {
    echo $_SESSION["stahnout"];
    if (strpos($_SESSION["stahnout"], "-")) {
        foreach (explode("-", $_SESSION["stahnout"]) as $id) {
            if ($_GET["id"] == $id) {
                echo "B";
                $p = zobrazitPodleId($id);
                $file = "../soubory/" . $p["soubor"] . ".mp3";
                header("Content-Description: File Transfer");
                header("Content-Type: audio/mpeg");
                header(
                    'Content-Disposition: attachment; filename="' .
                        basename($file) .
                        '"'
                );
                header("Expires: 0");
                header("Cache-Control: must-revalidate");
                header("Pragma: public");
                header("Content-Length: " . filesize($file));
                readfile($file);
            }
        }
    }
} else {
    echo "Nemáte oprávnění";
    exit(400);
}
?>
