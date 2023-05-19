

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    
<?php session_start(); ?>
    <?php
    if (isset($_SESSION['username'])): 
       ?>
    
      <div>
        <h1>Home</h1>
    </div>
    <div> <a href="logout.php?logout=true"><span>Déconnexion</span> </a>
  </div>
    <div>
    <form action='' method='get'> Recherche: <input type='text' name='searchBar'/> <input type='submit' value='Rechercher'/> </form>
    </div>
    <?php
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
    
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
    
    if (isset($_GET['searchBar'])){
        $get=$_GET['searchBar'];
        $equipe="SELECT * FROM SAE23 where Prénom like '%$get%'";
        
    } else {
        $equipe="SELECT * FROM SAE23";   
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
 
</body>
</html>