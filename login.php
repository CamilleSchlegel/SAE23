<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="left">
    <div id="DivTitre">
    <h1>Site de colis</h1>
</div>
<hr>
            <div>
            <h2>Bienvenue</h2>
        </div>
        <div id="formulaire">
            <form action="verification.php" method="post" name="login">
                <div class="formulaireBlock"><p>Email</p><input type="email" name="username"></div>
                <div class="formulaireBlock"><p>Mot de passe</p><input type="password" name="password" ></div>
                <div class="formulaireBlock"><button type="submit" value="Connexion" name="submit">Se connecter</button></div>
            </form>
</div>
            <?php 
            if (isset($_GET['erreur'])){
                ?>
                <div>
                
                <span>Il y a un problème</span>
            </div>
            
        <?php }  
            ?>
        </div>
    <div id="right">
        <img src="colis.jpg" alt="colis">
    </div>
</body>
</html>