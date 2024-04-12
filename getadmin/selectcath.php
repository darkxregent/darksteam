<?php
require('../action/act.php');
    header("Content-Type: text/xml");

    echo('<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>');

    echo('<response 
    style="
    display: flex;
    flex-direction: column;
    margin: 0px 10px;
    width: 100%;
    gap: 12px;">');

    $id_opts = $_POST['options'];
    echo('<label for="cath">Les Cathegories</label>');
    echo('<select class="cath" name="cath" id="cath">');
    if ($id_opts != 0) {
        
        $reqcath = "SELECT * FROM cathegories WHERE id_opt = ?";
        $selectcath = $bdd -> prepare($reqcath);
        $selectcath -> execute(array($id_opts));
        $set_cath = $selectcath -> fetchall();

        if(count($set_cath) > 0) {
            echo('<option value="">Aucune cathegories selectionner</option>');
            for ($a=0; $a < count($set_cath); $a++) {
                $id_cath = $set_cath[$a]['id_cath'];
                $cath = $set_cath[$a]['cath'];
                
                echo("<option value='$id_cath'>$cath</option>");
            }
        }else{
            echo('<option value="">Cette options est invalide</option>');
        }  
    } else {
        echo('<option value="">Veuillez selectionner une optons</option>');
    }
    echo('</select>');
    echo('</response>');

?>
