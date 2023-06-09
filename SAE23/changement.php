<?php

if(isset($_POST['username'])){
    $pdo1 = new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
    $sql1 = "select * from users where login = :login and password = :password";
    $req1 = $pdo1->prepare($sql1);
    $req1->bindParam(':login', $_POST['username']);
    $req1->bindParam(':password', md5($_POST['password']));
    $req1->execute();
    $res = $req1->fetch(PDO::FETCH_ASSOC);
    if($res!=NULL){
        $pdo = new PDO('mysql:host=localhost;charset=utf8;dbname=site','test','xd');
        $sql = "update users set password= :password2 where login = :login and password = :password";
        $req = $pdo->prepare($sql);
        $req->bindParam(':password2', md5($_POST['passafter']));
        $req->bindParam(':login', $_POST['username']);
        $req->bindParam(':password', md5($_POST['password']));
        $req->execute();
        echo '<p> Changement effectué</p>';
    }
    else{
        echo "<p> Mot de passe ou nom d'utilisateur incorrect</p>";
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <?php include_once("header.html"); ?>
    <form action="" method='post'>
    <input type='email' placeholder="E-Mail" name='username' required>
    <input type='password' placeholder="Mot de passe" name='password' required>
    <input type='password' placeholder="Nouveau mot de passe" name='passafter' required>
    <input type='submit' name='Effectuer les changements'>
</form>
<?php include_once("footer.html"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>