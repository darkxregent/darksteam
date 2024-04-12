<?php
require('act.php');

$id_user = $_SESSION['id_user'];
$success = 0;

function setRandId(){
    $rand1 = sprintf("%04d", rand(0, 9999));
    $rand2 = sprintf("%04d", rand(0, 9999));
    $rand3 = sprintf("%04d", rand(0, 9999));
    
    $allrandid = "$rand1-$rand2-$rand3";
    return $allrandid; 
}

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_str = setRandId();
        if (isset($_FILES['upfiles']) && $_FILES['upfiles']['error'] == 0 && !empty($_POST['times'])) {

            if (!empty($_POST['playlist']) ) {
                $id_plx = analyse($_POST['playlist']);
            }else{
                if (!empty($_POST['options'])) {
                    $op = analyse($_POST['options']);
                    if (!empty($_POST['cree_plx'])){
                        $pl = analyse($_POST['cree_plx']);
                        $reqplx = "SELECT * FROM playlists WHERE id_user = ? AND id_opt = ? AND plx = ?";
                        $selpl = $bdd -> prepare($reqplx);
                        $selpl -> execute(array($id_user, $op, $pl));
                        $setplx = $selpl -> fetchall();
                        if (count($setplx) == 0) {
                            $reqpl = "INSERT INTO playlists(id_user , id_opt , plx) VALUES(?,?,?)";
                            $setpl = $bdd -> prepare($reqpl);
                            $setpl -> execute(array($id_user, $op , $pl));

                            $id_plx = $bdd -> lastInsertId("id_plx");
                        }else {
                            $id_plx = $setplx[0]['id_plx'];
                        }
                    }else {
                        $id_plx = 0;
                    }
                }else{
                    $senderreur = "veuillez choisires une option pour spesialiser votres videos";
                }
                
            }

           if (!empty($_POST['titres']) AND !empty($_POST['agences'])
            AND !empty($_POST['options']) AND !empty($_POST['cath'])
             AND !empty($_POST['tages']) AND !empty($_POST['descr'])) {
                if (isset($_FILES['couver']) && $_FILES['couver']['error'] == 0 || !empty($_POST['mycanvas'])) {

                    $senderreur = "error du au niveux du serveures";

                    // deplace les les fichiles
                    $filesdirf = "../filesdir/upfiles/";
                    $filesnamef = basename($_FILES['upfiles']['name']);
                    $extf =  pathinfo($filesnamef, PATHINFO_EXTENSION);
                    $romdfilesnamef = 'str_'.uniqid().'.'.$extf;
                    $cheninfiles = $filesdirf .$romdfilesnamef;
                    $files = move_uploaded_file($_FILES['upfiles']['tmp_name'] , $cheninfiles);

                    $filesdiri = "../filesdir/couvers/";

                    if (isset($_FILES['couver'])  && $_FILES['couver']['error'] === 0) {
                        $filesnamei = basename($_FILES['couver']['name']);
                        $exti =  pathinfo($filesnamei, PATHINFO_EXTENSION);
                        $romdfilesnamei = uniqid().'.'.$exti;
                        $chenincouver = $filesdiri .$romdfilesnamei;
                        $couver = move_uploaded_file($_FILES['couver']['tmp_name'] , $chenincouver);
                    }else {
                        $mycavx = analyse($_POST['mycanvas']);
                        $romdfilesnamei = $mycavx;
                    }
                    
                    

                    $filesNames = $romdfilesnamef;
                    $filesize = $_FILES['upfiles']['size'];
                    $couverName = $romdfilesnamei;
                    
                    $title = analyse($_POST['titres']);
                    $titre = htmlspecialchars($title);
                    $ag = analyse($_POST['agences']);
                    $op = analyse($_POST['options']);
                    $cath = analyse($_POST['cath']);
                    $tag = analyse($_POST['tages']);
                    $descr = analyse($_POST['descr']);
                    $tx = analyse($_POST['times']);
                    $date = time();
                    $tg = $tag.','.$title;

                    $reqsend = "INSERT INTO stream(
                        id_stream, id_user, id_opt, id_cath, id_plx, titres, agences, descr, tages, upfiles,
                        couvers, size, times, date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $sendalls = $bdd -> prepare($reqsend);
                    $sendalls -> execute(array(
                        $id_str, $id_user, $op, $cath, $id_plx, $titre, $ag, $descr, $tg, $filesNames,
                        $couverName, $filesize, $tx, $date));

                    
                    $success = 1;
                    $senderreur = "Votres videos a été publier veuillez
                         attendres la verification des information";
                    
                        
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