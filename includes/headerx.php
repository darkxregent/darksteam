<?php
    $domainhost = 'http://'.$_SERVER['HTTP_HOST'];
    $ismobiles = strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"mobile");
    if (!isset($_SESSION['auth'])) {
        header('location: '.$domainhost.'/compte/login.php'); 
    }
    
    if ($_SESSION['auth']) {
        $id_user = $_SESSION['id_user'];

        $resq = "SELECT * FROM abnt WHERE id_user = ?";
        $selectabn = $bdd -> prepare($resq);
        $selectabn -> execute(array($id_user));
        $set_abn = $selectabn -> fetchall();
    }
        $reqopt = "SELECT * FROM options ORDER BY id_opt ASC";
        $selectopt = $bdd -> prepare($reqopt);
        $selectopt -> execute();
        $set_opt = $selectopt -> fetchall();

        $reqnotif = "SELECT * FROM notifications WHERE id_user = ? ORDER BY id_notf DESC";
        $selectnotif = $bdd -> prepare($reqnotif);
        $selectnotif -> execute(array($_SESSION['id_user']));
        $set_notif = $selectnotif -> fetchall();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$domainhost?>/asset/aLlcss.css">
    <?php
    if ($ismobiles) {
    ?>
    <link rel="stylesheet" href="<?=$domainhost?>/asset/mobilequery.css">
    <?php
    }
    ?>
</head>
<body>
<header>
    <nav class="dark_menu">
        <nav class="menu_nav">
            <h1><a href="<?=$domainhost?>/index" class="title_link"><img src="<?=$domainhost?>/darck_logo.png" class="logo"  alt="logo de DarkStream" margin-right="7"><span class="domx-name">DarkStream</span> </a></h1>
            <form  method="GET"  action="<?=$domainhost?>/searsh"  class="searching">
                <input type="search" name="q" class="super_search" placeholder="Recherch ...">
                <button type="submit" class="btn_search">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="svg_search">
                        <path d="M794-96 525.787-364Q496-341.077 457.541-328.038 419.082-315 373.438-315q-115.311
                        0-193.875-78.703Q101-472.406 101-585.203T179.703-776.5q78.703-78.5 191.5-78.5T562.5-776.356Q641-697.712
                        641-584.85q0 45.85-13 83.35-13 37.5-38 71.5l270 268-66 66ZM371.441-406q75.985 0 127.272-51.542Q550-509.083
                        550-584.588q0-75.505-51.346-127.459Q447.309-764 371.529-764q-76.612 0-128.071
                            51.953Q192-660.093 192-584.588t51.311 127.046Q294.623-406 371.441-406Z"/>
                    </svg>
                </button>
            </form>
            
            <ul class="if_connet" >

                <h3 class="icone_notifx">
                    <svg xmlns="http://www.w3.org/2000/svg" height="35" fill="white" style="rotate: 12deg;" viewBox="0 -960 960 960" width="40">
                    <path d="M180.001-204.616v-59.998h72.308v-298.463q0-80.692 49.807-142.692 49.808-62 127.885-79.307v-24.923q0-20.833 14.57-35.416 14.57-14.584 35.384-14.584t35.429
                    14.584q14.615 14.583 14.615 35.416v24.923q78.077 17.307 127.885 79.307 49.807 62 49.807 142.692v298.463h72.308v59.998H180.001ZM480-497.692Zm-.068 405.383q-29.855
                    0-51.047-21.24-21.192-21.24-21.192-51.067h144.614q0 29.923-21.26 51.115-21.26 21.192-51.115 21.192ZM312.307-264.614h335.386v-298.463q0-69.462-49.116-118.577Q549.462-730.77
                    480-730.77q-69.462 0-118.577 49.116-49.116 49.115-49.116 118.577v298.463Z"/></svg></a></h3>


                <h3 ><a href="<?=$domainhost?>/send?h">

                    
                    <svg xmlns="http://www.w3.org/2000/svg" height="40" class="svg_upfie" viewBox="0 -960 960 960" width="44">
                    <path d="M460-300h40v-160h160v-40H500v-160h-40v160H300v40h160v160Zm20.134 180q-74.673 0-140.41-28.339-65.737-28.34-114.365-76.922-48.627-48.582-76.993-114.257Q120-405.194
                    120-479.866q0-74.673 28.339-140.41 28.34-65.737 76.922-114.365 48.582-48.627 114.257-76.993Q405.194-840 479.866-840q74.673 0 140.41 28.339 65.737 28.34 114.365 76.922 48.627
                    48.582 76.993 114.257Q840-554.806 840-480.134q0 74.673-28.339 140.41-28.34 65.737-76.922 114.365-48.582 48.627-114.257 76.993Q554.806-120 480.134-120ZM480-160q134
                    0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></a></h3>

                <h3 class="avatar"><a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_user'];?>-setid"><img src="<?=$domainhost?>/filesdir/avatares/<?=$_SESSION['avatar'];?>" alt=""></a></h3>
            </ul>
        </nav>

    
        <nav class="menu_op">
            <?php
            if (!isset($_GET['setid'])) {
            ?>
            <h2 class="opt">
                <svg xmlns="http://www.w3.org/2000/svg" class="svg_op" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="M40-80v-360h240v360H40Zm320 0v-360h240v360H360Zm320 0v-360h240v360H680Zm-240-80h80v-200h-80v200ZM40-520v-360h240v360H40Zm320
                    0v-360h240v360H360Zm320 0v-360h240v360H680Zm-560-80h80v-200h-80v200Zm640 0h80v-200h-80v200Z"/></svg>
            </h2>
            
            <ul class="op_list">
            
            <a class="hd_list_a" href="index"><li class="hd_list"><?=$opts?></li></a>
            <?php
            
                $resqcath = "SELECT * FROM cathegories WHERE id_opt = ?";
                $selectcath = $bdd -> prepare($resqcath);
                $selectcath -> execute(array($id_opt));
                $set_cath = $selectcath -> fetchall();
            for ($y=0; $y < count($set_cath) ; $y++) { 
                $id_cath = $set_cath[$y]['id_cath'];
                $cath = $set_cath[$y]['cath'];


                $res = "SELECT * FROM stream WHERE id_cath = ?";
                $cathx = $bdd -> prepare($res);
                $cathx -> execute(array($id_cath));
                $setcath = $cathx -> fetchall();
                if (count($setcath) != 0) {
                
                
            ?>
                <a href="index-<?=$id_cath?>cath"><li><?=$cath?></li></a>
            <?php
                }
            }
            }
            ?>
            <li class="op_scroll"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26">
                <path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"/></svg></li>
            </ul>
        </nav>
    
    <?php
        if (isset($_GET['setid']) && $id_user == $_GET['setid']) {
            
        ?>
                <ul class="option_nav">
            <ul class="sous_op">
                <li><a href="<?=$domainhost?>/index" class="svg_hdx">
                    <svg xmlns="http://www.w3.org/2000/svg" class="option_svg" viewBox="0 -960 960 960" >
                        <path d="M229-189h127v-257h249v257h126v-377L480-754 229-566.333V-189Zm-91
                        91v-514l342-257 343 257v514H525v-268h-89v268H138Zm342-374Z"/>
                    </svg>
                    <span>Acceuil</span> </a></li>
    
                    <li><a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_user'];?>-setid">
                    <svg xmlns="http://www.w3.org/2000/svg" class="option_svg" viewBox="0 -960 960 960" >
                        <path d="M400-492.309q-57.749 0-98.874-41.124-41.125-41.125-41.125-98.874 0-57.75
                         41.125-98.874 41.125-41.125 98.874-41.125 57.749 0 98.874 41.125 41.125 41.124
                          41.125 98.874 0 57.749-41.125 98.874-41.125 41.124-98.874 41.124ZM100.001-187.694v-88.922q0-30.307
                           15.462-54.884 15.461-24.576 43.153-38.038 49.847-24.846 107.692-41.5Q324.154-427.691
                            400-427.691h11.692q4.846 0 10.462 1.23-6.077 14.154-10.039 28.846-3.961 14.692-6.576
                             29.922H400q-69.077 0-122.307 15.885-53.231 15.884-91.539 35.807-13.615 7.308-19.885
                              17.077-6.269 9.77-6.269 22.308v28.923h252q4.461 15.23 11.577 30.922 7.115 15.692
                               15.653 29.077H100.001Zm544.23 29.614-8.923-53.076q-14.308-4.231-26.923-11.077-12.616-6.846-24-17.154l-50.692
                                17.615-28.461-48.383 41.384-33.846q-4.307-15.538-4.307-30.615 0-15.078
                                 4.307-30.616l-40.999-34.615 28.461-48.383 50.307 18q11-10.308 23.808-16.962
                                  12.807-6.654 27.115-10.885l8.923-53.076h56.921l8.539 53.076q14.308 4.231
                                   27.115 11.193 12.808 6.961 23.808 17.884l50.307-19.23 28.461 49.614-41
                                    34.615q4.308 14.429 4.308 30.061 0 15.631-4.308 29.939l41.385 33.846-28.461
                                     48.383-50.692-17.615q-11.384 10.308-24 17.154-12.615 6.846-26.923 11.077l-8.539
                                      53.076h-56.921Zm28.11-100.383q31.428 0 53.774-22.38t22.346-53.807q0-31.428-22.38-53.774t-53.808-22.346q-31.427
                                       0-53.773 22.38-22.346 22.38-22.346 53.808 0 31.427 22.38 53.773 22.38 22.346 53.807 22.346ZM400-552.307q33
                                        0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Zm0-80Zm12 384.614Z"/></svg>
                    <span>  Tableaux <br> de bores</span> </a></li>
    
                    <li><a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_user'];?>-setid-statqx-setx">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="option_svg" viewBox="0 -960 960 960" >
                        <path d="M180.001-180.001v-276.151H320v276.151H180.001Zm230 0v-599.998h139.998v599.998H410.001Zm229.999
                         0v-403.844h139.999v403.844H640Z"/></svg>
                    <span>  Statistiques</span> </a></li>
                    <li ><a class="descox">
                    <svg xmlns="http://www.w3.org/2000/svg" class="option_svg" viewBox="0 -960 960 960">
                        <path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5
                        56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z"/></svg>
                    <span class="sesc">deconnexion</span></a></li>
            </ul>
            
        </ul>
        <?php
        }else{
        ?>

            <ul class="option_nav">

                <li><a href="<?=$domainhost?>/index" class="svg_hdx">
                    <svg xmlns="http://www.w3.org/2000/svg" class="option_svg" viewBox="0 -960 960 960" >
                        <path d="M229-189h127v-257h249v257h126v-377L480-754 229-566.333V-189Zm-91
                        91v-514l342-257 343 257v514H525v-268h-89v268H138Zm342-374Z"/>
                    </svg>
                    <span>Acceuil</span> </a></li>
    
                
                <li class="icone_abnn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="option_svg" viewBox="0 -960 960 960" >
                        <path d="M520-400v-120H400v-80h120v-120h80v120h120v80H600v120h-80ZM160-80q-33
                        0-56.5-23.5T80-160v-480q0-33 23.5-56.5T160-720h80v-80q0-33 23.5-56.5T320-880h480q33
                        0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240h-80v80q0 33-23.5 56.5T640-80H160Zm160-240h480v-480H320v480Z"/></svg>
                    <span>abonnemnt</span></li>
    
    
                <li><a href="<?=$domainhost?>/cc/statut/<?=$_SESSION['id_stat'];?>-setid-vdx-setx"">
                    <svg xmlns="http://www.w3.org/2000/svg" class="option_svg"  viewBox="0 -960 960 960" >
                        <path d="m429-383 270-174-270-175v349ZM285-195q-36.413 0-63.706-27.612Q194-250.225
                        194-286v-542q0-36.188 27.294-64.094Q248.587-920 285-920h542q36.188 0 63.594
                        27.906T918-828v542q0 35.775-27.406 63.388Q863.188-195
                        827-195H285Zm0-91h542v-542H285v542ZM134-44q-36.825 0-63.912-27.406Q43-98.812
                            43-135v-633h91v633h633v91H134Zm151-784v542-542Z"/>
                    </svg>
                    <span>Mes Videos</span></a></li>
                
            </ul>        
        <?php
        }
    ?>
</header>

<section class="dark_content semi">
            <!-- abonnement -->

    <section class="abnn">
        <div class="notif">
        <h2 class="notif_titre">Abonnements</h2>
        <h3 class="fermx"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
             56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
              0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
               0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></h3>
        </div>
        <?php
        for ($i=0; $i < count($set_abn) ; $i++) { 
            $id_abo = $set_abn[$i]['id_abo'];
            $resqt = "SELECT * FROM user WHERE id_user = ?";
            $selectabo = $bdd -> prepare($resqt);
            $selectabo -> execute(array($id_abo));
            $set_abo = $selectabo -> fetch();

            $iduser = $set_abo['id_user'];
            $ps = $set_abo['pseudo'];
            $el = $set_abo['email'];
            $mdp = $set_abo['mdp'];
            $age = $set_abo['ages'];
            $gr = $set_abo['genre'];
            $avatar = $set_abo['avatar'];
        ?>
        <article class="prof_abonn">
            <a href="<?=$domainhost?>/cc/statut/<?=$iduser?>-setid"><img class="avtr" src="<?=$domainhost?>/filesdir/avatares/<?=$avatar?>" alt=""></a>
            <div class="info_abnn">
                <h3><a href="<?=$domainhost?>/cc/statut/<?=$iduser?>-setid"><?=$ps?></a></h3>
                <h2 class="online"></h2>
            </div>
        </article>
    <?php
    }
    ?>        
    </section>


            <!-- notification -->
    <section class="abnn" id="notifx">
        <div class="notif">
        <h2 class="notif_titre">Notifications</h2>
        <h3 class="nfermx"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
             56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
              0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
               0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></h3>
        </div>
        <section class="natifbar">
        <?php
        for ($e=0; $e < count($set_notif) ; $e++) { 
            $title = $set_notif[$e]['objects'];
            $notif = $set_notif[$e]['notifs'];
            $id_notif = $set_notif[$e]['id_notf'];
            $bd_times = $set_notif[$e]['times'];

            $timepasse = new dateTime("@$bd_times");

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
        ?>
        <article class="prof_abonn notif">
            <div class="hd_flex">
                <h3><?=$title?></h3>
                <p><?=$times?></p>
            </div>
            <p class="notfx"><?=$notif?></p>
            <span class="supr"> <a href=""> suprimes</a></span>
        </article>
        <?php
        }
        if (count($set_notif) == 0) {
            echo("<h4 class='notif_none'>Aucune <br>notification a signalée</h4>");
        }
        ?>  
        </section>  
    </section>




            <!-- options -->

    <section class="shadow-nav">
        <div class="notif">
            <h2 class="notif_titre">Option navigation</h2>
            <h3 class="nav-fermx"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
                 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
                  0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
                   0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></h3>
        </div>
        <div class="nav_sach">
            <?php
            for ($x=0; $x < count($set_opt); $x++) { 
                $op_mane = $set_opt[$x]['opts'];
                $id_opt = $set_opt[$x]['id_opt'];
            ?>
            <form action="" method="post" class="form_sach">
                <input type="hidden" name="nav-option" value="<?=$op_mane?>">
                <input type="hidden" name="id-option" value="<?=$id_opt?>">

                <input class="op_submit" name="btn-option" type="submit" value="<?=$op_mane?>">
            </form>
            <?php
            }
            ?>
        </div>   
    </section>
</section>


<script>


    // pour l'ouverture le fermeteure des femetre segondere

    const abn =  document.querySelector('.abnn');
    const cash =  document.querySelector('.shadow-nav');
    const fermAbn =  document.querySelector('.fermx');
    const navFx =  document.querySelector('.nav-fermx');
    const iAbn =  document.querySelector('.icone_abnn');
    const iNotif =  document.querySelector('.icone_notifx');
    const Notif = document.querySelector('#notifx');
    const nferm =  document.querySelector('.nfermx');
    const Opt = document.querySelector('.opt');


    iNotif.addEventListener('click' , () => {
        Notif.classList.toggle('naf');
        cash.classList.remove('mob');
        abn.classList.remove('aff');
    });
    nferm.addEventListener('click' , () => {
        Notif.classList.remove('naf');
    });

    iAbn.addEventListener('click' , () => {
        abn.classList.toggle('aff');
        cash.classList.remove('mob');
        Notif.classList.remove('naf');
    });
    fermAbn.addEventListener('click' , () => {
        abn.classList.remove('aff');
    });


    Opt.addEventListener('click' , () => {
        cash.classList.toggle('mob');
        abn.classList.remove('aff');
        Notif.classList.remove('naf');
    });
    navFx.addEventListener('click' , () => {
        cash.classList.remove('mob');

    });

    
    
   



    // // envoi des notifications a la bdd
    // function getNotif(Object,Notif){
    //     var Xhr = new XMLHttpRequest();
    //     var dataNotif = new FormData();
    //     dataNotif.append("obj", Object);
    //     dataNotif.append("notf", Notif);
    //     Xhr.onreadystatechange = function(){ 
    //         console.log(Xhr.response);
    //         if (Xhr.readyState === 4 && Xhr.status === 200) {
    //             var rep = Xhr.response;
    //             if (rep.success) {
    //                 // animation du champs input
    //             }else{
    //                // renvoyer le funtion de notifications
    //             }
    //         }
    //     }    
    // Xhr.open("POST", "async/getnotifx.php" , true);
    // Xhr.responseType = "json";
    // Xhr.send(dataNotif); 
    // }



    // notx = 'Publications accepte, Mercie de toujours suivres les régles du site';
    //                    getNotif(object, notx);
</script>



</body>
</html>