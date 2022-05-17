<?php
if(isset($_SESSION["stahnout"]) && isset($_GET["id"])){
    if(strpos($_SESSION["stahnout"],"-")){
        foreach(explode("-",$_SESSION["stahnout"]) as $id){
            if($_GET["id"] == $id){
                $p = zobrazitPodleId($id);
                $file = "../soubory/".$p["soubor"].".mp3";
                header('Content-Description: File Transfer');
                header('Content-Type: audio/mpeg');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
            }
        }
    }
}
else{
    exit(400);
}