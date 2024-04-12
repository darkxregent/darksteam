<?php
require('action/act.php');
require('action/indact.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/Cardstyles.css">
    <title>DarckStream</title>
</head>
<body>
    <?php require('includes/headerx.php'); ?>

    
<section class="dark_content">
<section class="dark_content_art">
    <?php
    if (isset($_GET['cath'])) {
        $cathx = $_GET['cath'];
    }else {
        $cathx = 0;
    }
    
    if (count($set_stopt) > 0) {
            
        
        for ($e=0; $e < count($set_stopt) ; $e++) { 
            $fdir = $domainhost."/filesdir/upfiles/";
            $cdir = $domainhost."/filesdir/couvers/";
            $avdir = $domainhost."/filesdir/avatares/";

            $idstream = $set_stopt[$e]['id_stream'];
            $iduser = $set_stopt[$e]['id_user'];
            $tr = $set_stopt[$e]['titres'];
            $dsc = $set_stopt[$e]['descr'];
            $pb_date = $set_stopt[$e]['date'];
            $urlfiles = $fdir . $set_stopt[$e]['upfiles'];
            $urlcouver = $cdir . $set_stopt[$e]['couvers'];

            $requx = "SELECT * FROM user WHERE id_user = ?";
            $setuser = $bdd -> prepare($requx);
            $setuser -> execute(array($iduser));
            $set_user = $setuser -> fetch();
            
            $ps = $set_user['pseudo'];
            $urlax = $avdir . $set_user['avatar'];

            $reqvu = "SELECT * FROM vues_str WHERE id_stream = ?";
            $setvues = $bdd -> prepare($reqvu);
            $setvues -> execute(array($idstream));
            $set_vues = $setvues -> fetch();

            // count vues
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

            // times pass  
            $timepasse = new dateTime("@$pb_date");

            $timereel = new dateTime();

            $instenttimes = $timereel -> diff($timepasse);
            
            if ($instenttimes -> y > 0 ) {
                $times = $instenttimes -> format('%y années');
            }elseif ($instenttimes -> m > 0 ) {
                $times = $instenttimes -> format('%m mois');
            }elseif ($instenttimes -> d > 0 ) {
                $times = $instenttimes -> format('%d jours');
            }elseif ($instenttimes -> h > 0 ) {
                $times = $instenttimes -> format('%h heures');
            }elseif ($instenttimes -> i > 0 ) {
                $times = $instenttimes -> format('%i mimutes');
            }else {
                $times = $instenttimes -> format('a l\'instants');
            }
            ?>
            <article class="drak_card">
                <div class="dark_articles" >
                    <a href="<?=$domainhost?>/xplays?stream=<?=$idstream?>"><video id="videos" src="<?=$urlfiles?>" poster="<?=$urlcouver?>"></video></a>
                    
                </div>
                <div class="drak_content_card">
                    <div class="drak_info_card">
                        <a href="<?=$domainhost?>/cc/statut/<?=$iduser?>-setid"><img class="card_prod" src="<?=$urlax?>" alt=""></a>
                        <div class="posi_card">
                            <a class="posi_card_tr" href="<?=$domainhost?>/xplays?stream=<?=$idstream?>"><h4><?=$tr?></h4></a>
                            <div class="postcard">
                                <a href="<?=$domainhost?>/cc/statut/<?=$iduser?>-setid"><p><?=$ps?></p></a>
                                <h5><?=$vues?> . <?=$times?></h5>
                            </div>
                        </div>
                        
                    </div>
                    <p class="comt_card"><?=$dsc?></p>
                </div>
            </article>

            <?php
        }
        
        ?>
</section>
    <div class="pading_list">
        
        <a class="pad_op" href="index-<?=$cathx?>cath-<?=$Npages-1?>pages"><span >
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff";>
            <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M6 6h2v12H6zm3.5 6l8.5 6V6l-8.5 6zm6.5 2.14L12.97 12 16 9.86v4.28z"/></svg>
        Prews</span></a>
        <ul class="pading">
        <?php
        $xd = $Npages - 3;
        $xf = $Npages + 3;
        if ($xd > 1) {
            echo("<li>. . .</li>");
        }
        
        for ($i=0; $i < $nbrPages ; $i++) { 
            $pading = $i + 1;
            
            if ($pading == $Npages) {
                echo("<li class='pd_cenx'><a href='index-".$cathx."cath-".$pading."pages'>$pading</a></li>");
            }
            elseif ($xd <= $pading AND $pading <= $xf) {
                echo("<li><a href='index-".$cathx."cath-".$pading."pages'>$pading</a></li>");
            }
        }
        if ($nbrPages > $xf) {
            echo("<li>. . .</li>");
        }
        ?>
        
        </ul>
        <a class="pad_op" href="index-<?=$cathx?>cath-<?=$Npages+1?>pages"><span>
        Next
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#fff">
            <path d="M0 0h24v24H0V0z" fill="none"/><path d="M8 9.86v4.28L11.03 12z" opacity=".3"/>
        <path d="M14.5 12L6 6v12l8.5-6zM8 9.86L11.03 12 8 14.14V9.86zM16 6h2v12h-2z"/></svg>
        </span></a>
        <?php
    }
      ?> 
      
    </div>    
</section>
    
    <script>
        const outplay = document.querySelectorAll('#videos');



        outplay.forEach(function (vidplay) {
        var timesInit = new Date().getTime();
        var timesout;
            vidplay.addEventListener('mouseover', function () {
            vidplay.volume = 0.15;
            timesout = setTimeout(function() {
                vidplay.play();
                vidplay.setAttribute("controls", "true");
                }, 3000);
            });
            
            vidplay.addEventListener("mouseout", function () {
                vidplay.removeAttribute("controls");
                vidplay.pause();
                clearTimeout(timesout);
            });
            

            
        });


        

    </script>
</body>
</html>