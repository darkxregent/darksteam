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
            $counteat = $alllik[0]['eaters'];
            $nbreat = $counteat + 1;
            $uprq = "UPDATE likes_str SET eaters = ? WHERE id_stream = ?";
            $upeater = $bdd -> prepare($uprq);
            $upeater -> execute(array($nbreat, $idstr));
            if ($upeater) {
                setcookie('setlikesx_'.$idstr,true,time() + 24 * 3600 ,null,null,false,true);
                $success = 1;
            }
            
        }else{
            $nbreat = 1;
            $setrq = "INSERT INTO likes_str(id_user, id_opt, id_stream, eaters) VALUES(?,?,?,?)";
            $seteater = $bdd -> prepare($setrq);
            $seteater -> execute(array($userx ,$id_opt ,$idstr ,$nbreat));
            if ($seteater) {
                setcookie('setlikesx_'.$idstr,true,time() + 24 * 3600 ,null,null,false,true);
                $success = 1;
            }
            
        }
    }


$respx = ["success" => $success];
echo json_encode($respx);
}
?>