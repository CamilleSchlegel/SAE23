  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    
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
    <script>
      $(document).ready(function() {
      $("input").click(function(){

        $("form").addClass("formClick").css({
          "border": "#ffd61e 2px solid",
          "border-radius": "4px"});
      });
      /*chatgpt*/
      $(document).click(function(event) {
        var target = $(event.target);
        if (!target.closest("form").length) {
          $("form").removeClass("formClick").css({
            "border": "",
            "border-radius": ""
          });
        }
      });
      var divCommentaire=$("#commentaire");
      var divAuteur=$("#auteur");
      function defileTexte() {
    divCommentaire.animate({ marginLeft: "200%" }, 1000, function() {
      $(this).text(message[compteur][0]).css("marginLeft", "-15%").animate({ marginLeft: "0%" }, 1000);
    });
    divAuteur.animate({ marginLeft: "200%" }, 1000, function() {
      $(this).text(message[compteur][1]).css("marginLeft", "-15%").animate({ marginLeft: "0%" }, 1000);
    });
  }
      
      
      var compteur=0;
      var message=[["Wow, j'ai jamais vu une telle livraison sdjfhjsdf jksjdfk jskdjf sqjdf hdqsj fqsdkjf ksqdjkf jsqkdjfk","Camille Schlegel"], ["Ce site de colis est incroyable","Robin Semene"],["Je recommende","Jonathan Schlegel"]];
      setInterval(function(){ 
        defileTexte();
        setTimeout(function() {
          divCommentaire.text(message[compteur][0]);
          divAuteur.text(message[compteur][1]);
          compteur=(compteur+1)%message.length;
        },2000);
  }, 10000);
});

    </script>
  <?php else: header ("Location: loginRobin.php");
  endif;?>
 
</div>
<?php
  include_once("footer.html")
  ?>
</body>

  

</html>