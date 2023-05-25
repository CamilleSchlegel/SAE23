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
        <?php
            $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
            //$sql = "INSERT INTO users (login,password) VALUES(:username,:password)";
            $sql = "select * from users where login= :username and password= :password ";
            $req = $pdo->prepare($sql);
            $req->bindParam(':username', $_POST['username']);
            $req->bindParam(':password', md5($_POST['password']));
            $req->execute();
            $res = $req->fetch(PDO::FETCH_GROUP);
            if ($res == NULL){
                echo "<p>erreur</p>";
            }
            else{
                echo "<p>succès</p>";
            }
            ?>
        <div id="formulaire">
            <form action="" method="post" name="login">
                <div class="formulaireBlock"><input type="email" name="username" placeholder="Adresse e-mail"></div>
                <div class="formulaireBlock"><input type="password" name="password" placeholder="Mot de passe"></div>
                <div class="formulaireBlock"><button type="submit" value="Connexion" name="submit">Connexion</button></div>
            </form>
</div>
        </div>
    <div id="right">
        <img src="colis.jpg" alt="colis">
    </div>
</body>
</html>