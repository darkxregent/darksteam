<?php
require('../action/act.php');

$success = 0;
$modif = "echec de le supretion de la videos  \n
    Veuillez réessayer pluis tars";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['rcomx']) && isset($_POST['id_comx'])) {
        $repcomx = analyse($_POST['rcomx']);
        $id_comx = analyse($_POST['id_comx']);
        $id_user = $_SESSION['id_user'];
        $date = time();
        $reqtx = 'INSERT INTO repx_comx(id_user,id_comx,repx_comx,date) VALUES(?,?,?,?)';
        $instrepx = $bdd -> prepare($reqtx);
        $instrepx -> execute([$id_user,$id_comx,$repcomx,$date]);

        $success = 1;   
        $modif = "sucess";
    }
    
    
$respx = ["success" => $success , "modif" => $modif];
echo json_encode($respx);
}


?>
