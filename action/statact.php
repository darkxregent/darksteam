<?php
$iduser = $_SESSION['id_user'];
$idabn = $_GET['setid'];

$reqsetuser = "SELECT * FROM user WHERE id_user = ?";
$setuser = $bdd -> prepare($reqsetuser);
$setuser -> execute(array($idabn));
$setmyuser = $setuser -> fetch();


$reqmyabn = "SELECT * FROM abnt WHERE id_abo = ?";

$myabn = $bdd -> prepare($reqmyabn);
$myabn -> execute(array($idabn));
$setmyabn = $myabn -> fetchall();
$nbr_abn = count($setmyabn);
if (isset($nbr_abn)) {
    if ($nbr_abn == 0) {
        $allabn = 'Aucune';
    }
    else {
        if ($nbr_abn > 0) {
            $allabn = $nbr_abn.' abonnés' ;
        }
        elseif ($nbr_abn >= 1000 && 999999 >= $nbr_abn) {
            $nbr = $nbr_abn/1000;
            $allabn = $nbr.'K abonnés';
        }
        elseif ($nbr_abn >= 1000000) {
            $nbr = $nbr_abn/1000000;
            $allabn = $nbr.'M abonnés';
        }
        
    }
}



if (isset($_GET['setid'])) {


    $reqabn = "SELECT * FROM abnt WHERE id_user = ? AND id_abo = ?";

    $abn = $bdd -> prepare($reqabn);
    $abn -> execute(array($iduser , $idabn));
    $setabn = $abn -> fetchall();

    if (isset($_POST['getabn']) && count($setabn) == 0 ) {
        $reqistbn = "INSERT INTO abnt(id_user , id_abo) VALUES(?,?)";

        $istabn = $bdd -> prepare($reqistbn);
        $istabn -> execute(array($iduser , $idabn));
    }
    elseif (isset($_POST['revabn']) && count($setabn) != 0 ) {
        $idabnt = $setabn[0]['id_abnt'];

        $reqdrabn = "DELETE FROM abnt WHERE id_abnt = ?";

        $drabn = $bdd -> prepare($reqdrabn);
        $drabn -> execute(array($idabnt));
    }
}






$selqr = "SELECT * FROM options ORDER BY id_opt ASC";
$abnopx = $bdd -> prepare($selqr);
$abnopx -> execute();
$opx = $abnopx -> fetchall();

for ($i=0; $i < count($opx); $i++) { 

    $rqx = "SELECT * FROM stream WHERE id_user = ? AND id_opt = ? ORDER BY id_str DESC";
    $vidx = $bdd -> prepare($rqx);
    $vidx -> execute([$_GET['setid'], $opx[$i]['id_opt']]);
    $opvidx = $vidx -> fetchall();

    $coutvidx[$i] = count($opvidx);
    for ($a=0; $a < $coutvidx[$i] ; $a++) { 
        $id_str[$i][$a] = $opvidx[$a]['id_stream'];
        $trix[$i][$a] = $opvidx[$a]['titres'];
        $upx[$i][$a] = $opvidx[$a]['upfiles'];
        $cvx[$i][$a] = $opvidx[$a]['couvers'];
        $dtx = $opvidx[$a]['date'];

            // fucion colcule du temps depuis la publication de l'element
            $timepasse = new dateTime("@$dtx");

            $timereel = new dateTime();

            $instenttimes = $timereel -> diff($timepasse);
            
            if ($instenttimes -> y > 0 ) {
                $times = $instenttimes -> format('il y a %y années');
            }elseif ($instenttimes -> m > 0 ) {
                $times = $instenttimes -> format('il y a %m mois');
            }elseif ($instenttimes -> d > 0 ) {
                $times = $instenttimes -> format('il y a %d jours');
            }elseif ($instenttimes -> h > 0 ) {
                $times = $instenttimes -> format('il y a %h heures');
            }elseif ($instenttimes -> i > 0 ) {
                $times = $instenttimes -> format('il y a %i mimutes');
            }else {
                $times = $instenttimes -> format('a l\'instants');
            }




        $vu = $bdd -> prepare("SELECT * FROM vues_str WHERE id_stream = ?");
        $vu -> execute([$id_str[$i][$a]]);
        $vux = $vu -> fetchall();
        if (count($vux) > 0) {
            $vues[$i][$a] = $vux[0]['vues'];
        }else{
            $vues[$i][$a] = 0;
        }

    }

}


?>
