<?php
require('../action/act.php');
require('../action/configact.php');

if (isset($_POST['valdbtn']) ){
    $str_id = analyse($_POST['id_str']);

    $srqvld = "UPDATE stream SET confir = ? WHERE id_stream = ?";
    $modifvld = $bdd -> prepare($srqvld);
    $modifvld  -> execute(array("ok", $str_id));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$domainhost?>/asset/allsend.css">
    <link rel="stylesheet" href="<?=$domainhost?>/asset/COnfigstyles.css">
    <title>Publications</title>
</head>
<body>
<?php
require('../includes/headerx.php');
?>

<section class="dark_content">
    <div class="hd_header">
        <p><?=$str_titres?></p>
        <button  type="submit" class="modbtn">Enregistres</button>
    </div>
    <form action="" class="modEdither" method="POST">
        <input type="hidden" name="id_str" value="<?=$id?>">
        <div class="lectmod">
            <video class="lictvid" id="lhtml" src="<?=$files?>" poster="<?=$couver?>" controls ></video>
            <div class="infomod">
                <div class="inpmod">
                    <label for="titres">Modifier le Titres</label>
                    <input type="text" value="<?=$str_titres?>" name="titres" id="titres">
                </div>
                <div class="inpmod">
                    <label for="agx">Modifier la Agences</label>
                    <input type="text" value="<?=$str_agx?>" name="agx" id="agx">
                </div>
                <div class="inpmod">
                    <label for="tagx">Modifier les Tages</label>
                    <textarea name="tagx" id="tagx" cols="30" ><?=$str_tagx?></textarea>
                </div>
                <div class="inpmod">
                    <label for="descr">Modifier les Descriptions</label>
                    <textarea name="descr" id="descr" cols="30" ><?=$str_desx?></textarea>
                </div>
                
            </div>
        </div>
        <div class="sectall">
            <div>
                <label for="optx">Modifier les Options</label>
                <select class="select" name="optx" id="optx" >
                    <option value="<?=$str_id_cath?>"><?=$opt?></option>
                </select>
            </div>
            <div>
                <label for="cathx">Modifier les Cathegories</label>
                <select class="select" name="cathx" id="cathx" >
                    <?php
                    for ($i=0; $i < count($acthstream) ; $i++) {
                        $cath_id[$i] = $acthstream[$i]['id_cath']; 
                        $cath_name[$i] = $acthstream[$i]['cath'];
                    ?>
                    <option value="<?=$cath_id[$i]?>"><?=$cath_name[$i]?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="valdbtn" name="valdbtn">Valider la Video</button>
    </form>


</section>

<script>
    var modbtn = document.querySelector('.modbtn');
    var modEdht = document.querySelector('.modEdither');    
    const xhrx = new XMLHttpRequest();
    const object = 'DarkStream';             
    var notx = "Publications Modifiers, Les informaions de votres videos on été juger incorrect";
 
    modbtn.addEventListener('click' , (event) => {
        event.preventDefault();
        var dataForom = new FormData(modEdht);
        xhrx.onreadystatechange = function(){
            if (xhrx.readyState == 4 && xhrx.status == 200) {
                    var respx = xhrx.response;
                    if (respx.success) {
                       getNotif(object, notx, respx.modif);
                    }else{
                        alert(respx.modif);
                        
                    }
                }else if (xhrx.readyState == 4) {
                    alert('eurreure server');
                }
        }
        xhrx.open('POST', '../action/configmodact.php', true);
        xhrx.responseType = "json";
        xhrx.send(dataForom);
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