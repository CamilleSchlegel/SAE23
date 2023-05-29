<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <h1>Ajout</h1>
    <div>
    <form action='' method='get'> Date de livraison: <input type='text' name='date'/> <br>
    Prénom: <input type='text' name='surname'/><br>
    Nom: <input type='text' name='name'/><br><br>
    <input type='submit' value='Ajouter'/> </form>

    <?php
    
    if (isset($_GET["date"]) && isset($_GET["surname"]) && isset($_GET["name"])){
        $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
        $sql = "INSERT INTO commandes (IDclient,date_livraison) VALUES('".$_GET["name"]."','".$_GET["date"]."')";
        $pdo->exec($sql);
    }
    ?>
                
                

<body>
</body>
</html>