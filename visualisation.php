<?php
ini_set('display_errors', 1);

if(isset($_POST['idcommande'])){
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
    $sql = "select * from commandes c join client cli on cli.idclient = c.idclient where idcommande = :idcommande";
    $req = $pdo->prepare($sql);
    $req->bindParam(':idcommande', $_POST['idcommande']);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    afficheDataTable($res);
}
else{
    echo "<h2> La commande recherchée n'existe pas ou a été supprimée</p>";
}

function afficheDataTable($data) {
    $data2 = array_keys($data);
    echo "<table>";
    echo "<tr>";
    foreach($data2 as $value){
        echo "<td><b>".$value."</b></td>";
    }
    echo "</tr><tr>";
    foreach($data as $value){
        echo "<td>".$value."</td>";
    }
    echo "</tr></table>";
    
}
?>

