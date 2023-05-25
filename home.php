  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
  
<?php session_start(); ?>
    <?php
    if (isset($_SESSION['username'])): 
       ?>
    <div id="header">
      <div id="logo"></div>
      <div id="titre">
        <h1>Site de colis</h1>
    </div>
    <div id="logout"> <a href="logout.php?logout=true"><span id="deconnexionSpan">Déconnexion</span> </a>
  </div>
    </div>
    <div id="body">
    <div>
    <form action='' method='get'> Recherche: <input type='text' name='searchBar'/> <input type='submit' value='Rechercher'/> </form>
    <select title="Résultats triés par:">
      <option>Date de commande</option>
    </select> 
    </div>
    <?php
     function afficheDataTable($data) {
      $color=0;
        if (is_array($data)) {
          printf("<table>\n");
          printf("<tr>"); 
          foreach (array_keys(current($data)) as $i=>$colName) {
            printf("<th>%s</th>",$colName);
          }
            printf("</tr>\n");
          
          foreach ($data as $i=>$row) {
            if ($color===0){
              printf("<tr class='grey'>"); 
              foreach ($row as $key=>$val) {
                printf("<td>%s</td>",$val);
              }
              printf("</tr>\n");
              $color=1;
          }
          else{
            printf("<tr>"); 
              foreach ($row as $key=>$val) {
                printf("<td>%s</td>",$val);
              }
              printf("</tr>\n");
              $color=0;

          }
        }
          printf("</table>\n");
        } else {
          printf("<h2 style='color:red;'>Erreur de données !!!</h2>\n");
        }
      }
    
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
    
    if (isset($_GET['searchBar'])){
        $get=$_GET['searchBar'];
        $equipe="SELECT * FROM commandes";

    } else {
        $equipe="SELECT * FROM commandes c join clients cli on cli.ID= c.IDclient";   
    }
    try {
      $statement=$pdo->query($equipe);
      $data=$statement->fetchAll(PDO::FETCH_ASSOC);
      afficheDataTable($data);
      $statement->closeCursor();
    }   
    catch (Exception $e) {
        printf("ERREUR : %s !!!\n",$e->getMessage());
      }
      ?>
  <?php else: header ("Location: login.php");
  endif;?>
 
</div>
</body>
</html>