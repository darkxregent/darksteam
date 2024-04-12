<?php
require('act.php');

$id_user = $_SESSION['id_user'];

$success = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_FILES['upfiles']) && $_FILES['upfiles']['error'] == 0 && !empty($_POST['times'])) {
            if ( !empty($_POST['playlist'])) {
                $pl = analyse($_POST['playlist']);
                if (is_numeric($pl)) {
                    $id_plx = $pl;
                }else {
                    $reqpl = "INSERT INTO playlist(id_user, plx) VALUES(?,?)";
                    $setpl = $bdd -> prepare($reqpl);
                    $setpl -> execute(array($id_user, $pl));


                    $id_plx = $bdd -> lastInsertId("id_plx");
                }
            }else{
                $id_plx = 0;
            }

           if (!empty($_POST['titres']) AND !empty($_POST['agences'])
            AND !empty($_POST['options']) AND !empty($_POST['cath'])
             AND !empty($_POST['tages']) AND !empty($_POST['descr'])) {
                if (isset($_FILES['couver']) && $_FILES['couver']['error'] == 0) {

                    $senderreur = "error du php";

                    // deplace les les fichiles
                    $filesdirf = '../filesdir/upfiles/';
                    $filesnamef = basename($_FILES['upfiles']['name']);
                    $extf =  pathinfo($filesnamef, PATHINFO_EXTENSION);
                    $romdfilesnamef = uniqid().'.'.$extf;
                    $cheninfiles = $filesdirf .$romdfilesnamef;
                    $files = move_uploaded_file($_FILES['upfiles']['tmp_name'] , $cheninfiles);

                    $filesdiri = '../filesdir/couvers/';
                    $filesnamei = basename($_FILES['couver']['name']);
                    $exti =  pathinfo($filesnamei, PATHINFO_EXTENSION);
                    $romdfilesnamei = uniqid().'.'.$exti;
                    $chenincouver = $filesdiri .$romdfilesnamei;
                    $couver = move_uploaded_file($_FILES['couver']['tmp_name'] , $chenincouver);

                    $filesNames = $romdfilesnamef;
                    $filesize = $_FILES['upfiles']['size'];
                    $couverName = $romdfilesnamei;
                    
                    $titre = analyse($_POST['titres']);
                    $ag = analyse($_POST['agences']);
                    $op = analyse($_POST['options']);
                    $cath = analyse($_POST['cath']);
                    $tg = analyse($_POST['tages']);
                    $descr = analyse($_POST['descr']);
                    $tx = analyse($_POST['times']);
                    $date = time();

                    $reqsend = "INSERT INTO stream(
                        id_user, id_opt, id_cath, id_plx, titres, agences, descr, tages, upfiles,
                        couvers, size, times, date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $sendalls = $bdd -> prepare($reqsend);
                    $sendalls -> execute(array(
                        $id_user, $op, $cath, $id_plx, $titre, $ag, $descr, $tg, $filesNames,
                        $couverName, $filesize, $tx, $date));

                    if ($sendalls) {
                        $success = 1;
                        $senderreur = "Votres videos a été publier veuillez
                         attendres la verification des information";
                    }
                        
                }
                else{
                    $senderreur = "Veiller choisires une images de couvertures";

                }
            
           }else{
            $senderreur = "Veiller remplires touts les champs de la 2eme parties";
           }
        }
        else{
            $senderreur = "Veillez slectionner une videos dans la 1er Parties";
        }

        
    $respx = ["success" => $success , "senderreur" => $senderreur];
    echo json_encode($respx);
    }


?>