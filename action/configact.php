<?php
$dirx = $domainhost."/filesdir/";
$id_str = $_GET['str'];
$reqt = "SELECT * FROM stream WHERE id_stream = ?";
$selstream = $bdd -> prepare($reqt);
$selstream -> execute([$id_str]);
$allstream = $selstream -> fetch();


$id = $allstream['id_stream'];
$str_titres = $allstream['titres'];
$str_id_opt = $allstream['id_opt'];
$str_id_cath = $allstream['id_cath'];
$str_id_plx = $allstream['id_plx'];
$str_agx = $allstream['agences'];
$str_desx = $allstream['descr'];
$str_tagx = $allstream['tages'];
$files = $dirx.'upfiles/'.$allstream['upfiles'];
$couver = $dirx.'couvers/'.$allstream['couvers'];

$reqtx = "SELECT * FROM options WHERE id_opt = ?";
$optstream = $bdd -> prepare($reqtx);
$optstream -> execute([$str_id_opt]);
$opstream = $optstream -> fetch();
$opt = $opstream['opts'];

$reqcx = "SELECT * FROM cathegories WHERE id_opt = ?";
$catlstream = $bdd -> prepare($reqcx);
$catlstream -> execute([$str_id_opt]);
$acthstream = $catlstream -> fetchall();

if ($str_id_plx) {
    $reqx = "SELECT * FROM playlists WHERE id_plx = ?";
    $pxstream = $bdd -> prepare($reqx);
    $pxstream -> execute([$str_id_plx]);
    $plxstream = $pxstream -> fetch();
    $plx_name = $plxstream['plx'];
}

?>