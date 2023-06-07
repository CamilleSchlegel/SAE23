<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
  
<?php session_start(); ?>
    <?php
    if (isset($_SESSION['username'])): 
       ?>
    <?php
  include_once("header.html");
  ?>
    </div>
    <div id="body">
    <div id="search">
    <form action='' method='get'> <input type='text' name='searchBar' placeholder="Rechercher"/> <button type='submit'><img src="images/loupe.svg"></button>
    </div>
    <div id="filtre">
    <span id="spanResultat">Résultats triés par:</span>
    <select title="Résultats triés par" id="trie" name='tri'>
    <option>Par défaut</options>
      <option>Date de commande</option>
      <option>Nom alphabétique</option>
      <option>Nom non-alphabétique</option>
      <option>Prénom alphabétique</option>
      <option>Prénom non-alphabétique</option>
    </select> 
    <span id="spanStatus">Status:</span>
    <select id="status" name='status'>
      <option>Tout</options>
      <option>En cours de livraison</options>
      <option>Livré</options>
    </select>
    </form>
    </div>
    <?php
    $link = array(
      "Date de commande" => " date_commande",
      "Nom alphabétique" => " nom",
      "Nom non-alphabétique" => " nom desc",
      "Prénom alphabétique" => " prenom",
      "Prénom non-alphabétique" => " prenom desc"
    );
     function afficheDataTable($data) {
      $color=0;
        if (is_array($data)) {
          printf("<table>\n");
          printf("<tr>"); 
          foreach (array_keys(current($data)) as $i=>$colName) {
            printf("<th>%s</th>",$colName);
          }
          printf("<th> Carte </th>");
            printf("</tr>\n");
          
          foreach ($data as $i=>$row) {
            if ($color===0){
              printf("<tr class='grey'>"); 
              foreach ($row as $key=>$val) {
                printf("<td>%s</td>",$val);
              }
              $color=1;
          }
          else{
            printf("<tr>"); 
              foreach ($row as $key=>$val) {
                printf("<td>%s</td>",$val);
              }
              $color=0;
          }
          echo '<td><form action="visualisation.php" method="post">
          <input type="hidden" value="'.$row['N°commande'].'" name="idcommande">
          <input type="submit" value="Voir Carte"></input>
          </form></td></tr>
          <td><form action="edition.php" method="post">
          <input type="hidden" value="'.$row['N°commande'].'" name="idcommande">
          <input type="submit" value="Editer"></input>
      </form></td>
      </tr>';

        }
          printf("</table>\n");
        } else {
          printf("<h2 style='color:red;'>Erreur de données !!!</h2>\n");
        }
      }
    
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
    
    $perPage=5;
    $currentPage=(int)($_GET["page"] ?? 1);
    if ($currentPage <=0){
      $currentPage=1;
    }
    $offset=($currentPage-1)*$perPage;

    $equipe="SELECT idcommande as 'N°commande', nom, prenom, adresse, code_postal, date_commande as 'Date de commande', date_livraison as 'Date de livraison', status FROM commandes c join clients cli on cli.idclient = c.IDclient LIMIT $perPage offset $offset";
    $equipeFalse="SELECT idcommande as 'N°commande', nom, prenom, adresse, code_postal, date_commande as 'Date de commande', date_livraison as 'Date de livraison', status FROM commandes c join clients cli on cli.idclient = c.IDclient";

    if (isset($_GET['searchBar']) && $_GET['searchBar']!= NULL){
        $equipe= $equipe . " where nom like '". $_GET['searchBar']. "' or prenom like '". $_GET['searchBar']."'";
    }
    if(isset($_GET['status']) && $_GET['status']!="Tout"){
      if (isset($_GET['searchBar']) && $_GET['searchBar']!= NULL){
        $equipe = $equipe. " and status = '".$_GET['status']."'";
      }
      else{
        $equipe = $equipe. " where status ='".$_GET['status']."'";
      }
    }
    if(isset($_GET['tri']) && $_GET['tri']!="Par défaut"){
      $equipe = $equipe . " order by ". $link[$_GET['tri']];
    }
    try {
      $statement=$pdo->query($equipeFalse);
      $data=$statement->fetchAll(PDO::FETCH_ASSOC);
      $total = $statement->rowCount();
      $pages=ceil($total/$perPage);
      if ($currentPage > $pages){
        unset($currentPage);
        throw new Exception("Numéro de page invalide");
        
      }
      $statement=$pdo->query($equipe);
      $data=$statement->fetchAll(PDO::FETCH_ASSOC);
      afficheDataTable($data);
      $statement->closeCursor();
    }   
    catch (Exception $e) {
        printf("ERREUR : %s !!!\n",$e->getMessage());
      }
      ?>
      <div id="changePage">
        <?php if (isset($currentPage)): ?>
      <?php if ($currentPage > 1): ?>
          <a id ="precedent" href="home.php?page=<?php echo $currentPage-1 ?>"> <span class="buttonChangePage">< Précédente</span></a>
          <?php   endif; ?>
        
          <?php if ($currentPage < $pages): ?>
          <a id="suivant"href="home.php?page=<?php echo $currentPage+1 ?>"> <span class="buttonChangePage">Suivante ></span></a>
          <?php   endif; ?>
          <?php endif; ?>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js/index.js"></script>
<?php
  include_once("footer.html")
  ?>
</body>
</html>

<?php else: header ("Location: login.php");
  endif;?>