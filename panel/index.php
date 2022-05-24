<?php
include "../api/funkce.php";

// heslo a jméno pro přístup do panelu
$admin = "admin";
$adminpass = "password";

if (isset($_POST["submit"])) { // pokud bylo odesláno přihlášení
    if ($_POST["username"] == $admin && $_POST["password"] == $adminpass) { // a údaje sedí

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
    <title>Admin Panel | RoBítz</title>
    <link rel="stylesheet" href="./panel.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="content">
        <h1>Obchod</h1>
        <h2><?php echo $pocet . " " . $slovo; ?></h2>
        <div class="seznam">
            <?php for ($i = 0; $i < $pocet; $i++) {
                echo "<div class='skladba'><p class='nazev'>" .
                    $pisnicky[$i]["nazev"] .
                    "</p> <p class='cena'>" .
                    $pisnicky[$i]["cena"] .
                    " Kč</p> <button onclick='odstranit(" .
                    $pisnicky[$i]["id"] .
                    ")'>Odstranit</button></div>";
            } ?>
        <h1>Přidat skladbu</h1>
        <form action="./funkce.php" method="POST">
            <label for="nazev">Název:</label>
            <input type="text" name="nazev">
            <label for="cena">Cena:</label>
            <input type="number" name="cena">
            <label for="cena">Název souboru:</label>
            <input type="text" name="cesta">
            <input value="insert" style="display:none;" name="action"> <!-- TODO -->
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
} else {
    // pokud nebyl formulář odeslán, zobrazit ho
    ?>
    <head><link rel="stylesheet" href="./panel.css"><title>Admin Panel | RoBítz</title></head>
    <body><form method="post" class="login">
    <p>Username:</p> <input type="text" name="username" /><br />
    <p>Password:</p> <input type="password" name="password" /><br>
    <input type='submit' name='submit' />
</form></body><?php
}
?>
