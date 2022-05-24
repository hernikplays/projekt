<?php
session_start();
include "../api/funkce.php";
$cookie = "kosik";
if (
    isset($_POST["key"]) and
    isset($_COOKIE[$cookie]) and
    $_POST["key"] == true
) {
    $_SESSION["stahnout"] = $_COOKIE[$cookie]; // uložíme co chceme stáhnout do SESSION
    $out = "";
setcookie($cookie, "", time() - 3600, "/");
    $pisnicky = zobrazitDb();

    if(strpos($_SESSION["stahnout"],"-")){ // připravíme odkazy ke stažení pro všechny zakoupené skladby
        $j = 0;
        foreach(explode("-",$_SESSION["stahnout"]) as $i){
            $out = $out."<div id='dl'><p class='nazev'>".$pisnicky[$j]["nazev"]."</p><a target='_blank' href='../dl?id=".$pisnicky[$j]["id"]."'<button>Stáhnout</button></a></div>\n";
            $j++;
        }
    }
    else{
        $out = "<div id='dl'><p class='nazev'>".$pisnicky[0]["nazev"]."</p><br><a target='_blank' href='../dl?id=".$pisnicky[0]["id"]."'<button>Stáhnout</button></a></div>";
    }
    echo <<<HTML
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotovo | RoBítz</title>
    <link rel="stylesheet" href="./kosik.css">
</head>

<body>
    <nav class="navbar">
        <ul class="nav">
            <li><a href="../">Domů</a></li>
            <li><a href="../about">O mně</a></li>
            <li><a href="../obchod">Obchod</a></li>
            <li class="active"><a href=".">Můj Košík</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Nákup úspěšný</h1>
        {$out}
    </div>
</body>

</html>
HTML;
} else {
    echo "Chyba: neplatný vstup";
    exit(400);
}

?>

