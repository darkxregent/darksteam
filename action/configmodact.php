<?php
require('act.php');

$success = 0;
$modif = "echec de le modification des information \n
    Veuillez réessayer puis tars";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $str_id = analyse($_POST['id_str']);
    if (!empty($_POST['titres']) AND !empty($_POST['agx']) AND 
    !empty($_POST['tagx']) AND !empty($_POST['optx']) AND !empty($_POST['cathx'])) {
        $str_tirx = analyse($_POST['titres']);
        $str_agx = analyse($_POST['agx']);
        $str_descr = analyse($_POST['descr']);
        $str_tagx = analyse($_POST['tagx']);
        $str_optx = analyse($_POST['optx']);
        $str_cath = analyse($_POST['cathx']);


        $srqm = "UPDATE stream SET id_cath = ? , titres = ? , agences = ? , descr = ? , tages = ?  WHERE id_stream = ?";
        $modifcath = $bdd -> prepare($srqm);
        $modifcath  -> execute(array($str_cath ,$str_tirx, $str_agx, $str_descr, $str_tagx, $str_id));
            
        $success = 1;
        $modif =$str_id; 
    }
    

    $respx = ["success" => $success , "modif" => $modif];
    echo json_encode($respx);
}


?>
