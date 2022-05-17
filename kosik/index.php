<?php
include "../api/funkce.php";
$servername = "localhost";
$username = "joeuser";
$password = "BruhMoment";
$dbName = "joe";
$cookie = "kosik";

nacistDb();

$pisnicky = [];

if (isset($_COOKIE[$cookie])) {
    if (strpos($_COOKIE[$cookie], "-")) {
        foreach (explode("-", $_COOKIE[$cookie]) as $i) {
            array_push($pisnicky, zobrazitPodleId($i));
        }
    } else {
        array_push($pisnicky, zobrazitPodleId($_COOKIE[$cookie]));
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Můj Košík | RoBítz</title>
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
        <h1>Váš košík:</h1>
        <h2><?php echo $pocet . " " . $slovo; ?></h2>
        <div class="seznam">
        <?php if ($pocet > 0) {
            // Máme něco v košíku
            for ($i = 0; $i < $pocet; $i++) {
                $id = $i + 1;
                echo "<div class='row'><p class='nazev'>" .
                    $pisnicky[$i]["nazev"] .
                    "</p><p class='cena'>" .
                    $pisnicky[$i]["cena"] .
                    " kč</p><button onclick='pryc(" .
                    $id .
                    ",\"" .
                    $_COOKIE[$cookie] .
                    "\")' class='x'>X</button></div><br>";
            }
            echo "<button onclick='zakoupit()'>Zakoupit</button>";
        } else {
            echo "<h2>Žádné produkty v košíku</h2>";
        } ?>
        </div>
    </div>
    <script>
        function pryc(id,hodnota){
            let http = new XMLHttpRequest();
            http.open("POST","../obchod/funkce.php",true)
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

        function zakoupit(){
            let http = new XMLHttpRequest();
            http.open("POST","../hotovo/index.php",true)
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = ()=>{
                if(http.readyState == 4 && http.status == 200) {
                    var newDoc = document.open('text/html', 'replace');
                    newDoc.write(http.responseText);
                    newDoc.close();
                }
            }
            http.send("key=yes")
        }
        </script>
</body>

</html>