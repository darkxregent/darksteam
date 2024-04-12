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
    echo('<label for="playlist"> Vos Playlist</label>');
    echo('<select  name="playlist" id="playlist">');
    if ($id_opts != 0) {
        
        $reqpl = "SELECT * FROM playlists WHERE id_user = ? AND id_opt = ?";
        $selectpl = $bdd -> prepare($reqpl);
        $selectpl -> execute(array($_SESSION['id_user'], $id_opts));
        $set_plx = $selectpl -> fetchall();
        if(count($set_plx) > 0) {
            echo('<option value="">Aucune Playlists selectionner</option>');
            for ($a=0; $a < count($set_plx); $a++) {
                $idplx = $set_plx[$a]['id_plx'];
                $plx = $set_plx[$a]['plx'];
                
                echo("<option value='$idplx'>$plx</option>");
            }
        }else{
            echo('<option value="">Veuillez cree un nouveau Playlist</option>');
        }  
    } else {
        echo('<option value="">Veuillez selectionner une optons</option>');
    }
    echo('</select>');
    echo('</response>');

?>
