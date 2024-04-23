<?php
require('../action/act.php');
require('../action/statact.php');
require('../includes/headerx.php');
if (isset($_GET['setid'])) {
    $_SESSION['id_stat'] = $_GET['setid'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$domainhost?>/asset/statstylE.css">
    <?php
        if ($ismobiles) {
        ?>
        <style>
            .sous_op{
                flex-direction: row;
                justify-content: space-evenly;
                align-items: center;
                width: 100vw;
                margin-top: 0;
            }
            .dark_content{
                position: relative;
                left: 0;
                top: 50px;
                width: 100vw;
                height: calc(100vh - 98px);
                overflow: auto;
                overflow-x: hidden;
            }

        </style>
        <?php
        }
    ?>

    <title>statuts</title>
</head>
<body>
    <?php
    
        $id = $_SESSION['id_user'];
        $atr = $setmyuser['avatar'];
        $ps = $setmyuser['pseudo'];
        $el = $setmyuser['email'];
        $ag = $setmyuser['ages'];
        $gr = $setmyuser['genre'];

        $nbrvx = $bdd -> prepare("SELECT * FROM stream WHERE id_user = ? ");
        $nbrvx -> execute([$_GET['setid']]);
        $nbrvxx = $nbrvx -> fetchall();
        $countx = count($nbrvxx); 
    ?>



<section class="dark_content">
    <main class="menu_stat">
        <div class="head_prof">
            <img src="<?=$domainhost?>/filesdir/avatares/<?=$atr?>" class="profil_svg"  alt="">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 -960 960 960" class="camera_svg">
                <path d="M451.385-590.769h329.23q-26.23-70.539-83.653-124.654Q639.538-769.538 566-788L451.385-590.769Zm-82.77
                 80L534.769-796q-11-2-27.384-3Q491-800 480-800q-66 0-123 25t-101 67l112.615 197.231ZM170-400h227.231L234.154-683.692q-35.077
                  43.307-54.616 94.346Q160-538.308 160-480q0 21 2.5 40.5T170-400Zm225.538 228 114.154-197.231H179.385q26.23 70.539 84.423
                   124.654Q322-190.462 395.538-172ZM480-160q66 0 123-25t101-67L591.385-449.231 426.769-165.538q11 2.769 26.116 4.153Q468-160
                    480-160Zm245.846-116.308q32-41 53.077-94.346Q800-424 800-480q0-21-2.5-40.5T790-560H562.769l163.077 283.692ZM480-480Zm0
                     360q-74.308 0-140-28.423t-114.423-77.154Q176.846-274.308 148.423-340 120-405.692 120-480q0-74.539 28.423-140.115
                      28.423-65.577 77.154-114.308Q274.308-783.154 340-811.577 405.692-840 480-840q74.539 0 140.115 28.423 65.577 28.423
                       114.308 77.154 48.731 48.731 77.154 114.308Q840-554.539 840-480q0 74.308-28.423 140t-77.154 114.423q-48.731 48.731-114.308
                        77.154Q554.539-120 480-120Z"/></svg>
        </div>
        <div class="dark_info_menu">
            <div class="info_menu">
                <h2 class="psd"><span><?=$ps?></span> <span class="modif">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" fill="#fff" width="32" alt="modifier votre status">
                        <path d="M240-280h480v-120H240v120Zm-80 120q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33
                         0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z"/></svg>
                </span></h2>
                <div>
                    <?php 
                    if ($id == $_GET['setid']) {
                    ?>
                    <span class="obntt"><?=$allabn?></span>
                    <span> <?=$countx?> videos</span>
                    <?php
                    }
                    else{
                        if (count($setabn) == 0) {
                           
                        
                    ?>
                        <form class="formabn" method="post">
                            <button type="submit" class="abn" name="getabn"> s'abonner</button>
                        
                        </form>    
                    <?php
                        }
                        else {
                        ?> 
                        <span class="obntt"><?=$allabn?></span>  
                        <form class="formabn" method="post">
                                
                                <button type="submit" class="abn" name="revabn">Se désabonner</button>
                            </form>
                        <?php
                        
                        
                            
                        }
                    }
                    ?>
                </div>
            </div>
            <ul class="stat_list">
                <a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_stat'];?>-setid-vdx-setx" ><li>Vidios</li></a>
                <a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_stat'];?>-setid-plx-setx" ><li>Playliste</li></a>
                <a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_stat'];?>-setid-nwx-setx" ><li>News</li></a>
                
            </ul>
        </div>
        



        <div class="semi-modcard avatar">
        <svg xmlns="http://www.w3.org/2000/svg" class="clossing" id="closse" height="24" fill="#9b9b9b" viewBox="0 -960 960 960" width="24">
            <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
             56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
              0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
               0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"></path></svg>

            <div class="content_avatar">
                <img src="<?=$domainhost?>/filesdir/avatares/<?=$atr?>" alt="l'images du profile" srcset="">
            </div>   
            <form action="" method="post" class="mod_avx" enctype="multipart/form-data">
                <input type="file" name="avx" id="avx" accept="image/*" required>
                <input type="button" class="btn_avx" value="Modifier">
            </form>    
        </div>


        <div class="semi-modcard modif">
        <svg xmlns="http://www.w3.org/2000/svg" class="clossed" id="closse" height="24" fill="#9b9b9b" viewBox="0 -960 960 960" width="24">
            <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
             56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
              0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
               0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"></path></svg>

            <div class="content_modif">
                <h3 class="stat_title">My Status</h3>
                <form action="" method="post">
                    <label for="pseudo">Modifier votre Pseudo</label>
                    <div class="semi_content">
                       <input class="ipform" type="text" name="pseudo" id="pseudo" value="<?=$ps?>" required>
                       <input type="button" value="Modifier"> 
                    </div>
                    
                </form>

                <form action="" method="post">
                    <label for="email">Modifier votre Email</label>
                    <div class="semi_content">
                       <input class="ipform" type="email" name="email" id="email" value="<?=$el?>" required>
                       <input type="button" value="Modifier"> 
                    </div>
                </form>
                
                <form action="" method="post">
                    <label for="password">Modifier votre Password</label>
                    <div class="demi_content">
                        <input type="password" name="pass_1" id="password" placeholder="inseret votre nouveau mots de pass" required>
                        <input type="password" name="pass_2" id="password" placeholder="confirmer le mots de pass " required>
                       <input type="button" value="Modifier"> 
                    </div>
                </form>
            </div>
        </div>
        
    </main>
    
    


    
    <?php
        if (isset($_GET['setx'])) {
            echo($_GET['setx']);
            if ($_GET['setx'] == "vdx") {
            ?>
            #my videos
            <ul class="videos_content">
                <?php
                for ($i=0; $i < count($opx); $i++) { 
                ?>
                    <li class="video_dx">
                        <div class="barx">
                            <span><?=$opx[$i]['opts'] ?>(<?=$coutvidx[$i]?>)</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" class="svg_open" fill="#fff" width="24">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 -960 960 960" class="svg_close" fill="#fff" width="14">
                                    <path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"/></svg>
                        </div>
                        <ul class="nini_content">
                        <?php 
                        for ($a=0; $a < $coutvidx[$i]; $a++) { 
                        ?>
                            <li class="video_card">
                                <a href="<?=$domainhost?>/xplays?stream=<?=$id_str[$i][$a]?>">
                                    <video src="<?=$domainhost?>/filesdir/upfiles/<?=$upx[$i][$a]?>" poster="<?=$domainhost?>/filesdir/couvers/<?=$cvx[$i][$a]?>" class="plays_vdx"></video>
                                </a>
                                <div class="ifo_content">
                                    <p><?=$trix[$i][$a].''.$opx[$i]['id_opt']?></p>
                                    <p><?=$vues[$i][$a]?> vues  :::  <?=$times?></p>
                                    <p></p>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        </ul>
                    </li>
                
                <?php
                }
                ?>
            </ul>
            <?php
            }elseif ($_GET['setx'] == "plx") {
            ?>
                my playliste
                <div class="content_plx">
                    <div class="plx_card">
                        <img src="<?=$domainhost?>/filesdir/avatares/<?=$atr?>" alt="">
                    </div>
                    <div class="content_info_plx">
                        <div class="plx_info">
                            <h3>NOM DU PLX</h3>
                            <h4>NBR DE VIFEOS DU PLX</h4>
                        </div>
                        <div class="option_plx">
                            <button type="button">Modifier</button>
                            <button type="button">Suprime</button>
                        </div>
                        
                    </div>
                    <div class="open_plx">
                        <svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 -960 960 960" class="svg_close" fill="#fff" width="14">
                            <path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"></path></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 -960 960 960" class="svg_close" fill="#fff" width="14">
                            <path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"></path></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 -960 960 960" class="svg_close" fill="#fff" width="14">
                            <path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"></path></svg>
                    </div>    
                </div>
            <?php
            }elseif ($_GET['setx'] == "nwx") {
            ?>
                the news of may shaine
            <?php
            }elseif ($_GET['setx'] == "statqx") {
            ?>
                the tratistique 
            <?php
            }
        }
        elseif (!isset($_GET['setx']) && $_SESSION['id_user'] == $_GET['setid']) {
            # code...
        ?>
            <table class="tabl_bors">
                    <thead>
                        <th colspan="6">TABLEAUX DE BORES</th>
                    </thead>
                    <tr>
                        <th> Les options</th>
                        <th>N° de Videos</th>
                        <th>Vues</th>
                        <th>Likes</th>
                        <th>Eaters</th>
                    </tr>
                <?php
                $allnbr = $bdd -> prepare("SELECT * FROM stream WHERE id_user = ?");
                $allnbr -> execute([$_GET['setid']]);
                $countall = $allnbr -> fetchall();

                $reqxv = "SELECT SUM(vues) AS vx FROM vues_str WHERE id_user = ?";
                $countv = $bdd -> prepare($reqxv);
                $countv -> execute([$_GET['setid']]);
                $allcount = $countv -> fetch();

                $reqlk = "SELECT SUM(likes) AS lkx FROM likes_str WHERE id_user = ?";
                $countlk = $bdd -> prepare($reqlk);
                $countlk -> execute([$_GET['setid']]);
                $allcountlx = $countlk -> fetch();

                $reqea = "SELECT SUM(eaters) AS eax FROM likes_str WHERE id_user = ?";
                $countea = $bdd -> prepare($reqea);
                $countea -> execute([$_GET['setid']]);
                $allcounteax = $countea -> fetch();
                for ($x = 0; $x < count($set_opt); $x++) { 
                    $id_opt = $set_opt[$x]['id_opt'];

                    $reqnbr = "SELECT * FROM stream WHERE id_opt = ? AND id_user = ?";
                    $selectnbr = $bdd -> prepare($reqnbr);
                    $selectnbr -> execute([$id_opt, $_GET['setid']]);
                    $nbr_set = $selectnbr -> fetchall();
                    $countopt[$x] = count($nbr_set);

                    $reqv = "SELECT SUM(vues) AS al FROM vues_str WHERE id_opt = ? AND id_user = ?";
                    $selectv = $bdd -> prepare($reqv);
                    $selectv -> execute(array($id_opt, $_GET['setid']));
                    $vues_set[$x] = $selectv -> fetch();
                    $allvues[$x] = $vues_set[$x]['al'];
                    if (!$allvues[$x]) {
                        $allvues[$x] = 0;
                    }

                    $reqlkx = "SELECT SUM(likes) AS allkx FROM likes_str WHERE id_opt = ? AND id_user = ?";
                    $selectlk = $bdd -> prepare($reqlkx);
                    $selectlk -> execute(array($id_opt, $_GET['setid']));
                    $lk_set[$x] = $selectlk -> fetch();
                    $alllkx[$x] = $lk_set[$x]['allkx'];
                    if (!$alllkx[$x]) {
                        $alllkx[$x] = 0;
                    }

                    $reqeax = "SELECT SUM(eaters) AS aleax FROM likes_str WHERE id_opt = ? AND id_user = ?";
                    $selectea = $bdd -> prepare($reqeax);
                    $selectea -> execute(array($id_opt, $_GET['setid']));
                    $ea_set[$x] = $selectea -> fetch();
                    $alleax[$x] = $ea_set[$x]['aleax'];
                    if (!$alleax[$x]) {
                        $alleax[$x] = 0;
                    }
                
                ?>
                    <tr>
                        <th><?=$set_opt[$x]['opts']?></th>
                        <td><?=$countopt[$x]?></td>
                        <td><?=$allvues[$x]?></td>
                        <td><?=$alllkx[$x]?></td>
                        <td><?=$alleax[$x]?></td>
                    </tr>
                <?php
                }
                ?>

                </table>
                <table class="tabl_bors">
                <tr>
                        <th>TOTAL</th>
                        <td><?=count($countall)?></td>
                        <td><?=$allcount['vx']?></td>
                        <td><?=$allcountlx['lkx']?></td>
                        <td><?=$allcounteax['eax']?></td>
                    </tr>
            </table>

        <?php
        }
        else {
        ?>
            content for all my vido publications 
            <ul class="videos_content">
                <?php
                for ($i=0; $i < count($opx); $i++) { 
                ?>
                    <li class="video_dx">
                        <div class="barx">
                            <span><?=$opx[$i]['opts'] ?>(<?=$coutvidx[$i]?>)</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" class="svg_open" fill="#fff" width="24">
                                <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 -960 960 960" class="svg_close" fill="#fff" width="14">
                                    <path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"/></svg>
                        </div>
                        <ul class="nini_content">
                        <?php 
                        for ($a=0; $a < $coutvidx[$i]; $a++) { 
                        ?>
                            <li class="video_card">
                                <a href="<?=$domainhost?>/xplays?stream=<?=$id_str[$i][$a]?>">
                                    <video src="<?=$domainhost?>/filesdir/upfiles/<?=$upx[$i][$a]?>" poster="<?=$domainhost?>/filesdir/couvers/<?=$cvx[$i][$a]?>" class="plays_vdx"></video>
                                </a>
                                <div class="ifo_content">
                                    <p><?=$trix[$i][$a].''.$opx[$i]['id_opt']?></p>
                                    <p><?=$vues[$i][$a]?> vues  :::  <?=$times?></p>
                                    <p></p>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        </ul>
                    </li>
                
                <?php
                }
                ?>
            </ul>
        <?php
        }
    ?>


    
</section>

<script>






    const svgOpen = document.querySelectorAll('.svg_open');
    const svgClose = document.querySelectorAll('.svg_close');
    const barx = document.querySelectorAll('.barx');
    var touchex = true;

    svgOpen.forEach(svgelx => {
        const prexent = svgelx.parentNode;
        svgelx.addEventListener('click', () => OpenSectionUl(prexent)); // Correction ici
    });

    svgClose.forEach(svgely => {
        const prexing = svgely.parentNode;
        svgely.addEventListener('click', () => OpenSectionUl(prexing)); // Correction ici
    });

    document.querySelectorAll('.barx').forEach((cliked) => {
        cliked.addEventListener('click' , () => OpenSectionUl(cliked));

    });

    function OpenSectionUl(param){
        if (touchex) {
            param.querySelector('.svg_open').style.display='block';
            param.querySelector('.svg_close').style.display='none';
            const parx = param.parentNode;
            elex = parx.querySelector('.nini_content');
            elex.style.display='inline-flex';
            touchex = false;
        }else{
            param.querySelector('.svg_open').style.display='none';
            param.querySelector('.svg_close').style.display='block';
            const parx = param.parentNode;
            elex = parx.querySelector('.nini_content');
            elex.style.display='none';
            touchex = true;
        }

    }


    




    var desc = document.querySelector('.descox');

    desc.addEventListener('click', () => {
        var xhrx = new XMLHttpRequest();
        xhrx.open('POST', '../../async/descox.php', true);
        xhrx.onreadystatechange = function(){
            console.log(xhrx);
            if (xhrx.readyState == 4 && xhrx.status == 200) {
                var repx = xhrx.response;
                console.log(repx);
                if (repx.success) {
                    window.location.href = "../../index.php";
                }
            }
            else if(xhrx.readyState == 4){
                console.log('eurror systeme ');
            }  
        };

        xhrx.responseType = "json";
        xhrx.send();
    });





    const btnModavx = document.querySelector('.camera_svg');
    btnModavx.addEventListener('click' ,() => {
        document.querySelector('.semi-modcard.avatar').classList.toggle('actif');
        document.querySelector('.semi-modcard.modif').classList.remove('actif');
    });
    document.querySelector('.clossing').addEventListener('click' ,() => {
        document.querySelector('.semi-modcard.avatar').classList.remove('actif');
    });


    const btnMod = document.querySelector('.modif');
    btnMod.addEventListener('click' ,() => {
        document.querySelector('.semi-modcard.modif').classList.toggle('actif');
        document.querySelector('.semi-modcard.avatar').classList.remove('actif');
    });
    document.querySelector('.clossed').addEventListener('click' ,() => {
        document.querySelector('.semi-modcard.modif').classList.remove('actif');
    });


</script>


</body>
</html>