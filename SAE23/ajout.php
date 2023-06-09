<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une commande</title>
    <link rel="stylesheet" href="css/home.css">
    </head>
    <body>
    <?php include_once("header.html"); ?>
    <h1>Ajout</h1>
    <div id="filtre">
    <form action='' method='post'>
        <input type='text' name='idclient' placeholder='ID client' required> <br>
        Date de commande :<input type='date' name='date_commande' required/> <br>
    <input type='submit' value='Ajouter'/> </form></div>

    <?php
    ini_set('display_errors', 1);
    if (isset($_POST["date_commande"])) {
        $date1 = strtotime($_POST["date_commande"]);
        $date1 = date('Y-m-d', $date1);
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
        $sql = "INSERT INTO commandes (idclient, date_commande, status) VALUES (:cli, :date, 'Commandé')";
        $req = $pdo->prepare($sql);
        $req->bindParam(':cli', $_POST['idclient']);
        $req->bindParam(':date', $date1);
        $req->execute();
    }
    
    ?>
                
                
    <?php include_once("footer.html"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>