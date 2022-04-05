<?php
    $servername = "localhost";
    $username = "joeuser";
    $password = "BruhMoment";
    $dbName = "joe";

    $admin = "admin"; 
$adminpass = "password";
 
if(isset($_POST['submit'])){
    if($_POST['username'] == $admin && $_POST['password'] == $adminpass){
        //EXECUTE YOUR CODE HERE
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
    
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } 
        
    /*$insert = "INSERT INTO skladby (nazev,cena)
        VALUES ('Vysoký jalovec',30)";
    if ($conn->query($insert) === TRUE) {
        echo "New record created successfully";
    }*/

    // Vybrat z DB
    $select = "SELECT * FROM skladby";
    $result = $conn->query($select);
    $pisnicky = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($pisnicky,array("id"=>$row["id"],"nazev"=>$row["nazev"],"cena"=>$row["cena"])); // uložíme do array
        }
    }

    $pocet = count($pisnicky);
    if($pocet == 1){
        $slovo = "skladba";
    }
    else if($pocet > 1 && $pocet < 5){
        $slovo = "skladby";
    }
    else{
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
    <title>Admin Panel | RoBítz</title>
    <link rel="stylesheet" href="./panel.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="content">
        <h1>Obchod</h1>
        <h2><?php echo $pocet . " " . $slovo?></h2>
        <div class="seznam">
            <?php
        for ($i=0; $i < $pocet; $i++) { 
            echo "<div class='skladba'><p class='nazev'>".$pisnicky[$i]["nazev"]."</p> <p class='cena'>".$pisnicky[$i]["cena"]." Kč</p> <button onclick='odstranit(".$pisnicky[$i]["id"].")'>Odstranit</button></div>";
        }
        ?>
        <h1>Přidat skladbu</h1>
        <form action="./funkce.php" method="POST">
            <label for="nazev">Název:</label>
            <input type="text" name="nazev">
            <label for="cena">Cena:</label>
            <input type="number" name="cena">
            <input value="insert" hidden name="action"> <!-- TODO -->
            <input type="submit">
        </form>
        </div>
    </div>
    <script>
    function odstranit(id){
        data =  {'action': "delete","id":id};
        $.post("funkce.php", data, function (response) {
            alert("Odstraněno");
            window.location.replace(".")
        });
    }
    </script>
</body>
</html>
<?php
        } else {
        echo "Uživatelské jméno a heslo nesouhlasí";
        }
} else { //IF THE FORM WAS NOT SUBMITTED
//SHOW FORM
    ?><form method="post">
    Username: <input type="text" name="username" /><br />
    Password: <input type="password" name="password" />
    <input type='submit' name='submit' />
</form><?php
}
?>

