<?php
require('../action/act.php');

    header("Content-Type: text/xml");

    echo('<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>');

    echo('<response 
    style="
    display: flex;
    flex-direction: column;
    ">');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_str = $_POST['idstr'];
    }
    
    $reqsel = "SELECT * FROM comm_str WHERE id_str = ? ORDER BY id DESC";
    $selx = $bdd -> prepare($reqsel);
    $selx -> execute([$id_str]);
    $allselx = $selx -> fetchall();
    for ($i=0; $i < count($allselx) ; $i++) { 
        $magx = $allselx[$i]['magx'];
        $dda = $allselx[$i]['date'];

        $idauth = $allselx[$i]['id_user'];
        $idcx = $allselx[$i]['id'];

        // times pass  
        $timepasse = new dateTime("@$dda");

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


        $requser = "SELECT * FROM user WHERE id_user = ?";
        $userx = $bdd -> prepare($requser);
        $userx -> execute([$idauth]);
        $alluser = $userx -> fetch();

        $avx = '../filesdir/avatares/'.$alluser['avatar'];
        $psdx = $alluser['pseudo'];
        echo('<div class="comm_flex">');
            echo('<img class="pof_user" src='.$avx.' alt="">');
            echo('<div class="cont_comm">');
                echo('<h3>'.$psdx.'</h3>');
                echo('<p> '.$magx.'</p>');
                echo('<div class="comm_flexed">');
                    echo('<div data-id-comx='.$idcx.' class="respcomx">');
                    if ($idauth == $_SESSION['id_user']) {
                        echo('<h4>Suprimer</h4>');
                    }
                        echo('<h4 class="respx"  onclick="recupererClasse(this)">Repondre</h4>');
                    echo('</div>');
                    echo('<P class="ifo_date">'.$times.'</</P>');
                echo('</div>');

                // pour les reoponse aux commentaires 
                $sqlrep = "SELECT * FROM repx_comx WHERE id_comx = ? ORDER BY id ASC";
                $repx = $bdd -> prepare($sqlrep);
                $repx -> execute([$allselx[$i]['id']]);
                $allrepx = $repx -> fetchall();
                for ($x=0; $x < count($allrepx); $x++) { 
                    $iduser = $allrepx[$x]['id_user'];
                    $repx_comx = $allrepx[$x]['repx_comx'];
                    $date = $allrepx[$x]['date'];

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


                    $requser = "SELECT * FROM user WHERE id_user = ?";
                    $userx = $bdd -> prepare($requser);
                    $userx -> execute([$iduser]);
                    $alluser = $userx -> fetch();

                    $psdx = $alluser['pseudo'];
                    $avx = '../filesdir/avatares/'.$alluser['avatar'];
                    echo('<div class="comm_flex comm">');
                        echo('<img class="pof_user" src='.$avx.' alt="">');
                        echo('<div class="cont_comm">');
                            echo('<h3>'.$psdx.'</h3>');
                            echo('<p> '.$repx_comx.'</p>');
                            echo('<div class="comm_flexed">');
                                echo('<div data-id-comx='.$idcx.' class="respcomx">');
                                if ($iduser == $_SESSION['id_user']) {
                                    echo('<h4>Suprimer</h4>');
                                }
                                    echo('<h4 class="respx"  onclick="recupererClasse(this)">Repondre</h4>');
                                echo('</div>');
                                echo('<P>'.$times.'</P>');
                            echo('</div>');
                                    
                            
                        echo('</div>');
                                
                    echo('</div>');
                }
            echo('</div>');
        echo('</div>');
    }
    
    // $id_opts = $_POST['options'];
    // echo('<label for="cath">Les Cathegories</label>');
    // echo('<select class="cath" name="cath" id="cath">');
    // if ($id_opts != 0) {
        
    //     $reqcath = "SELECT * FROM cathegories WHERE id_opt = ?";
    //     $selectcath = $bdd -> prepare($reqcath);
    //     $selectcath -> execute(array($id_opts));
    //     $set_cath = $selectcath -> fetchall();

    //     if(count($set_cath) > 0) {
    //         echo('<option value="">Aucune cathegories selectionner</option>');
    //         for ($a=0; $a < count($set_cath); $a++) {
    //             $id_cath = $set_cath[$a]['id_cath'];
    //             $cath = $set_cath[$a]['cath'];
                
    //             echo("<option value='$id_cath'>$cath</option>");
    //         }
    //     }else{
    //         echo('<option value="">Cette options est invalide</option>');
    //     }  
    // } else {
    //     echo('<option value="">Veuillez selectionner une optons</option>');
    // }
    // echo('</select>');
    echo('</response>');

?>