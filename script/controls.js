    var xhrx = new XMLHttpRequest();
    const lhtml= document.querySelector('#lhtml');
    const Plax = document.querySelector('.player');
    const lectPlayer = document.querySelector('#lectplayer');

    var myVideos = document.querySelector('#ldark');
    var videos_stats = true;
    var contTiomeOut = "";
    const idstr = document.querySelector('.date-abonn').getAttribute('data-idstr');
    var intercomx,valparx;

    // verifier si la videos est pause ou play et appelle les fonction respactive
    Plax.classList.add('add_player');
    document.querySelector('.in_pause').style.display = "none";
    document.querySelector('.in_play').style.display = "block";
    myVideos.addEventListener('click', videosPlayed);
    document.querySelectorAll('#in_Played').forEach(function (playClick){
        playClick.addEventListener('click', videosPlayed);
    });
    function videosPlayed() {
        document.querySelector('.on_option_vidx').classList.remove("op_option");
        if (videos_stats) {
            myVideos.play();
            myVideos.addEventListener('play', onPlay);
            document.querySelector('.in_pause').style.display = "block";
            document.querySelector('.in_play').style.display = "none";
            videos_stats = false;
        }
        else{
            myVideos.pause();
            Plax.classList.add('add_player'); 
            myVideos.addEventListener('pause', onPause);
            videos_stats = true;
            document.querySelector('.in_pause').style.display = "none";
            document.querySelector('.in_play').style.display = "block";
        } 
    }
    function onPlay() {
        myVideos.addEventListener('mouseover', ()=>{
            clearTimeout(contTiomeOut);
            Plax.classList.add('add_player');
            contTiomeOut = setTimeout(() => {
                Plax.classList.remove('add_player');
            }, 5000);
        });
        myVideos.addEventListener('mousemove', ()=>{
            clearTimeout(contTiomeOut);
            Plax.classList.add('add_player');
            contTiomeOut = setTimeout(() => {
                Plax.classList.remove('add_player');
            }, 5000);
        });

        myVideos.addEventListener('mouseout', ()=>{
                clearTimeout(contTiomeOut);
            Plax.classList.remove('add_player');
        });

        Plax.addEventListener('mouseover', ()=>{
                clearTimeout(contTiomeOut);
            Plax.classList.add('add_player');            
        });

        Plax.addEventListener('mouseout', ()=>{
            Plax.classList.remove('add_player');            
        });

        
    }

    function onPause() {
        myVideos.addEventListener('mouseover', ()=>{
            clearTimeout(contTiomeOut);
            Plax.classList.add('add_player');
        });
        myVideos.addEventListener('mousemove', ()=>{
            clearTimeout(contTiomeOut);
            Plax.classList.add('add_player');
        });

        myVideos.addEventListener('mouseout', ()=>{
            Plax.classList.add('add_player');
        });

        Plax.addEventListener('mouseover', ()=>{
            Plax.classList.add('add_player');            
        });

        Plax.addEventListener('mouseout', ()=>{
            Plax.classList.add('add_player');            
        });
    }

    


    // Gestion du temps et le progression du chargement de la progression et 
    // la lecteure de la fonction a la fine (ended)
    var duree, long_progress , point_progress, progressWidth, progessX, timesmove, positX;
    var s, mm, h , myVidTimes;
    var progressBar = document.querySelector('.progress_bar')
    var progress = document.querySelector('.progression');
    var hoverProgess = document.querySelector('.progress_hover');
    var Played15x = true;
    myVideos.ontimeupdate = function () {
        duree = myVideos.duration;
        long_progress = progressBar.offsetWidth;
        point_progress = myVideos.currentTime;
        progressWidth = point_progress * long_progress / duree;
        progress.style.setProperty("--wdp" , `${progressWidth}px`);
        document.querySelector('.timesopning').innerHTML = setTimesX(point_progress);
        if (myVideos.duration == myVideos.currentTime) {
            onEnded();
        }
        if (point_progress >= 15 && !Played15x) {
            getvues();
            Played15x = false;
        }
    } 
    progressBar.addEventListener('mousemove', function (e) {
        clearTimeout(timesmove);
        progessX = e.clientX - progressBar.getBoundingClientRect().left;
        hoverProgess.style.setProperty("--wdhp" , `${progessX}px`);
    });
    progressBar.addEventListener('mouseout', function () {
        timesmove = setTimeout(() => {
            progessX = 0;
            hoverProgess.style.setProperty("--wdhp" , `${progessX}px`);
        }, 500);
        
    });
    progressBar.addEventListener('click',()=>{
        duree = myVideos.duration;
        long_progress = progressBar.offsetWidth;
        positX = hoverProgess.offsetWidth;
        pos_myvideo = positX * duree / long_progress;
        myVideos.currentTime = pos_myvideo;
    })
    function setTimesX(times) {
        mm = Math.floor(times / 60);
        s = Math.floor(times % 60);
        h = Math.floor(mm / 60);
        myVidTimes = h > 0 ?
        `${h}:${String(mm).padStart(2, '0')}:${String(s).padStart(2, '0')}`:
        `${String(mm).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
        return myVidTimes
    }
    function onEnded() {
        Plax.classList.add('add_player'); 
        myVideos.addEventListener('pause', onPause);
        videos_stats = true;
        document.querySelector('.in_pause').style.display = "none";
        document.querySelector('.in_play').style.display = "block";
    }
    

    // ajouter un vues au vides quelque soit le lecteure a la 15s
    lhtml.ontimeupdate = function () {
            point_progress = lhtml.currentTime;
            if (point_progress > 15 && 15.2 > point_progress) {
                getvues();
            }
    } 
    function getvues() {
        xhrx.onreadystatechange = function(){
            if (xhrx.readyState === 4 && xhrx.status === 200) {
            }
        }
                
        xhrx.open("POST", "async/vues.php" , true);
        xhrx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrx.send("idstr="+idstr);
    }



    // Gestion de tous les fonctionnalite des volumes et
    //  autres action silencieux et haut parlaure
    const vo_on = document.querySelector('.vo_open');
    const vo_off = document.querySelector('.vo_close');
    var volumeBar = document.querySelector('.volumes_bar');
    var volumeCharges = document.querySelector('.volume_chargement');
    var volx_statuts = true;
    var vid_vlx , myVlx, provlox;
    document.querySelectorAll('#volx').forEach(function (volstat){
        volstat.addEventListener('click', changesVolumes);  
    });
    function changesVolumes() {
        if (volx_statuts) {
            vo_on.style.display = "none";
            vo_off.style.display = "block";
            volx_statuts = false;
            myVlx = volumeCharges.offsetWidth / volumeBar.offsetWidth;
            myVideos.volume = 0;
            provlox = 0;
            volumeCharges.style.setProperty("--wdv" , `${provlox}%`);
        }
        else{
            vo_on.style.display = "block";
            vo_off.style.display = "none";
            volx_statuts = true;
            myVideos.volume = myVlx;
            provlox = myVlx * 100;
            volumeCharges.style.setProperty("--wdv" , `${provlox}%`);
        }
    }
    volumeBar.addEventListener('click', chargesVlx);
    function chargesVlx(v){
        volx_statuts = true;
        vo_on.style.display = "block";
            vo_off.style.display = "none";
        maxvlx = 1;
        volxwd = volumeBar.offsetWidth;
        volxX = v.pageX - volumeBar.getBoundingClientRect().left;
        vid_vlx = volxX * maxvlx / volxwd;
        myVideos.volume = vid_vlx;
        provlox = vid_vlx * 100;
        volumeCharges.style.setProperty("--wdv" , `${provlox}%`);
        
    }

  

    // Verification et affichage du lecteures choises par l\'utilisateure
    lectPlayer.addEventListener('change', ()=>{
        const lect = encodeURIComponent(lectPlayer.value);
        if (lect == "htmlx") {
            lhtml.style.display = "block"
            myVideos.style.display = "none"
            myVideos.pause();
            Plax.style.display = "none";
            document.querySelector('.other_plays').style.display = "none";
        }
        else if (lect == "darkx") {
            lhtml.style.display = "none";
            lhtml.pause();
            myVideos.style.display = "block";
            Plax.style.display = "flex";
            document.querySelector('.other_plays').style.display = "block";
        }
    });
    


    // option menu de qualite de la videos
    const iOption = document.querySelector('.icone_options');
    const on_Option = document.querySelector('.on_option_vidx');
    iOption.addEventListener('click', ()=>{
        on_Option.classList.toggle("op_option");
    });


    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    // les mini formulaire gere en AJAX

    // Gestion des composent des abonnement en AJAX
    const abnBtn = document.querySelector('.btn_abnn');
    const desBtn = document.querySelector('.btn_desabn'); 
    const idabn = document.querySelector('.date-abonn').getAttribute('data-idabo'); 
    const countabn = document.querySelector('.date-abonn').getAttribute('data-coutabn'); 
    var abnBtn_starts;
    if (countabn == 0) {
        abnBtn.addEventListener('click', (e) => {
            e.preventDefault;
            xhrx.onreadystatechange = function(){ 
                if (xhrx.readyState === 4 && xhrx.status === 200) {
                    var rep = xhrx.response;
                    if (rep.success) {
                        location.reload();
                    }
                }
            }
                
        abnBtn_starts = 200;
        xhrx.open("POST", "async/abnn.php" , true);
        xhrx.responseType = "json";
        xhrx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrx.send("idabn="+idabn+"&abn_satut="+abnBtn_starts);
        });
    }
    else{
        desBtn.addEventListener('click', (f) => {
            f.preventDefault;
        xhrx.onreadystatechange = function(){
            if (xhrx.readyState === 4 && xhrx.status === 200) {
                var rep = xhrx.response;
                if (rep.success) {
                    location.reload();
                }
            }
        }
                
        const abnBtn_stats = 404;
        xhrx.open("POST", "async/abnn.php" , true);
        xhrx.responseType = "json";
        xhrx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhrx.send("idabn="+idabn+"&abn_satut="+abnBtn_stats);
        });
    }
        
    
    // les likes pour chaque videos
    const likeBtn = document.querySelector('.like');
    const eaterBtn = document.querySelector('.eater');
    likeBtn.addEventListener('click', (e) => {
        e.preventDefault;
        xhrx.onreadystatechange = function(){ 
            if (xhrx.readyState === 4 && xhrx.status === 200) {
                var rep = xhrx.response;
                if (rep.success) {
                     // animation du likes
                }
            }
        }
            
    xhrx.open("POST", "async/like.php" , true);
    xhrx.responseType = "json";
    xhrx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrx.send("idstr="+idstr);
    });
    eaterBtn.addEventListener('click', (e) => {
        e.preventDefault;
        xhrx.onreadystatechange = function(){ 
            if (xhrx.readyState === 4 && xhrx.status === 200) {
                var rep = xhrx.response;
                if (rep.success) {
                    // animation du eaters
                }
            }
        }
            
    xhrx.open("POST", "async/eater.php" , true);
    xhrx.responseType = "json";
    xhrx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhrx.send("idstr="+idstr);
    });



    // envoyer un commentaires dans la bdd
    
    const btnCmt = document.querySelector('#btn_cmt'); 
    const ipcomx = document.querySelector('.get_comx'); 
    const Forom =  document.querySelector('.comm');
    
    btnCmt.addEventListener('submit' , (event) => {
        event.preventDefault();
        var dataForom = new FormData(Forom);
        dataForom.append("idstr", idstr);
        xhrx.onreadystatechange = function(){ 
            console.log(xhrx.response);
            if (xhrx.readyState === 4 && xhrx.status === 200) {
                var rep = xhrx.response;
                if (rep.success) {
                    // animation du champs input
                    

                }else{
                   // animation du champs input
                }
                ipcomx.value="";
                comxresv();
            }
        }
            
    xhrx.open("POST", "async/getcomx.php" , true);
    xhrx.responseType = "json";
    xhrx.send(dataForom); 
    });


    btnCmt.addEventListener('click' , (event) => {
        event.preventDefault();
        var dataForom = new FormData(Forom);
        dataForom.append("idstr", idstr);
        xhrx.onreadystatechange = function(){ 
            console.log(xhrx.response);
            if (xhrx.readyState === 4 && xhrx.status === 200) {
                var rep = xhrx.response;
                if (rep.success) {
                    // animation du champs input
                    

                }else{
                   // animation du champs input
                }
                ipcomx.value="";
                comxresv();
            }
        }
            
    xhrx.open("POST", "async/getcomx.php" , true);
    xhrx.responseType = "json";
    xhrx.send(dataForom); 
    });


    // affichages des commentaires en ajax async
    // tout les 5ms
    var xhrt = new XMLHttpRequest();
    function demarrerInterval() {
        intercomx = setInterval(comxresv, 5000);
    }
    // fonction pour chargres les commentaires

    function comxresv(){
        xhrt.onreadystatechange = function(){ 
           
            if (xhrt.readyState === 4 && xhrt.status === 200) {
                var repx = xhrt.response;
                // console.log(xhrt.response);
                document.querySelector(".contient_comx").innerHTML = repx;
            }
        }
                
        xhrt.open("POST", "async/rescomx.php" , true);
        xhrt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        const idstr = document.querySelector('.date-abonn').getAttribute('data-idstr');
        xhrt.send("idstr="+idstr);
    }
    window.addEventListener('load', comxresv());



    //  // active du inpit des reponse au commentaires
        function recupererClasse(elent) {
            const pardx = elent.parentNode;
            const valpxx = pardx.getAttribute('data-id-comx');
        
            // Création du contenu HTML du formulaire de réponse au commentaire
            const contenthtml = `
            <!-- Créez un élément de formulaire -->
            <form class="formx" method="POST">
                <!-- Créez un élément d'entrée de texte -->
                <input type="text" placeholder="Entrez votre texte..." class="respx" style="border-bottom: 2px solid #fff;" required  name="rcomx">
                <!-- Créez un label pour le bouton -->
                <label for="submitBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" fill="#fff" width="30">
                        <path d="M142.463-193.271v-224.884L402.691-480.5l-260.228-63.268v-223.961L823.535-480.5 142.463-193.271Z"/>
                    </svg>
                </label>
                <!-- Créez un élément d'entrée de soumission -->
                <input type="submit" onclick="getrcomx(this, event)" class="subrepx" id="submitBtn">
            </form>`;
        
            // Insérer le formulaire dans le parent
            pardx.innerHTML = contenthtml;
        
            // Appel de la fonction pour arrêter l'intervalle
            clearInterval(intercomx);
        }
        
        function getrcomx(btnrcx, event){
            event.preventDefault(); // Empêche le comportement par défaut du formulaire
            
            const dataFormx = btnrcx.parentNode;
            const partx = dataFormx.parentNode;
            const valPartx = partx.getAttribute('data-id-comx');
        
            const Xhr = new XMLHttpRequest();
        
            const dataAllForm = new FormData(dataFormx);
            dataAllForm.append('id_comx', valPartx);
        
            Xhr.onreadystatechange = function(){ 
                if (Xhr.readyState === 4 && Xhr.status === 200) {
                    var rep = Xhr.response;
                    console.log(rep)
                    if (rep.success) {
                        
                        
                        // alert(JSON.stringify(rep));
                    } else {
                        console.error('Échec de la requête');
                    }
                    const inputText = dataFormx.querySelector('input[type="text"]');
                    if (inputText) {
                        inputText.value = ''; // Réinitialiser la valeur du champ de saisie à une chaîne vide
                    }
                    comxresv();
                    demarrerInterval();
                }
            };
        
            Xhr.open("POST", "async/getrepx.php", true);
            Xhr.responseType = "json";
            Xhr.send(dataAllForm);
        }
        