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
    <div id="header">
      <div id="logo"></div>
      <div id="titre">
        <h1>Site de colis</h1>
    </div>
    <div id="retours"><span id="commentaire">"C'est incroyable"</span><span id="auteur">Camille Schlegel</span>
    </div>
    <div id="logout"> <a href="logout.php?logout=true"><span id="deconnexionSpan">Déconnexion</span> </a>
  </div>
    </div>
    <div id="body">
      <div id="filter">
    <div id="search">
    <form action='' method='get'> <input type='text' name='searchBar' placeholder="Rechercher"/> <button type='submit'><img src="images/loupe.svg"></button></form>
    </div>
    <div id="filtre">
    <span id="spanResultat">Résultats triés par:</span>
    <select title="Résultats triés par" id="trie">
    <option>Par défaut</options>
      <option>Date de commande</option>
      <option>Nom alphabétique</option>
      <option>Nom non-alphabétique</option>
      <option>Prénom alphabétique</option>
      <option>Prénom non-alphabétique</option>
    </select> 
    <span id="spanStatus">Status:</span>
    <select id="status">
      <option>Tout</options>
      <option>En cours de livraison</options>
      <option>Livré</options>
    </select>
    </div>
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
    $perPage=20;
    $currentPage=(int)($_GET["page"] ?? 1);
    if ($currentPage <=0){
      $currentPage=1;
    }
    $offset=($currentPage-1)*$perPage;
    
    if (isset($_GET['searchBar'])){
        $get=$_GET['searchBar'];
        $equipe="SELECT * FROM commandes";

    } else {
        $falseQuery="SELECT * FROM commandes";
        $trueQuery="SELECT * FROM commandes c join clients cli on cli.ID= c.IDclient LIMIT $perPage offset $offset" ;   
    }
    try {
      $statement=$pdo->query($falseQuery);
      $data=$statement->fetchAll(PDO::FETCH_ASSOC);
      $total = $statement->rowCount($data);
      $pages=ceil($total/$perPage);
      if ($currentPage > $pages){
        unset($currentPage);
        throw new Exception("Numéro de page invalide");
        
      }
      $statement=$pdo->query($trueQuery);
      $data=$statement->fetchAll(PDO::FETCH_ASSOC);
      afficheDataTable($data);
      $statement->closeCursor();
    }   
    catch (Exception $e) {
        printf("ERREUR : %s !\n",$e->getMessage());
      }
      
      
      ?>
      <div id="changePage">
        <?php if (isset($currentPage)):?>
      <?php if ($currentPage > 1): ?>
          <a id ="precedent" href="home.php?page=<?php echo $currentPage-1 ?>"> <span class="buttonChangePage">< Précédente</span></a>
          <?php   endif; ?>
        
          <?php if ($currentPage < $pages): ?>
          <a id="suivant"href="home.php?page=<?php echo $currentPage+1 ?>"> <span class="buttonChangePage">Suivante ></span></a>
          <?php   endif; ?>
          <?php endif; ?>
        

    </div>
    

  <?php else: header ("Location: login.php");
  endif;?>
 
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="script.js"></script>
</body>
<?php if (isset($_SESSION["username"])){
    include_once("footer.html");
}
?>
      
  

</html>