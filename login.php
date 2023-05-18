<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div>
        <h1>Authentification</h1>
    </div>
    <div>
        <form action="" method="post" name="login">
            <input type="email" name="username" placeholder="Adresse e-mail"> <br>
            <input type="password" name="password" placeholder="Mot de passe"> <br>
            <button type="submit" value="Connexion" name="submit">Connexion</button>
        </form>
    </div>
    <div>
        <?php 
        if (isset($_POST["username"])){
            echo $_POST["username"];
        }
        if (isset($_POST["password"])){
            echo $_POST["password"];
        }
        ?>
    </div>
</body>
</html>