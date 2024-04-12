<?php
require('../action/act.php');

$success = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idstr = $_POST['idstr'];
    $sqrusd = "SELECT * FROM stream WHERE id_stream = ?";
        $usd = $bdd -> prepare($sqrusd);
        $usd -> execute(array($idstr));
        $usall = $usd -> fetchall();
        $userx = $usall[0]['id_user'];

    $id_opt = $_COOKIE['id-option']; 
    if (!isset($_COOKIE['setlikesx_'.$idstr])) {
        $rqx = "SELECT * FROM likes_str WHERE id_stream = ?";
        $selctx = $bdd -> prepare($rqx);
        $selctx -> execute(array($idstr));
        $alllik = $selctx -> fetchall();
        if (count($alllik) != 0) {
            $countlik = $alllik[0]['likes'];
            $nbrlik = $countlik + 1;
            $uprq = "UPDATE likes_str SET likes = ? WHERE id_stream = ?";
            $uplike = $bdd -> prepare($uprq);
            $uplike -> execute(array($nbrlik, $idstr));
            if ($uplike) {
                setcookie('setlikesx_'.$idstr,true,time() + 24 * 3600 ,null,null,false,true);
                $success = 1;
            }
            
        }else{
            $nbrlik = 1;
            $setrq = "INSERT INTO likes_str(id_user, id_opt, id_stream, likes) VALUES(?,?,?,?)";
            $setlike = $bdd -> prepare($setrq);
            $setlike -> execute(array($userx, $id_opt, $idstr, $nbrlik));
            if ($setlike) {
                setcookie('setlikesx_'.$idstr,true,time() + 24 * 3600 ,null,null,false,true);
                $success = 1;
            }
            
        }
    }
    


$respx = ["success" => $success];
echo json_encode($respx);
}
?>


