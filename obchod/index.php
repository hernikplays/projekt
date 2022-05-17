<?php
include "../api/funkce.php";
$cookie = "kosik";

nacistDb();

$pisnicky = zobrazitDb();
$pocet = count($pisnicky);
if ($pocet == 1) {
    $slovo = "skladba";
} elseif ($pocet > 1 && $pocet < 5) {
    $slovo = "skladby";
} else {
    $slovo = "skladeb";
}
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
            <li><a href="../">Domů</a></li>
            <li><a href="../about">O mně</a></li>
            <li class="active"><a href="../obchod">Obchod</a></li>
            <li><a href="../kosik">Můj Košík</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Obchod</h1>
        <h2><?php echo $pocet . " " . $slovo; ?></h2>
        <div class="seznam">
        <?php for ($i = 0; $i < $pocet; $i++) {
            $id = $i + 1;
            if (isset($_COOKIE[$cookie])) {
                // Pokud máme sušenku
                if (strpos($_COOKIE[$cookie], "-") !== false) {
                    // sušenka obsahuje víc hodnot
                    $rozdel = explode("-", $_COOKIE[$cookie]);
                    if (in_array($id, $rozdel)) {
                        // pokud je hodnota v poli, objekt již je v košíku
                        echo "<div class='skladba'><img src='https://via.placeholder.com/300'><br><p class='nazev'>" .
                            $pisnicky[$i]["nazev"] .
                            "</p> <p class='cena'>" .
                            $pisnicky[$i]["cena"] .
                            " Kč</p><br><button onclick='pryc(" .
                            $id .
                            ",\"" .
                            $_COOKIE[$cookie] .
                            "\")'>Z košíku</button></div>";
                    } else {
                        echo "<div class='skladba'><img src='https://via.placeholder.com/300'><br><p class='nazev'>" .
                            $pisnicky[$i]["nazev"] .
                            "</p> <p class='cena'>" .
                            $pisnicky[$i]["cena"] .
                            " Kč</p><br><button onclick='kosik(" .
                            $id .
                            ",\"" .
                            $_COOKIE[$cookie] .
                            "\")'>Do košíku</button></div>";
                    }
                } else {
                    // sušenka má jen jednu hodnotu
                    if (strpos($_COOKIE[$cookie], strval($id)) !== false) {
                        // pokud je hodnota v poli, objekt již je v košíku
                        echo "<div class='skladba'><img src='https://via.placeholder.com/300'><br><p class='nazev'>" .
                            $pisnicky[$i]["nazev"] .
                            "</p> <p class='cena'>" .
                            $pisnicky[$i]["cena"] .
                            " Kč</p><br><button onclick='pryc(" .
                            $id .
                            ",\"" .
                            $_COOKIE[$cookie] .
                            "\")'>Z košíku</button></div>";
                    } else {
                        echo "<div class='skladba'><img src='https://via.placeholder.com/300'><br><p class='nazev'>" .
                            $pisnicky[$i]["nazev"] .
                            "</p> <p class='cena'>" .
                            $pisnicky[$i]["cena"] .
                            " Kč</p><br><button onclick='kosik(" .
                            $id .
                            ",\"" .
                            $_COOKIE[$cookie] .
                            "\")'>Do košíku</button></div>";
                    }
                }
            } else {
                echo "<div class='skladba'><img src='https://via.placeholder.com/300'><br><p class='nazev'>" .
                    $pisnicky[$i]["nazev"] .
                    "</p> <p class='cena'>" .
                    $pisnicky[$i]["cena"] .
                    " Kč</p><br><button onclick='kosik(" .
                    $id .
                    ",\"\")'>Do košíku</button></div>";
            }
        } ?>
        </div>
    </div>
    <script>
        function kosik(id,hodnota){
            let http = new XMLHttpRequest();
            http.open("POST","funkce.php",true)
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = ()=>{
            if(http.readyState == 4 && http.status == 200) {
                window.location.replace(".")
            }
            }
            if(hodnota===""){
                http.send("action=nastav&hodnota="+id);
            }
            else{
                http.send("action=nastav&hodnota="+hodnota+"-"+id);
            }
        }

        function pryc(id,hodnota){
            let http = new XMLHttpRequest();
            http.open("POST","funkce.php",true)
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = ()=>{
                if(http.readyState == 4 && http.status == 200) {
                    window.location.replace(".")
                }
            }
            if(hodnota.length === 1){
                http.send("action=clear");
            }
            else{
                http.send("action=nastav&hodnota="+hodnota.replace("-"+id,"").replace(id+"-",""));
            }
        }
        </script>
</body>

</html>