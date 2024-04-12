
    const fileForom = document.querySelector('.file_forom');
    const iForom = document.querySelector('.infor_forom');
    const trForom = document.querySelector('.tr_forom');
    const vldForom = document.querySelector('.vald_forom');

    const upFiles = document.querySelector('.upfiles');
    var cvr = document.querySelector('.couver');
    const lectVid = document.querySelector('.vidlect');
    var times = document.querySelector('.times');
    var animatedElement = document.querySelector('.file_svg');
    var alertElement = document.querySelector('.alert');
    var alertInfo = document.querySelector('.alert_info');
    var contentAlert = document.querySelector('.alert_content');

    var cancel = document.querySelector('.annule');
    var cancel_state = true;
    
    
    
    // chargement de l'evolution du formulaires
    document.querySelector('.p1').addEventListener('click', () => {
        trForom.style.display = 'none';
        fileForom.style.display = 'flex';
        iForom.style.display = 'none';
        vldForom.style.display = 'none';
    });
    document.querySelector('.p2').addEventListener('click', () => {
        fileForom.style.display = 'none';
        trForom.style.display = 'none';
        iForom.style.display = 'flex';
        vldForom.style.display = 'none';
    });
    document.querySelector('.p3').addEventListener('click', () => {
        fileForom.style.display = 'none';
        trForom.style.display = 'flex';
        iForom.style.display = 'none';
        vldForom.style.display = 'none';
    });
    document.querySelector('.p4').addEventListener('click', () => {
        fileForom.style.display = 'none';
        trForom.style.display = 'none';
        iForom.style.display = 'none';
        vldForom.style.display = 'flex';
    });

    // alert function for get files
    function alertErreur(paraMessager){
        let svger = `<svg class="alert-icon" fill="currentColor" height="30" width="50"><use xlink:href="#exclamation-triangle-fill"></use></svg>`;

        alertElement.innerHTML = svger + paraMessager;
                    
        alertElement.classList.add('active');
        setTimeout(function(){
            alertElement.classList.remove('active'); 
        } ,9000);
                    
        contentAlert.classList.add('skep'); 
        setTimeout(function(){
            contentAlert.classList.remove('skep'); 
        } ,6000); 
    }
    function alertInfor(paraMessager){
        let svgif = `<svg class="alert-icon" fill="currentColor" height="30" width="50"><use xlink:href="#info-fill"></use></svg>`;

        alertInfo.innerHTML = svgif + paraMessager;
                    
        alertInfo.classList.add('active');
        setTimeout(function(){
            alertInfo.classList.remove('active'); 
        } ,10000);
                    
        contentAlert.classList.add('skep'); 
        setTimeout(function(){
            contentAlert.classList.remove('skep'); 
        } ,8000); 
    }
    

    //deplacement dans l'evolution du formulaires

    function going2(){
        fileForom.style.display = 'none';
        trForom.style.display = 'none';
        iForom.style.display = 'flex';
    }
    function revin3() {
        fileForom.style.display = 'flex';
        iForom.style.display = 'none';
    }
    function going3() {
        iForom.style.display = 'none';
        trForom.style.display = 'flex';
        document.querySelector('.p2').style.backgroundColor = 'rgba(102, 255, 0, 0.333)';
        document.querySelector('.p2').style.borderColor= 'rgb(102, 255, 0)';
        document.querySelector('.v2').style.backgroundColor = 'rgb(102, 255, 0)';
    }
    function revin4() {
        fileForom.style.display = 'none';
        trForom.style.display = 'none';
        iForom.style.display = 'flex';
    }
    function going4() {
        iForom.style.display = 'none';
        trForom.style.display = 'none';
        vldForom.style.display = 'flex';
        document.querySelector('.p3').style.backgroundColor = 'rgba(102, 255, 0, 0.333)';
        document.querySelector('.p3').style.borderColor= 'rgb(102, 255, 0)';
        document.querySelector('.v3').style.backgroundColor = 'rgb(102, 255, 0)';
    }
    // freme une alert
    document.querySelector('.alt_fx').addEventListener('click', () =>{
        contentAlert.classList.remove('skep'); 
    });


    // veriffer si le formulaires a été Bien renplie ou traitement lors de le validations
    document.querySelector('.valid').addEventListener('click', () =>{

        if (document.querySelector('.upfiles').value === "") {
            alertErreur('Veuillez selectionner une videos pour commencer !');
            setTimeout(function(){
                trForom.style.display = 'none';
                fileForom.style.display = 'flex';
                iForom.style.display = 'none';
                vldForom.style.display = 'none';
            }, 3000);
        }
        else if (document.getElementById('agences').value === "") {
            alertErreur('veuillez ramplire le champs Agences');
            setTimeout(function(){
                fileForom.style.display = 'none';
                trForom.style.display = 'none';
                iForom.style.display = 'flex';
                vldForom.style.display = 'none';
            }, 3000);
            
        }
        else{
            document.querySelector('.valid').style.display = 'none';
            document.querySelector('.annule').style.display = 'block';
        }
        

    });
    


    // scrip js pour les animation cosernent le fichire videos
    upFiles.addEventListener('change', () =>{
        document.querySelector('.vid_svg').style.display = 'none';
        const contFiles = upFiles.files;

        document.querySelector('.upsvg').style.display = 'none';
        document.querySelector('.upsvg.fx').style.display = 'none';
        if (contFiles.length !== 0) {

        lectVid.style.display = 'block';
        // valide animetion for the labal to input.files

        document.querySelector('.p1').style.backgroundColor = 'rgba(102, 255, 0, 0.333)';
        document.querySelector('.p1').style.borderColor= 'rgb(102, 255, 0)';
        document.querySelector('.v1').style.backgroundColor = 'rgb(102, 255, 0)';

        animatedElement.classList.add("rotat")
        setTimeout(function(){
            document.querySelector('.upsvg.fx').style.display = 'flex';
            animatedElement.classList.remove("rotat");
        }, 2000)
        }else{

            animatedElement.classList.add("rotat")
            setTimeout(function(){
                document.querySelector('.upsvg').style.display = 'flex';
                document.querySelector('.upsvg.fx').style.display = 'none';
                animatedElement.classList.remove("rotat");
                document.querySelector('.psi2').style.display = 'none';

        }, 2000);
        }
       setTimeout(function () {

            if (contFiles.length === 0) {
                alertErreur('le fichiers a été mal selectionner');
            }
            else{
                document.querySelector('.psi2').style.display = 'block';
                document.querySelector('.psi2').style.minWidth = '75%';
                fileForom.style.display = 'none';
                iForom.style.display = 'flex';
                trForom.style.display = 'none';
                vldForom.style.display = 'none';

                var files = contFiles[0];
                if (files.type.startsWith('video')) {
                    for (const file of contFiles) {
                        lectVid.src = URL.createObjectURL(file);
                        lectVid.controls = 'controls';
                        var filesnam = upFiles.files[0].name;
                        var namFiles = filesnam.replace(/(\.[^.]+)$/,"");

                        document.getElementById('titres').value = namFiles;



                        lectVid.addEventListener('loadedmetadata', function (){
                            const temps = lectVid.duration;
                            if (!isNaN(temps)) {
                                const mm = Math.floor(temps / 60);
                                const s = Math.floor(temps % 60);
                                const h = Math.floor(mm / 60);
                                const H = '00';
                                const lectTemps = h > 0 ?

                                `${h}:${String(mm).padStart(2, '0')}:${String(s).padStart(2, '0')}`:
                                `${H}:${String(mm).padStart(2, '0')}:${String(s).padStart(2, '0')}`;

                                times.value = lectTemps;
                            }
                            else{
                                alertErreur("Une erreur ete detecter veillez reselectionne la videos.");
                                
                            }     
                        });   
                    }
                }
                else{
                    alertErreur("Ce fichier n'est pas pris en charge.");
                }
            }
        }, 3000);
  
    });   


        // chagement couvertures
    cvr.addEventListener('change', () =>{
        // valide animetion for the labal to input.couver

        document.querySelector('.p3').style.backgroundColor = 'rgba(102, 255, 0, 0.333)';
        document.querySelector('.p3').style.borderColor= 'rgb(102, 255, 0)';

        const contcvr = cvr.files;
        if (contcvr.length === 0) {

            alertErreur('le fichiers a ete mal selectionner');
        }
        else{
            var file = contcvr[0];
            if (file.type.startsWith('image')) {
                for (const fil of contcvr) {
                    const lectFile = document.querySelector('.lect.couvers');
                    document.querySelector('.couver_svg').style.display = 'none';
                    document.querySelector('.couvers').style.display = 'block';
                    lectFile.src = URL.createObjectURL(fil);
                }
            }
            else{
                alertErreur("Ce fichier n'est pas pris en charge.");
            }
        }
        
    });


    // pour la progression  au niveau de la publications et validation
    const Forom = document.querySelector('.forom');
    const cuxchange = document.querySelector('.chargement');    
    const vlt = document.querySelector('.evolut');
    const psx = document.querySelector('.pourcantage');
    const filesize = document.querySelector('.filesize');
    var xhr = new XMLHttpRequest();
    
    Forom.addEventListener("submit" , (e)=>{
    e.preventDefault();  
        
        var dataForom = new FormData(Forom);
            
        
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var respx = xhr.response;
                    if (respx.success) {
                        alertInfor(respx.senderreur);
                        setTimeout(function(){
                            window.location.href = "../index";
                        } , 4000);
                    }else{
                        alertErreur(respx.senderreur);
                        document.querySelector('.valid').style.display = 'block';
                        document.querySelector('.annule').style.display = 'none';
                        
                    }
                }else if (xhr.readyState == 4) {
                    console.log("Une erreur c'est produit au niveau du SERVEURE");
                }


            }
            xhr.upload.addEventListener("progress" , ({loaded , total}) => {
                var wd = Math.floor((loaded / total) * 100);
                
                
                cuxchange.style.setProperty("--wd" , `${wd}%`);
                if (wd == 100) {
                    w = "Terminer";
                }else{
                    w = wd + '%';
                }

                vlt.innerHTML = formatFileSize(loaded);
                psx.innerHTML = w;
                filesize.innerHTML = formatFileSize(total)

                

            });
            xhr.open('POST', '../action/sendact.php', true);
            xhr.responseType = "json";

            xhr.send(dataForom);
    });
    // fonction pour convertures les chiffres b les mega (Mb)
    function formatFileSize(e){
        oo = parseInt(e);
        x = oo/1024;
        if (1 <= x < 1024) {
            let exx = x + "ko";  
            if (1024 <= x < 1048576) {
                let ex = x/1024;
                let exx  = ex.toFixed(2) + "Mo";
                if(1048576 <= x ) {
                    let ex = x/1048576;
                    let exx  = ex.toFixed(2) + "Go";
                    return exx ;  
                }
                return exx ; 
            }
            return exx;
        }  
    };



    // anuler l'nvoies du formulaires
    cancel.addEventListener('click', e => {
        e.preventDefault();

        
        if (cancel_state) {
            xhr.abort();
            Forom.reset();
            cancel.innerHTML = "Annulé";
            setTimeout(() => {
            cancel.innerHTML = "Fermer";
            }, 500);
            cancel_state = false;
        }else{
            window.location.href = "../index";
        }
    });

    // pour la selection des cathegories
    
    document.querySelector(".options").addEventListener('change', e => {
        e.preventDefault();  
        var xht = new XMLHttpRequest();
        xht.onreadystatechange = function(){     
            if (xht.readyState === 4 && xht.status === 200) {
                document.querySelector(".list_cath").innerHTML = this.response;
            }
        }
    var name = encodeURIComponent(document.getElementById('options').value);
    xht.open("POST", "getadmin/selectcath.php" , true);
    xht.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xht.send("options="+name);
    });

    // poure le chargement des Playlist
    document.querySelector(".options").addEventListener('change', e => {
        e.preventDefault();  
        var xht = new XMLHttpRequest();
        xht.onreadystatechange = function(){     
            if (xht.readyState === 4 && xht.status === 200) {
                document.querySelector(".list_plx").innerHTML = this.response;
            }
        }
    var name = encodeURIComponent(document.getElementById('options').value);
    xht.open("POST", "getadmin/selectplx.php" , true);
    xht.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xht.send("options="+name);
    });


    // 
    document.querySelector('.valid').addEventListener('click' , () => {
        
    });





//  generation de l'image
document.querySelector('.btn_genere').addEventListener('click' , () => {
    var videoInput = document.querySelector('.upfiles');
            
    // Vérifier si un fichier vidéo a été sélectionné
    if (videoInput.files.length > 0) {
        var videoURL = URL.createObjectURL(videoInput.files[0]);
        processVideo(videoURL)
    }
    
})
    function processVideo(file) {

        // Créer un élément video pour lire le fichier
        let video = document.createElement("video");
        // Définir la source de la vidéo avec l'URL temporaire du fichier
        video.src = file;
        // Définir une fonction à exécuter lorsque les métadonnées du fichier sont chargées
        video.addEventListener("loadedmetadata", () => {
          // Récupérer la durée du fichier en secondes
          var duration = video.duration;
      
          // Générer un nombre aléatoire entre 0 et la durée
          var random = Math.random() * duration;
      
          // Définir le temps actuel du fichier avec le nombre aléatoire
          video.currentTime = random;
      
          // Définir une fonction à exécuter lorsque le fichier est prêt à être capturé
          video.addEventListener("seeked", () => {
              processCanvas(video, video.videoWidth, video.videoHeight);
            
          });
        });
      
      }
      
    function processCanvas(media, width, height) {
        media_width = media.width || media.videoWidth;
        media_height = media.height || media.videoHeight;
        // Créer un élément canvas pour dessiner l'image
        var canvas = document.createElement("canvas");
      
        // Récupérer le contexte 2D du canvas
        var context = canvas.getContext("2d");
      
        // Déterminer les dimensions du canvas en fonction du format 16/9
        var ratio = width / height;
      
        if (ratio > 16 / 9) {
          // L'image est trop large, on la recadre horizontalement
          width = (height * 16) / 9;
          canvas.width = width;
          canvas.height = height;
          context.drawImage(
            media, (media_width - width) / 2,
            0, width, height, 0, 0, width, height
          );
        } else if (ratio < 16 / 9) {
          // L'image est trop haute, on la recadre verticalement
          height = (width * 9) / 16;
          canvas.width = width;
          canvas.height = height;
          context.drawImage(
            media, 0, (media_height - height) / 2, width,
            height, 0, 0,
            width, height
          );
        } else {
          // L'image est déjà au format 16/9, on la conserve telle quelle
          canvas.width = width;
          canvas.height = height;
          context.drawImage(media, 0, 0);
        }
        var imageData = canvas.toDataURL('image/jpeg');
        
        document.querySelector('.couvers').src = imageData;
        document.querySelector('.couver_svg').style.display = 'none';
        document.querySelector('.couvers').style.display = 'block';
        var mycanvas = document.querySelector('#mycanvas');
        var mycavsContent = mycanvas.value;
        
        // Convertir l'image en webp avec une qualité de 100%
        canvas.toBlob(blob => {
            var xhrx = new XMLHttpRequest();
            // Créer un objet FormData pour envoyer le blob au serveur
            var form = new FormData();
            form.append("image", blob);
            form.append("mycavsContent", mycavsContent);
            // Ouvrir la connexion avec le fichier PHP qui va traiter l'image
            xhrx.open('POST', '../async/couver.php', true);

            // Envoyer la requête avec le formulaire contenant l'image
            xhrx.responseType = "json";
            xhrx.send(form);

            
            // a reupere le non du fiier et l'uploader
            xhrx.onload = function(){
                if (xhrx.readyState == 4 && xhrx.status == 200) {
                    var repx = xhrx.response;
                    console.log(repx);
                    if (repx.recu) {
                        mycanvas.value = repx.cavx;
                    }
                    else{
                        alertErreur(repx.cavx);
                    }
                }
                else if(xhrx.readyState == 4){
                    console.log('eurror systeme ');
                }  
            };
            
        }, "image/jpeg");

    }

    