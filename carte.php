<?php

function afficheDataTable($data) {
    if (is_array($data)) {
      printf("<table>\n");
      //TODO nom des colonnes
      printf("<tr>");
      foreach($data as $value){
        echo "<td>".$value."</td>";
      }
      printf("</tr>\n");
      printf("</table>\n");
    } else {
      printf("<h2 style='color:red;'>Erreur de données !!!</h2>\n");
    }
  }


if (isset($_POST['idcommande'])){
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
    $sql = "SELECT idcommande as 'Numéro Commande', date_commande as 'Date Commande', date_livraison as 'Date Livraison', status, nom, prenom, adresse FROM commandes c join client cli on cli.idclient = c.IDclient where idcommande = :commande";
    $req = $pdo->prepare($sql);
    $req->bindParam(':commande', $_POST['idcommande']);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);
    if($res==NULL){
        echo "<p> La commande ".$_POST['idcommande']." n'existe pas ou a été supprimée</p>";
    }
    else{
        try{
            afficheDataTable($res);
        }
        catch (Exception $e) {
            printf("ERREUR : %s !!!\n",$e->getMessage());
          }
    }

}


?>
