<?php
$couleur = "#FFFFFF"; // Couleur par défaut (blanc)

if (isset($_COOKIE["couleur_preferee"])) {
    $couleur = $_COOKIE["couleur_preferee"];
}

if (isset($_POST['couleur'])) {
    $couleur = $_POST["couleur"];
    setcookie("couleur_preferee", $couleur, time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: <?php print($couleur); ?>;
        }
    </style>
</head>
<body>

<h1>Bienvenue sur notre site !</h1><br>
<form method="post">
    <label for="couleur">Choisissez votre couleur préférée :</label>
    <input type="color" id="couleur" name="couleur" value="<?php print($couleur); ?>">
    <button type="submit">Valider</button>
</form>
<?php
// Récupération de la valeur du cookie
if(isset($couleur)) {
    print("<p>Votre couleur préférée est : " . $couleur . "</p>");
}
?>

</body>
</html>