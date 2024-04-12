<?php
require('../action/act.php');

$id_user = $_SESSION['id_user'];
$success = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stats = $_POST['abn_satut']; 
    $id_abo = $_POST['idabn'];
    if ($stats == 200) {
        $resq = "INSERT INTO abnt(id_user, id_abo) VALUES(?,?)";
        $abonner = $bdd -> prepare($resq);
        $abonner -> execute(array($id_user, $id_abo));
        if ($abonner) {
            $success = 1;
        }

    }
    elseif($stats == 404){
        $desq = "DELETE FROM abnt WHERE id_user = ? AND id_abo = ?";
        $delabon = $bdd -> prepare($desq);
        $delabon -> execute(array($id_user, $id_abo));
        if ($delabon) {
            $success = 1;
        }
    }



$respx = ["success" => $success];
echo json_encode($respx);
}
?>