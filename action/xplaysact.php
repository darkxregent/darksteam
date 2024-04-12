<?php

if (isset($_GET['stream'])) {
    $dirx = $domainhost."/filesdir/";
    $idstream = $_GET['stream'];

    $rq = "SELECT * FROM stream WHERE id_stream = ?";
    $selctstr = $bdd -> prepare($rq);
    $selctstr -> execute(array($idstream));
    $allselect = $selctstr -> fetch();
     
    $iduser = $allselect['id_user'];
    $idcath = $allselect['id_cath'];
    $idplx = $allselect['id_plx'];
    $trx = htmlspecialchars($allselect['titres']);
    $descr = $allselect['descr'];
    $files = $dirx.'upfiles/'.$allselect['upfiles'];
    $couver = $dirx.'couvers/'.$allselect['couvers'];
    $tail = $allselect['size'];
    $temps = $allselect['times'];
    $date = $allselect['date'];
    
    if($tail){
        $x = $tail/1024;
        $ex = $x/1024;
        $ax = $ex/1024;
        if ( $x != 0 && $x < 1024 ) {
            $ex =  number_format($x ,2);
            $exx = $ex ."ko";
        }
        elseif(1 <= $ex AND $ex < 1024){
            $ex =  number_format($ex ,2);
            $exx = $ex ."Mo";
        }
        elseif(1024 <= $x){
            $ax =  number_format($ax ,2);
            $exx = $ax ."Go";
        }         
    };
    
    $rqx = "SELECT * FROM likes_str WHERE id_stream = ?";
    $selctx = $bdd -> prepare($rqx);
    $selctx -> execute(array($idstream));
    $alllik = $selctx -> fetchall();

    
    
    if (count($alllik) != 0) {
        $countlik = $alllik[0]['likes'];
        $counteat = $alllik[0]['eaters'];
        if ($countlik != 0) {
            $liks = $countlik;
            $klikes = $liks/1000;
            $mlikes = $liks/1000;
            if ($liks > 0 && $liks < 1000) {
                $alllikes = $liks;
            }
            elseif ($klikes > 0 && $klikes < 1000) {
                $alllikes = $klikes.'K';
            }
            elseif ($mlikes >= 1) {
                $alllikes = $mlikes.'M';
            }
        }
        else {
            $alllikes = '';
        }
    
        if ($counteat != 0) {
            $eater = $counteat;
            $keater = $eater/1000;
            $meater = $eater/1000;
            if ($eater > 0 && $eater < 1000) {
                $alleaters = $eater;
            }
            elseif ($keater > 0 && $keater < 1000) {
                $alleaters = $keater.'K';
            }
            elseif ($countlik >= 1) {
                $alleaters = $meater.'M';
            }
        }
        else {
            $alleaters = '';
        }
    }else {
        $alllikes = '';
        $alleaters = '';
    }
    

    // auteur profiles
    $requx = "SELECT * FROM user WHERE id_user = ?";
            $setuser = $bdd -> prepare($requx);
            $setuser -> execute(array($iduser));
            $set_user = $setuser -> fetch();
    
     $ps = $set_user['pseudo'];
     $urlax = $dirx.'avatares/'. $set_user['avatar'];

    // cathegories of the videos
    $reqcx = "SELECT * FROM stream WHERE id_cath = ?";
        $setcox = $bdd -> prepare($reqcx);
        $setcox -> execute(array($idcath));
        $set_cox = $setcox -> fetch();

    // conteures of the vues
    $reqvu = "SELECT * FROM vues_str WHERE id_stream = ?";
            $setvues = $bdd -> prepare($reqvu);
            $setvues -> execute(array($idstream));
            $set_vues = $setvues -> fetch();
    
            // fucion colcule du temps depuis la publication de l'element
            $timepasse = new dateTime("@$date");

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



    // valider lecture du vues
    if ($set_vues) {
        $vu = $set_vues['vues'];
        if ($vu == 1) {
            $vues = "1 vue";
        }elseif (1 < $vu && $vu <= 999) {
            $vues = $vu.' vues';
        } elseif (999 < $vu && $vu <= 999999) {
            $vue = $vu/1000;
            $vues = $vue.'k vues';
        }elseif (999999 < $vu  ) {
            $vue = $vu/1000000;
            $vues = $vue.'M vues';
        }
         $vues;
    }else {
        $vues = 'Aucun vue';
        $vues;
    }

    // nbr abonner 
    $reqmyabn = "SELECT * FROM abnt WHERE id_abo = ?";

    $myabn = $bdd -> prepare($reqmyabn);
    $myabn -> execute(array($iduser));
    $setmyabn = $myabn -> fetchall();
    $nbr_abn = count($setmyabn);
    if (isset($nbr_abn)) {
        if ($nbr_abn == 0) {
            $allabn = 'Aucune';
        }
        else {
            if ($nbr_abn > 0 && 1000 > $nbr_abn ) {
                $allabn = $nbr_abn.' abonné' ;
            }
            elseif ($nbr_abn >= 1000 && 999999 >= $nbr_abn) {
                $nbr = $nbr_abn/1000;
                $allabn = $nbr.'K abonné';
            }
            elseif ($nbr_abn >= 1000000) {
                $nbr = $nbr_abn/1000000;
                $allabn = $nbr.'M abonné';
            }
            
        }
    }


    if ($idplx != 0) {
        $reqmyplx = "SELECT * FROM playlists WHERE id_plx = ?";

        $myplx = $bdd -> prepare($reqmyplx);
        $myplx -> execute(array($idplx));
        $setplx = $myplx -> fetch();

        $plxname = $setplx['plx'];

        $reqplx = "SELECT * FROM stream WHERE id_plx = ?";
        $allplx = $bdd -> prepare($reqplx);
        $allplx -> execute(array($idplx));
        $setallplx = $allplx -> fetchall();

        for ($i=0; $i < count($setallplx) ; $i++) { 
            # code...
       
        $plxidstr[$i] = $setallplx[$i]['id_stream'];
        $plxtx[$i] = $setallplx[$i]['titres'];
        $plxdescr[$i] = $setallplx[$i]['descr'];
        $plxtime[$i] = $setallplx[$i]['times'];
        $plxdate[$i] = $setallplx[$i]['date'];
        $plxcouvers[$i] = $dirx.'couvers/'. $setallplx[$i]['couvers'];
        
        
        $xtimepasse[$i] = new dateTime("@$plxdate[$i]");

            $xtimereel[$i] = new dateTime();

            $xinstenttimes[$i] = $xtimereel[$i] -> diff($xtimepasse[$i]);
            
            if ($xinstenttimes[$i] -> y > 0 ) {
                $plxdate[$i] = $xinstenttimes[$i] -> format('il y a %y années');
            }elseif ($xinstenttimes[$i] -> m > 0 ) {
                $plxdate[$i] = $xinstenttimes[$i] -> format('il y a %m mois');
            }elseif ($xinstenttimes[$i] -> d > 0 ) {
                $plxdate[$i] = $xinstenttimes[$i] -> format('il y a %d jours');
            }elseif ($xinstenttimes[$i] -> h > 0 ) {
                $plxdate[$i] = $xinstenttimes[$i] -> format('il y a %h heures');
            }elseif ($xinstenttimes[$i] -> i > 0 ) {
                $plxdate[$i] = $xinstenttimes[$i] -> format('il y a %i mimutes');
            }else {
                $plxdate[$i] = $xinstenttimes[$i] -> format('a l\'instants');
            }


            $reqvux[$i] = "SELECT * FROM vues_str WHERE id_stream = ?";
            $plxvues[$i] = $bdd -> prepare($reqvux[$i]);
            $plxvues[$i] -> execute(array($plxidstr[$i]));
            $plx_vues[$i] = $plxvues[$i] -> fetch();
            if ($plx_vues[$i]) {
                $vux[$i] = $plx_vues[$i]['vues'];
                if ($vux[$i] == 1) {
                    $xvues[$i] = "1 vue";
                }elseif (1 < $vux[$i] && $vux[$i] <= 999) {
                    $xvues = $vux[$i].' vues';
                } elseif (999 < $vu[$i] && $vu[$i] <= 999999) {
                    $xvue[$i] = $vux[$i]/1000;
                    $xvues[$i] = $xvue[$i].'k vues';
                }elseif (999999 < $vux[$i]  ) {
                    $xvue[$i] = $vux[$i]/1000000;
                    $xvues[$i] = $xvue[$i].'M vues';
                }
                 $xvues[$i];
            }else {
                $xvues[$i] = 'Aucun vue';
                $xvues[$i];
            }
        }
    }


    $reqabn = "SELECT * FROM abnt WHERE id_user = ? AND id_abo = ?";

        $abn = $bdd -> prepare($reqabn);
        $abn -> execute(array($_SESSION['id_user'], $iduser));
        $abnt = $abn -> fetchall();

    
}

?>