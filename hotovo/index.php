<?php
$cookie = "kosik";
if (
    isset($_POST["key"]) and
    isset($_COOKIE[$cookie]) and
    $_POST["key"] == true
) {
    // TODO: $id = $_COOKIE[$cookie];
    setcookie($cookie, "", time() - 3600, "/");
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
    </div>
</body>

</html>
HTML;
} else {
    echo "Chyba: neplatný vstup";
    exit(400);
}

?>

