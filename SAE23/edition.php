<html>
<head>
<link rel="stylesheet" href="css/home.css">
</head>
<body>
<?php include_once("header.html"); ?>

<?php

function afficheDataTable($data) {
    $data2 = array_keys($data);
    echo "<table>";
    echo "<tr>";
    foreach($data2 as $value){
        echo "<th><b>".$value."</b></th>";
    }
    echo "</tr><tr>";
    foreach($data as $value){
        echo "<td>".$value."</td>";
    }
    echo "</tr></table>";   
}
    if($_POST['date_commande']!=NULL||$_POST['idclient']!=NULL||$_POST['date_livraison']!=NULL||$_POST['status']!=NULL){
        $pdo3 = new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
        $sql3 = "update commandes set ";
        if($_POST['idclient']!=NULL){
            $sql3 = $sql3." idclient =".$_POST['idclient'].",";
        }
        if($_POST['date_commande']!=NULL){
            $date1 = strtotime($_POST["date_commande"]);
            $date1 = date('Y-m-d', $date1);
            $sql3 = $sql3." date_commande ='".$date1."'";
        }
        if($_POST['date_livraison']!=NULL){
            $date2 = strtotime($_POST["date_livraison"]);
            $date2 = date('Y-m-d', $date2);
            $sql3 = $sql3." date_livraison ='".$date2."',";
        }
        if($_POST['status']!=NULL){
            $sql3 = $sql3." `status` ='".$_POST['status']."'";
        }
        $sql3 = $sql3." where idcommande =".$_POST['idcommande'];
        $pdoS = new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
        $pdoS->query($sql3);
    }
if(isset($_POST['idcommande'])){
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
    $sql = "select idcommande as 'Numéro Commande', nom, prenom, adresse, code_postal as 'Code postal', date_commande, date_livraison, status from commandes c join client cli on cli.idclient = c.idclient where idcommande = :idcommande";
    $req = $pdo->prepare($sql);
    $req->bindParam(':idcommande', $_POST['idcommande']);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    afficheDataTable($res);
}
else{
    echo "<h2> La commande recherchée n'existe pas ou a été supprimée</h2>";
}


?>
<table>
    <form action='edition.php' method='post'>
        <tr>
            <th class="edition">Destinataire</th>
            <th class="edition">Date de commande</th>
            <th class="edition">Date de livraison</th>
            <th class="edition">Statut de livraison</th>
        </tr>
        <tr>
            <td>
                <input type='text' placeholder="Renseignez l'ID d'un client..." name="idclient"></input>
            </td>
            <td>
                <input type='date' name="date_commande"></input>
            </td>
            <td>
                <input type='date' name='date_livraison'></input>
            </td>
            <td>
                <select name='status'>
                    <option value="" placeholder="-----"></option>
                    <option value='Livré'>Livré</option>
                    <option value='Commandé'>Commandé</option>
                    <option value='En cours de livraison'>En cours de livraison</option>
            </input>
            </td>
            <td>
                <input type="hidden" value='<?php echo $_POST['idcommande']; ?>' name='idcommande'>
                <input type="submit" value="modifier table">
            </td>
        </tr>
</form>
</table>

<?php include_once("footer.html"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script src="js/index.js"></script>
</body>
</html>