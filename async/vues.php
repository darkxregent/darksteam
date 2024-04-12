<?php
require('../action/act.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_stream = $_POST['idstr'];
    $sqrusd = "SELECT * FROM stream WHERE id_stream = ?";
        $usd = $bdd -> prepare($sqrusd);
        $usd -> execute(array($id_stream));
        $usall = $usd -> fetchall();
        $userx = $usall[0]['id_user'];

    $id_opt = $_COOKIE['id-option'];
    if (!isset($_COOKIE['setvues_'.$id_stream])) {
        $vurq = "SELECT * FROM vues_str WHERE id_stream = ?";
        $setvue = $bdd -> prepare($vurq);
        $setvue -> execute(array($id_stream));
        $setallvue = $setvue -> fetchall();
        if (count($setallvue) != 0) {
            $countvue = $setallvue[0]['vues'];
            $nbrvue = $countvue + 1;
            $vsrq = "UPDATE vues_str SET vues = ? WHERE id_stream = ?";
            $getvue = $bdd -> prepare($vsrq);
            $getvue  -> execute(array($nbrvue, $id_stream));
            setcookie('setvues_'.$id_stream, true,time() + 24 * 3600 ,null,null,false,true);
            
        }else{
            $nbrvue = 1;
            $vsrqx = "INSERT INTO vues_str(id_user,id_opt,id_stream , vues) VALUES(?,?,?,?)";
            $getvues = $bdd -> prepare($vsrqx);
            $getvues  -> execute(array($userx ,$id_opt ,$id_stream , $nbrvue));
            setcookie('setvues_'.$id_stream,true,time() + 24 * 3600 ,null,null,false,true);
        }

    }

}
?>