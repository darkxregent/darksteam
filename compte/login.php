<?php
require('../action/logact.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/allcss.css">
    <link rel="stylesheet" href="../asset/logstyles.css">
    <title>login</title>
</head>
<body>
<?php
if (isset($_GET["insc"])) {
    
?>     
    <form  method="post" enctype="multipart/form-data" class="forom_loget">
        <h2>Bienvenue sur DarkSteam</h2>
        <center><p>
            <?php
            if (isset($erreur)) {
                echo $erreur;
            }
            ?>
        </p></center>
        <div>
            <label for="ps">Pseudo</label>
            <input type="text" name="pseudo" placeholder="plus de 4 et mois de 16 carrectaires" minlength="4" maxlength="17" id="ps" required>
        </div>
        <div>
            <label for="el">Email</label>
            <input type="email" name="email" minlength="4" placeholder="Ex: @gmail.com" maxlength="28" id="el" required>
        </div>
        <div>
            <label for="pass">Mots de passe</label>
            <input type="password" name="mdp" minlength="4" placeholder="* * * * * * * *" maxlength="12" id="pass" required>
        </div>
        <div>
            <label for="c_pass">Confirme mots de passe</label>
            <input type="password" name="confir_mdp" minlength="4" placeholder="* * * * * * * *" maxlength="12" id="c_pass" required>
        </div>
        <div>
            <label for="age">Ages</label>
            <input type="number" name="age" placeholder="16" maxlength="2" id="age" required>
        </div>
        <div>
            <label for="avatar">Ajoutes une images de profiles</label>
            <input type="file" name="avatar" id="avatar" required>
        </div>
        <div class="genre_types">
            <label>sexe:</label>
            <div>
                <label for="ff">Femme</label>
                <input type="radio" name="Genre" id="ff" value="XX" required>
            </div>
            <div>
                <label for="mm">Homme</label>
                <input type="radio" name="Genre" id="mm" value="XY" required>
            </div>
        </div>
        <div class="accept">
            <input type="checkbox" name="accept" id="vald" value="vald" required>
            <label for="vald">j'ai lue et assepte les conditin d'utilisation et la politique de confidencialiter</label>
        </div>

        <button type="submit" name="getinsc" class="getsub">inscription</button>
    </form>

<?php
}
if (isset($_GET["login"])) {
?> 


    <form method="post" enctype="multipart/form-data" class="forom_loget cont">
        <h2 class="forom_title">Bon retour sur DarkStream</h2>
        <div>
            <label for="ps">Pseudo</label>
            <input type="text" name="pseudo" placeholder="votre pseudo" minlength="4" maxlength="17" id="ps" required>
        </div>
        <div>
            <label for="pass">Mots de passe</label>
            <input type="password" name="mdp" placeholder=" * * * * * * * *" minlength="4" maxlength="12" id="pass" required>
        </div>
        <div class="mdp_ob">
            <p>mots de pass oublier <a href="">click ici </a></p>
        </div>
        <button type="submit" name="getlog" class="getsub">connexion</button>
    </form>

<?php
}
if (isset($_GET["rev"]) ) {
?> 
    
    <div class="forom_loget cont ext" >
        <h3>Desole vous ete  encore mineures</h3>
        <button>Quiter</button>
    </div>
    
<?php
}    
if (!isset($_GET["insc"]) && !isset($_GET["login"])  && !isset($_GET["rev"])) {  
 

if (!isset($_COOKIE['log'])) {
    ?>
    <div class="forom_loget cont int" >
        <h3 class="int title"><img src="../darck_logo.png" class="logo"  alt="logo de DarkSteam">DarkStream</h3>
    
        <h3>Aviez-vous deja un compte</h3>
        
        <div class="genre_types">
            <a class="submit" href="?insc">NON</a>
            <a class="submit" href="?login">OUI</a>
        </div>
    </div>
    <?php
    }
    else {
        if ($_COOKIE['log'] >= 18) {
            header('location: '.$domainhost.'/compte/login.php?login');
        }
        else {
            header('location: '.$domainhost.'/compte/login.php?rev');
        }
    }
}    
?>

</body>
</html>