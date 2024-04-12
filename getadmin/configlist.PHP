<?php
require('../action/act.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$domainhost?>/asset/configstyles.css">

    <title>Publications</title>
</head>
<body>
<?php
require('../includes/headerx.php');
?>

<section class="dark_content">
    <div class="send_list">
        <h3 class="hd_of_send">
            liste des videos a authantiphies
        </h3>
        <?php 
        $reqt = "SELECT * FROM stream WHERE confir != ?";
        $selstream = $bdd -> prepare($reqt);
        $selstream -> execute(['ok']);
        $allstream = $selstream -> fetchall();
        for ($i=0; $i < count($allstream); $i++) { 
            $id_str = $allstream[$i]['id_stream'];
            $str_titres = $allstream[$i]['titres'];

        ?>
        <div class="listing">
            <article class="config_art">
                <a class="name_art" href="<?=$domainhost?>/getadmin/config.php?str=<?=$id_str?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
                        <path d="M59-138v-188h187v188H59Zm247 0v-188h596v188H306ZM59-386v-189h187v189H59Zm247
                         0v-189h596v189H306ZM59-635v-188h187v188H59Zm247 0v-188h596v188H306Z"/></svg>
                    <h3><?=$str_titres?></h3>
                </a>
                <div class="param_mod">
                    <button type="submit" class="delet" data-stream="<?=$id_str?>">suprime</button>
                    <a href="<?=$domainhost?>/getadmin/config.php?str=<?=$id_str?>"><button>modifier</button></a>
                </div>
            </article>
        </div>
        <?php 
        }
        ?>
        
    </div>

</section>


<!-- script pas encor activer ni fichier cree -->
<script>
    var supr = document.querySelector('.delet');
    var dataSuprId = supr.getAttribute('data-stream');    
    const xhrx = new XMLHttpRequest();
    const object = 'DarkStream';
    var notx = "Publications rejéter, Votres videos ne suis pas les régles du site. Velluiez relire les raigles de publications";

    supr.addEventListener('click' , (event) => {
        event.preventDefault();
        xhrx.onreadystatechange = function(){
            if (xhrx.readyState == 4 && xhrx.status == 200) {
                    var respx = xhrx.response;
                    console.log(respx);
                    if (respx.success) {
                        getNotif(object, notx, respx.modif);
                        setTimeout(() => {
                            location.reload(true);
                        }, 1000);
                        
                    }else{
                        alert(respx.modif);
                        
                    }
                }else if (xhrx.readyState == 4) {
                    alert('eurreure server');
                }
        }
        xhrx.open('POST', '../async/delete.php', true);
        xhrx.responseType = "json";
        xhrx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrx.send("idstr="+dataSuprId);
    }); 


     // envoi des notifications a la bdd
    function getNotif(Object,Notif,id){
        var Xhr = new XMLHttpRequest();
        var dataNotif = new FormData();
        dataNotif.append("obj", Object);
        dataNotif.append("notf", Notif);
        dataNotif.append("strid", id);
        Xhr.onreadystatechange = function(){ 
            console.log(Xhr.response);
            if (Xhr.readyState === 4 && Xhr.status === 200) {
                var rep = Xhr.response;
                if (rep.success) {
                    // animation du champs input
                }else{
                   // renvoyer le funtion de notifications
                }
            }
        }    
    Xhr.open("POST", "../async/getnotifx.php" , true);
    Xhr.responseType = "json";
    Xhr.send(dataNotif); 
    }
        
</script>
</body>
</html>