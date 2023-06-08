
<html>
    <head>
    <link rel="stylesheet" href="css/visualisation.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="leaflet-1.7.1/leaflet.css"/>
</head>

<body>
<?php
  include_once("header.html")
  ?>

<?php

ini_set('display_errors', 1);

if(isset($_POST['idcommande'])){
    $pdo=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
    $sql = "select idcommande as 'N°commande', nom as Nom, prenom as Prénom, Adresse, code_postal as 'Code postal', date_commande, date_livraison, Status from commandes c join clients cli on cli.idclient = c.idclient where idcommande = :idcommande";
    $req = $pdo->prepare($sql);
    $req->bindParam(':idcommande', $_POST['idcommande']);
    $req->execute();
    $res = $req->fetch(PDO::FETCH_ASSOC);

    $pdo2=new PDO('mysql:host=localhost;charset=utf8;dbname=db_SCHLEGEL_1','22201642','329873');
    $sql2 = "select longitude, latitude from commandes c join clients cli on cli.idclient = c.idclient where idcommande = :idcommande";
    $req2 = $pdo2->prepare($sql2);
    $req2->bindParam(':idcommande', $_POST['idcommande']);
    $req2->execute();
    $res2 = $req2->fetch(PDO::FETCH_ASSOC);
    afficheDataTable($res);
}
else{
    echo "<h2> La commande recherchée n'existe pas ou a été supprimée</p>";
}

function afficheDataTable($data) {
    $data2 = array_keys($data);
    echo "<table>";
    echo "<tr class='head'>";
    foreach($data2 as $value){
        echo "<th><b>".$value."</b></th>";
    }
    echo "</tr><tr>";
    foreach($data as $value){
        echo "<td>".$value."</td>";
    }
    echo "</tr></table>";

}
?>


<span id="GPS"></span>
  <div class="flex">
    <div id="map" class="box"></div>
  </div>
  <?php
  include_once("footer.html")
  ?>
</body>

<script src="leaflet-1.7.1/leaflet.js"></script>
<script type="text/javascript">
    var map = null;
function initMap() {
    let mapOptions={center: [<?php echo $res2["latitude"] ?>,<?php echo $res2["longitude"] ?>], zoom: 11};
    let layerOptions={attribution: '(c) OpenStreetMap France', minZoom: 1, maxZoom: 20};
    map = new L.map('map',mapOptions);
    let layer=new L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',layerOptions);
    let marker = new L.Marker([<?php echo $res2["latitude"] ?>,<?php echo $res2["longitude"] ?>]);
    L.control.scale().addTo(map);
    marker.bindPopup("Point de livraison");
    marker.addTo(map);
    map.addLayer(layer);
  }

window.onload=function(){
    initMap();
};
</script>

