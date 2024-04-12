<?php
require('../action/act.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$domainhost?>/asset/allsend.css">

    <title>Publications</title>
</head>
<body>
<?php
require('../includes/headerx.php');
?>

<section class="dark_content">
    <div class="alert_content">
        <p class="alert_info">
            
        </p>
        <p class="alert">
            
        </p>
        <button class="alt_fx">Ferme</button>
    </div>
    <div class="evolut_content">
        <h3 class="p1">1</h3>
        <hr class="v1">
        <h3 class="p2">2</h3>
        <hr class="v2">
        <h3 class="p3">3</h3>
        <hr class="v3">
        <h3 class="p4">4</h3>
    </div>
    <form method="post" class="forom"  enctype="multipart/form-data">
        <div class="file_forom">
            <label for="upload_file" class="file_svg" >
                
                <svg xmlns="http://www.w3.org/2000/svg" class="upsvg" viewBox="0 -960 960 960" >
                    <path d="M160-80v-80h640v80H160Zm320-160L200-600h160v-280h240v280h160L480-240Zm0-130
                     116-150h-76v-280h-80v280h-76l116 150Zm0-150Z"/></svg>

                <svg xmlns="http://www.w3.org/2000/svg" class="upsvg fx" viewBox="0 -960 960 960">
                        <path d="M378-225 133-470l66-66 179 180 382-382 66 65-448 448Z"/></svg>
                
            </label>
            <p >Veuillez selectionner la votre videos </p>
            <input type="file" name="upfiles" class="upfiles" accept="video/*" id="upload_file" required>
            <input type="hidden" class="times"  name="times">
            <button type="button" onclick="going2()" id="psi" class="psi2">Suivent</button>
        </div>
        <div class="infor_forom">
            <div class="pr_forom">
                <div class="infor">
                    <div>
                        <label for="tires">Titres des la videos</label>
                        <input type="text" name="titres" id="titres" required>
                    </div>
                    <div>
                        <label for="agences">Auteurs ou Acteures principales par defaut</label>
                        <input type="text" name="agences" id="agences" required>
                    </div>
                    <div>
                        <div class="list_opts">
                            <label for=options">Les Options</label>
                            <select class="options" name="options" id="options" >
                            <option value="">Options non selectionner</option>
                                <?php
                                for ($i=0; $i < count($set_opt); $i++) { 
                                    $id_opts = $set_opt[$i]['id_opt'];
                                    $opts = $set_opt[$i]['opts'];
                                    
                                ?>
                                    <option value="<?=$id_opts?>"><?=$opts?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="cree_plx">
                            <label for="cree_plx">Cree un playlist</label>
                            <input type="text" name="cree_plx" id="cree_plx">
                        </div>
                        
                    </div>
                    
                </div>
                <div class="lect_ts" >
                    <img class="vid_svg" src="<?=$domainhost?>/images/dark_couver.jpg" alt="">
                    <video class="vidlect" controls></video>
                </div>
                
            </div>

            <div class="req_op" >
                <div class="list_plx">
                <label for="playlist"> Vos Playlist</label>
                    <select name="playlist" id="playlist">
                        <option value="">Aucun playlist selectionner</option>
                    </select>            

                </div>
                <div class="list_cath">
                    <label for="cath"> Les Cathegories</label>
                    <select class="cath" name="cath" id="cath">
                        <option value="">Cathegories non selectionner</option>            
                    </select>
                </div>
            </div>
            <div class="supinfo">
                <div class="inf_sup">
                    <label for="text_tage">Saisire votre Tages</label>
                    <textarea class="text_desr" name="tages" id="text_tage" placeholder="les Tages de la videos ; plus les tages sont presis plus la videos est visibles"></textarea>
                </div>
                <div class="inf_sup">
                    <label for="text_desr">Saisire votre commentaires</label>
                    <textarea class="text_desr" name="descr" id="text_desr" placeholder="descriptions de votres videos"></textarea>
                </div>
            </div>
            <div>
                <button type="button" onclick="revin3()" id="psi" class="psi3">Presedent</button>
                <button type="button" onclick="going3()" id="psi" class="psi3">Suivent</button>
            </div>

        </div>
        <div class="tr_forom" >
            <h3>Inporter ou Genere une image de couverture ici </h3>
            <div class="lect_couver">
                <svg height="180" class="couver_svg" viewBox="0 0 530 530" fill="currentColor">
                    <path d="M0,457.468h530.399V72.931H0V457.468z
                     M44.627,412.333l105.824-147.133l65.334,90.838l40.49,56.295h-80.977H44.627
                         L44.627,412.333z M328.442,199.41l153.144,212.923H275.125l-6.426-8.932l-43.486-60.463L328.442,199.41z M117.81,122.91
                             c23.097,0,41.821,18.724,41.821,41.821c0,23.097-18.724,41.821-41.821,41.821c-23.097,0-41.821-18.724-41.821-41.821
                                 C75.992,141.634,94.713,122.91,117.81,122.91z"></path>
                </svg>
                <img class="lect couvers"   alt="couvertures de la publications">
            </div>
            <div class="select_btn">
                <button type="button" class="btn_genere" id="btn">
                    <svg height="20" viewBox="0 -960 960 960" width="20" fill="#00f">
                        <path d="M380-300v-360l280 180-280 180ZM480-40q-108 0-202.5-49.5T120-228v108H40v-240h240v80h-98q51
                         75 129.5 117.5T480-120q115 0 208.5-66T820-361l78 18q-45 136-160 219.5T480-40ZM42-520q7-67
                          32-128.5T143-762l57 57q-32 41-52 87.5T123-520H42Zm214-241-57-57q53-44 114-69.5T440-918v80q-51 5-97
                           25t-87 52Zm449 0q-41-32-87.5-52T520-838v-80q67 6 128.5 31T762-818l-57 57Zm133 241q-5-51-25-97.5T761-705l57-57q44
                            52 69 113.5T918-520h-80Z"></path>
                    </svg>
                     Genere</button>
                <label class="" id="btn" for="couver">
                    <svg height="24" viewBox="0 -960 960 960" width="24" fill="#ffc400">
                        <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h240l80 80h320q33
                         0 56.5 23.5T880-640H160v400l96-320h684L837-217q-8 26-29.5 41.5T760-160H160Z"></path>
                    </svg>
                    Inporter</label>
                <input type="file" class="couver" accept="image/*" name="couver" id="couver">
                <input type="text" name="mycanvas" id="mycanvas">
            </div>
            
            <div>
                <button type="button" onclick="revin4()" id="psi" class="psi4">Presedent</button>
                <button type="button" onclick="going4()" id="psi" class="psi4">Suivent</button>
            </div>
        </div>
        <div class="vald_forom">
            <div class="vld_info">
                <h4 class="evolut">Debuts</h4>
                <p class="pourcantage">Parcours (%)</p>
                <h4 class="filesize">Fin</h4>
            </div>
            <div class="progress" >
                <div class="chargement"  date-upload=""></div>
            </div>
            <button type="submit" name="send" class="valid">Publier</button>
            <button type="button" class="annule" id="annule"> Annuler</button>
        </div>
        
    </form>
</section>


<script src="../script/sendscrx.js"></script>



</body>
</html>