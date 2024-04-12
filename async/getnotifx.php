<?php
require('../action/act.php');

$success = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $success = 4;
    $str =  $_POST['strid'];
    $ql = "SELECT * FROM stream WHERE id_stream = ?";
    $selid = $bdd -> prepare($ql);
    $selid -> execute([$str]);
    $idstr = $selid -> fetch(); 

    $objx = $_POST['obj'];
    $notfx = $_POST['notf'];
    $date = time();
    if (isset($objx) && isset($notfx)) {        
        
        $sqlreq = "INSERT INTO notifications(id_user,objects,notifs,times) VALUES(?,?,?,?)";
        $instsel = $bdd -> prepare($sqlreq);
        $instsel -> execute(array($idstr['id_user'] ,$objx ,$notfx ,$date));

        $success = 1;
    }
        

$respx = ["success" => $success];
echo json_encode($respx);
}
?>