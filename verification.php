<?php

session_start();

function afficheDataTable($data) {
    if (is_array($data)) {
      printf("<table>\n");
      printf("<tr>"); 
      foreach (array_keys(current($data)) as $i=>$colName) {
        printf("<th>%s</th>",$colName);
      }
      printf("</tr>\n");
      foreach ($data as $i=>$row) {
        printf("<tr>"); 
        foreach ($row as $key=>$val) {
          printf("<td>%s</td>",$val);
        }
        printf("</tr>\n");
      }
      printf("</table>\n");
    } else {
      printf("<h2 style='color:red;'>Erreur de données !!!</h2>\n");
    }
  }

if(isset($_POST['username']) && isset($_POST['password'])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
    try{
        $requete="SELECT count(*) FROM `utilisateurs` WHERE motDePasse='".$password."' and username='".$username."'";
        $statement=$pdo->query($requete)-> fetchColumn();
        #$data=$statement->fetchAll(PDO::FETCH_ASSOC);
        #afficheDataTable($data);
        #$statement->closeCursor();
        #echo $statement;
    }
    catch (Exception $e) {
        printf("ERREUR : %s !!!\n",$e->getMessage());
      }
}
if (isset($statement)){
    if ($statement==1){
        $_SESSION['username'] = $username;
        header('Location: home.php');
    } else{
        header('Location: login.php?erreur=1');
        echo "Problème";
    }
}
