<?php
    $Npages = isset($_GET['pages']) ? $_GET['pages'] : 1;

if (!isset($_GET['cath']) OR $_GET['cath'] == 0) {
    $reqcx = "SELECT * FROM stream WHERE id_opt = ?";
    $setcox = $bdd -> prepare($reqcx);
    $setcox -> execute(array($id_opt));
    $set_cox = $setcox -> fetchall();

    $coutTotale = count($set_cox);
    $parPages = 28;
    $nbrPages = ceil($coutTotale / $parPages);
    if ($Npages == 0) {
        $Npages ++;
    }
    elseif ($Npages == $nbrPages+1) {
        $Npages = 1;
    }
    $debut = ($Npages - 1) * $parPages;




    $reqx = "SELECT * FROM stream WHERE id_opt = ? LIMIT $debut , $parPages";
    $setopt = $bdd -> prepare($reqx);
    $setopt -> execute(array($id_opt));
    $set_stopt = $setopt -> fetchall();
}else{

    $id_cath = $_GET['cath'];
    $reqcx = "SELECT * FROM stream WHERE id_cath = ?";
    $setcox = $bdd -> prepare($reqcx);
    $setcox -> execute(array($id_cath));
    $set_cox = $setcox -> fetchall();

    $coutTotale = count($set_cox);
    $parPages = 28;
    $nbrPages = ceil($coutTotale / $parPages);
    if ($Npages == 0) {
        $Npages ++;
    }
    elseif ($Npages == $nbrPages+1) {
        $Npages = 1;
    }
    $debut = ($Npages - 1) * $parPages;

    $id_cath = $_GET['cath'];
    $reqx = "SELECT * FROM stream WHERE id_cath = ? LIMIT $debut , $parPages";
    $setopt = $bdd -> prepare($reqx);
    $setopt -> execute(array($id_cath));
    $set_stopt = $setopt -> fetchall();
}
?>