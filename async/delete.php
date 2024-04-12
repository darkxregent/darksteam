<?php
require('../action/act.php');

$success = 0;
$modif = "echec de le supretion de la videos  \n
    Veuillez réessayer pluis tars";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $str_id = analyse($_POST['idstr']);

    $sqtsel = "SELECT * FROM stream WHERE id_stream = ?";
    $selsupr = $bdd -> prepare($sqtsel);
    $selsupr  -> execute([$str_id]);
    $allsup = $selsupr -> fetch();

    $str_plxid = $allsup['id_plx'];
    $str_vid = "../filesdir/upfiles/" .$allsup['upfiles'];
    $str_crx = "../filesdir/couvers/" .$allsup['couvers'];

    if ($str_plxid != 0) {
        $srqplx = "DELETE FROM playlists WHERE id_plx = ?";
        $plxdel = $bdd -> prepare($srqplx);
        $plxdel  -> execute([$str_plxid]);

        
    }
    
    
        $srqdl = "DELETE FROM stream WHERE id_stream = ?";
        $modifdl = $bdd -> prepare($srqdl);
        $modifdl  -> execute([$str_id]);
            
        $sprlk= "DELETE FROM likes_str WHERE id_stream = ?";
        $sprlike = $bdd -> prepare($sprlk);
        $sprlike  -> execute([$str_id]);

        $sprv = "DELETE FROM vues_str WHERE id_stream = ?";
        $sprvues = $bdd -> prepare($sprv);
        $sprvues  -> execute([$str_id]);

        
    
        if (file_exists($str_vid)) {
            unlink($str_vid);
        }
        if (file_exists($str_crx)) {
            unlink($str_crx);
        }


    $success = 1;
    $modif = $str_id;     
    
    $respx = ["success" => $success , "modif" => $modif];
    echo json_encode($respx);
}


?>
