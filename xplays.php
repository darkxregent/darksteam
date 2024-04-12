<?php
require('action/act.php');
require('action/xplaysact.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/playstyleS.css">
    <link rel="stylesheet" href="asset/controls.css">
    <title>[<?=$opts?>] <?=$trx?></title> 
    
</head>
<body>
<?php require('includes/headerx.php'); ?>
<section class="dark_content">
    <section class="plays_content">
        <article class="lect_content">
            <div class="vidx_content">
                <select name="" id="lectplayer">
                    <option value="htmlx">LecteurHTML</option>
                    <option  value="darkx">DarkPlayer</option>
                </select>
                <div class="vidx">
                    <video class="lictvid" id="lhtml" src="<?=$files?>" poster="<?=$couver?>" controls ></video>
                    
                    
                    <video class="lictvid" id="ldark" src="<?=$files?>" poster="<?=$couver?>"></video>
                    <div class="player">
                        <div class="playing">
                            <h4 class="timesopning">00:00</h4>
                            <div class="progress_bar">
                                <div class="progress_hover"></div>
                                <div class="progression"></div>
                            </div>
                            <h4 class="timesending"><?=$temps?></h4>
                        </div>
                        <div class="icones_player">
                            <div class="fist_icones">
                                <svg xmlns="http://www.w3.org/2000/svg"  height="24px" class="in_prew" viewBox="0 0 24 24" width="24px" fill="#fff">
                                    <path d="M0 0h24v24H0V0z" fill="none"/>
                                    <path d="M6 6h2v12H6zm3.5 6l8.5 6V6l-8.5 6zm6.5 2.14L12.97 12 16 9.86v4.28z"/></svg>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" class="in_pause" id="in_Played" viewBox="0 -960 960 960" width="24" fill="#fff">
                                    <path d="M520-200v-560h240v560H520Zm-320 0v-560h240v560H200Zm400-80h80v-400h-80v400Zm-320 0h80v-400h-80v400Zm0-400v400-400Zm320 0v400-400Z"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" class="in_play" id="in_Played" viewBox="0 -960 960 960" width="24" fill="#fff">
                                    <path d="M340.001-236.156v-487.688L723.074-480 340.001-236.156Z"/></svg>  

                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" class="in_next" viewBox="0 0 24 24" width="24px" fill="#fff">
                                    <path d="M0 0h24v24H0V0z" fill="none"/><path d="M8 9.86v4.28L11.03 12z" opacity=".3"/>
                                    <path d="M14.5 12L6 6v12l8.5-6zM8 9.86L11.03 12 8 14.14V9.86zM16 6h2v12h-2z"/></svg>
                            </div>
                            <div class="ext_option">
                               
                                <div class="volumes">
                                    <div class="icone_volume">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" class="vo_open" id="volx" viewBox="0 -960 960 960" width="24" fill="#fff">
                                            <path d="M561.539-155.617v-61.999q86.538-27.538 139.422-100Q753.846-390.077
                                            753.846-481q0-90.923-52.885-163.384-52.884-72.462-139.422-100v-61.999Q673.23-776.46
                                            743.537-686.46q70.307 89.999 70.307 205.46 0 115.461-70.307 205.46-70.307 90-181.998
                                            119.923ZM146.156-380.001v-199.998h148.46l171.537-171.536v543.07L294.616-380.001h-148.46Zm415.383
                                                46.154v-294.306q40.461 22 62.537 61.961Q646.153-526.23 646.153-480q0 45.615-22.269
                                                84.884t-62.345 61.269Z"/></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" class="vo_close" id="volx" viewBox="0 -960 960 960" width="24" fill="#fff">
                                        <path d="M778.922-74.463 658.307-195.078q-20.769 13.307-43.769 23.076-22.999
                                        9.769-47.614 16.385v-61.999q12.846-4.615 24.999-9.423 12.154-4.807
                                        23-11.423L471.538-381.847v173.382L300.001-380.001h-148.46v-199.998h121.845L79.848-773.537
                                        122-815.69l699.074 699.074-42.153 42.153Zm-19.539-216.23-42.999-42.998q20.846-32.539 31.847-69.808
                                            11-37.27 11-77.501 0-90.923-52.885-163.384-52.884-72.462-139.422-100v-61.999Q679-776.46
                                            749.114-686.46q70.115 89.999 70.115 205.46 0 52.615-15.654 101.038-15.654 48.423-44.192
                                            89.269Zm-122.461-122.46-69.998-69.999v-145.001q40.461 22 62.537 61.961Q651.538-526.23
                                            651.538-480q0 17.693-3.654 34.5-3.654 16.808-10.962 32.347ZM471.538-578.537l-86.307-86.692
                                                86.307-86.306v172.998Z"/></svg>
                                    </div>
                                    <div class="volumes_bar">
                                        <div class="volume_chargement"></div>
                                    </div>
                                   
                                        
                                </div>
                                
                                <div class="playOption" >
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" class="icone_options" viewBox="0 -960 960 960" width="24" fill="#fff">
                                        <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5
                                         1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50
                                          110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24
                                           12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14
                                            7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14
                                             106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68
                                              99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5
                                               41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <div class="other_plays">
                        <h3 class="dark_play_sing">DarkPlayer</h3>
                        <div class="on_option_vidx">
                            <h4>Qualités</h4>
                            <h5 class="240p_play">Petite  <samp>:</samp> <span>240p</span></h5>
                            <h5 class="360p_play">Moyene  <samp>:</samp> <span>360p</span></h5>
                            <h5 class="720p_play">Haute   <samp>:</samp> <span>720p</span></h5>
                        </div>
                    </div>
                    
                   
                </div>
            </div>
            <h3>[<?=$opts?>] <?=$trx?></h3>
            <div class="info_vidx">
                <div class="prof">
                    <a href="<?=$domainhost?>/cc/statut/<?=$iduser?>-setid"> <img class="pof_user" src="<?=$urlax?>" alt=""></a>
                    <input type="hidden" data-idstr="<?=$idstream?>" class="date-abonn" data-idabo="<?=$iduser?>" data-coutabn="<?=count($abnt)?>">
                    <div>
                        <a href="<?=$domainhost?>/cc/statut/<?=$iduser?>-setid"><h4><?=$ps?></h4></a>
                        
                        <p><?=$vues?></p>
                    </div>
                </div>
                <ul class="lickend">
                    <li class="like"><svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960" width="22">
                        <path d="M700-83H234v-533l264-274 50 36q11.875 11.129 18.438 23.565Q573-818 573-799.68v-.32l-43
                         184h313q36.2 0 64.1 28.4Q935-559.2 935-525v37.33q0 12.291-3.5 29.024T924-432L804.33-153.255q-11.675
                          29.273-41.21 49.764Q733.586-83 700-83ZM174-616v533H50v-533h124Z"/></svg>
                        <?=$alllikes?></li>
                    <hr>
                    <li class="eater" ><?=$alleaters?> 
                        <svg height="22" viewBox="0 -960 960 960" fill="rgba(142, 0, 0, 0.785)">
                            <path d="M240-840h400v520L360-40l-50-50q-7-7-11.5-19t-4.5-23v-14l44-174H120q-32 0-56-24t-24-56v-80q0-7
                             1.5-15t4.5-15l120-282q9-20 30-34t44-14Zm480 520v-520h160v520H720Z"></path></svg>
                    </li>
                </ul>
                <div class="dawn">
                    <a href="<?=$files?>" download="[<?=$opts?>] <?=$trx?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" fill="#fff" width="28">
                        <path d="M153.304-73.304v-75.754h653.551v75.754H153.304Zm326.029-169.087L184.666-618.812h165.58v-268.043H608.58v268.043h166.246L479.333-242.391Z"/></svg>
                        <span class="dawnx">Telechagement</span> </a>
                    
                    <p></p>
                    <!-- code non maitrise  -->
                    <!-- <select name="" id="">
                        <option value=""> 224p <?=$exx?></option>
                        <option value=""> 360p <?=$exx?></option>
                        <option value=""> 740p</option>
                        <option value=""> 1014p</option>
                    </select> -->
                </div>
                <h4><?=$allabn?></h4>
                <?php 
                
                if (count($abnt) == 0) {
                    echo('<button  class="btn_abnn" id="btn_abn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                    <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51
                     18 94.5 46.5T800-280v120h-80Zm80-280v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Zm-480-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113
                      47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33
                       0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111
                        13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/></svg>
                    <span class="btn_abx">S\'abonner</span></button> ');
                }else{
                    echo('<button  class="btn_desabn" id="btn_abn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                    <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm240-360H720v-80h240v80Zm-640 40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/></svg>
                    <span class="btn_abx">desabonner</span></button> ');
                }
                ?>
                
            </div>
            <div class="param">
                <h4><?=$vues?> * <?=$times?></h4>
                <p ><?=$descr?></p>
            </div>
           
            
        </article>
        <aside class="out_content">
            <?php
                if ($idplx != 0) { 
            ?>  
            <div class="plx_content">
                <h3 class="letplx" >LECTURES [<?=$plxname?>]</h3>
                <div class="plx_scroll">
                <?php
                for ($i=0; $i < count($setallplx) ; $i++) { 
                if ($_GET['stream'] != $plxidstr[$i]) {
                    
                ?>
                <div class="plx">
                    <h3 class="nbr_videx"><?=$i+1?></h3>
                    <a href="<?=$domainhost?>/xplays?stream=<?=$plxidstr[$i]?>" class="plx_vidx_content">
                        <video src="" class="plx_vidx" poster="<?=$plxcouvers[$i]?>"></video>
                    </a>
                    <div class="plx_info">
                        <a href="<?=$domainhost?>/xplays?stream=<?=$plxidstr[$i]?>"><h4><?=$plxtx[$i]?></h4></a>
                        <p>Temps : <?=$plxtime[$i]?> </p>
                        <p> <?=$plxdate[$i]?>. <?=$xvues[$i]?> </p>
                    </div>
    
                </div>
                <?php
                }
                else {
                ?>
                <div class="plx">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" class="icone_svg_plays" viewBox="0 -960 960 960" width="24" >
                        <path d="M160-360v-80h640v80H160Zm0-160v-80h640v80H160Z"/></svg>
                    <h3 class="nbr_videx"><?=$i+1?></h3>
                    <a href="<?=$domainhost?>/xplays?stream=<?=$plxidstr[$i]?>" class="plx_vidx_content">
                        <video src="" class="plx_vidx" poster="<?=$plxcouvers[$i]?>"></video>
                    </a>
                    <div class="plx_info">
                        <a href="<?=$domainhost?>/xplays?stream=<?=$plxidstr[$i]?>"><h4><?=$plxtx[$i]?></h4></a>
                        <p>Temps : <?=$plxtime[$i]?> </p>
                        <p> <?=$plxdate[$i]?>. <?=$xvues[$i]?> </p>
                    </div>
    
                </div>
                <?php
                    }
                } 
                ?>
                </div>
            </div>
            <?php
            } 
            ?>
            <div class="plx_content comx">
                <h3 class="letplx" > Les commentaires  
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 -960 960 960" width="16">
                        <path d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17
                         0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Zm520-240v-280H160v280h440Zm-440 0v-280 280Z"/></svg>
                </h3>
                <form action="" method="post" class="comm" >
                    <input class="get_comx" name="comx" type="text" minlength="1" placeholder="Ecrire une commentaires :" required>
                    <label for="btn_cmt"><svg xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 -960 960 960" fill="#fff" width="25">
                        <path d="M142.463-193.271v-224.884L402.691-480.5l-260.228-63.268v-223.961L823.535-480.5 142.463-193.271Z"/></svg></label>
                    <input id="btn_cmt" type="submit" value="">
                </form>
                <section  class="contient_comx">
                </section>
            </div>

        </aside>
    </section>
</section>

<script src="script/controLs.js" ></script>



</body>
</html>