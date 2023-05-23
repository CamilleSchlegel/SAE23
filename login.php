<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="left">
            <div>
            <h1>Authentification</h1>
        </div>
        <div id="formulaire">
            <form action="verification.php" method="post" name="login">
                <div class="formulaireBlock"><input type="email" name="username" placeholder="Adresse e-mail"></div>
                <div class="formulaireBlock"><input type="password" name="password" placeholder="Mot de passe"></div>
                <div class="formulaireBlock"><button type="submit" value="Connexion" name="submit">Connexion</button></div>
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