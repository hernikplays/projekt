<?php
$servername = "localhost";
$username = "joeuser";
$password = "BruhMoment";
$dbName = "joe";
$cookie = "kosik";

$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE skladby (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nazev VARCHAR(30),
        cena INT(6)
        )";

if ($conn->query($sql) === true) {
    echo "Nová tabulka";
}

// Vybrat z DB
$select = "SELECT * FROM skladby";
$result = $conn->query($select);
$pisnicky = [];

if(isset($_COOKIE[$cookie])){
    if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                if(strpos($_COOKIE[$cookie], strval($row["id"])) !== false){ // pokud je ID v sušence (v košíku)
                    array_push($pisnicky, [
                        "id" => $row["id"],
                        "nazev" => $row["nazev"],
                        "cena" => $row["cena"],
                    ]); // uložíme do array
                }
            }
        
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

$conn->close();
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
        <?php 
            if ($pocet > 0) {
                // Máme něco v košíku
                for ($i=0; $i < $pocet; $i++) { 
                $id = $i+1;
                    echo "<div class='row'><p class='nazev'>".$pisnicky[$i]["nazev"]."</p><p class='cena'>".$pisnicky[$i]["cena"]." kč</p><button onclick='pryc(".$id.",\"".$_COOKIE[$cookie]."\")'>X</button></div><br>";
                }
                echo "<button onclick='zakoupit'>Zakoupit</button>";
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
        </script>
</body>

</html>