<?php
session_start();
$domainhost = 'http://'.$_SERVER['HTTP_HOST'];
$serveur = 'localhost';
$nom = 'root';
$pass = '';
try {
    $bdd = new PDO("mysql:host=$serveur;dbname=darkstream", $nom, $pass);
    $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    echo('Connexion a la bdd  refuse type : ' .$e -> getmessage());
}

function analyse($donnees){
    $donnees = htmlspecialchars($donnees);
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = strip_tags($donnees);
    return $donnees;
}

// les cookinse des option du site
if (isset($_COOKIE['opts'])) {
    $opts = $_COOKIE['opts'];
    $id_opt = $_COOKIE['id-option'];
}
else {
    $opts = 'movies';
    $id_opt = '1';
    setcookie('opts',$opts,time() + 365 * 24 * 3600 ,null,null,false,true);
    setcookie('id-option',$id_opt,time() + 365 * 24 * 3600 ,null,null,false,true);
}
if (isset($_POST['btn-option'])) {
    $opts = $_POST['nav-option'];
    $id_opt = $_POST['id-option'];
    setcookie('opts',$opts,time() + 365 * 24 * 3600 ,null,null,false,true);
    setcookie('id-option',$id_opt,time() + 365 * 24 * 3600 ,null,null,false,true);
    header('location: index');
}

?>