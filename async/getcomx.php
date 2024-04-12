<?php
require('../action/act.php');

$success = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["auth"]) {
    $iduser = $_SESSION['id_user'];
    $date = time();
    if (isset($iduser) && !empty($_POST['comx'])) {
        $idstr = $_POST['idstr'];
        $magx = $_POST['comx'];
        
        $sqlreq = "INSERT INTO comm_str(id_user,id_str,magx,date) VALUES(?,?,?,?)";
        $instsel = $bdd -> prepare($sqlreq);
        $instsel -> execute(array($iduser ,$idstr ,$magx ,$date));

        $success = 1;
        
    }

$respx = ["success" => $success];
echo json_encode($respx);
}
?>