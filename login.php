<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="left">
    <div id="DivTitre">
        <div id="logo"></div>
    <h1>Site de colis</h1>
</div>
<hr>
            <div>
            <h2>Bienvenue</h2>
        </div>
        
        <div id="formulaire">
            <form action="verification.php" method="post" name="login">
                <div class="formulaireBlock"><input type="email" name="username" placeholder="Adresse e-mail"></div>
                <div class="formulaireBlock"><input type="password" name="password" placeholder="Mot de passe"></div>
                <div class="formulaireBlock"><button type="submit" value="Connexion" name="submit">Connexion</button></div>
            </form>
</div>
<?php
    include_once("footer.html")
    ?>
        </div>
    <div id="right">
    </div>
</body>

</html>