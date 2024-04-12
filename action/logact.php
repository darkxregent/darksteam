<?php 
require("act.php");

if (isset($_SESSION['auth']) && $_SESSION['auth']) {
    header('location: ../index.php');
}


if (isset($_POST['getinsc'])) {

    if (!empty($_POST['pseudo']) && !empty($_POST['email']) &&
     !empty($_POST['mdp']) && !empty($_POST['confir_mdp']) &&
      !empty($_POST['age']) &&
       !empty($_POST['Genre']) ) {
        
        $ps = analyse($_POST['pseudo']);
        $el = analyse($_POST['email']);
        $mdp = analyse($_POST['mdp']);
        $conf = analyse($_POST['confir_mdp']);
        $age = analyse($_POST['age']);
        $gr = analyse($_POST['Genre']);
        
        if ($mdp == $conf) {
            if ($age >= 18) {
                
                $dirfile = "../filesdir/avatares";
                $file = basename($_FILES['avatar']['name']);
                $extens =  pathinfo($file, PATHINFO_EXTENSION);
                $newfilenam = uniqid().'.'.$extens;
                $fileurl = $dirfile .$newfilenam;
                $img = move_uploaded_file($_FILES['avatar']['tmp_name'] , $fileurl);

                $avatr = $newfilenam;

                $selps = $bdd -> prepare("SELECT * FROM user WHERE pseudo = ?");
                $selps -> execute(array($ps));
                $selt = $selps -> fetchall();
                if (count($selt) == 0) {
                    
                    $resqinstr = "INSERT INTO user(pseudo, email, mdp, ages, genre, avatar) VALUES(?,?,?,?,?,?)";
                    $instr = $bdd -> prepare($resqinstr);
                    $instr -> execute(array($ps, $el, $mdp, $age, $gr, $avatr));

                    $seluser1 = $bdd -> prepare("SELECT * FROM user WHERE pseudo = ?");
                    $seluser1 -> execute(array($ps));
                    $seluser = $seluser1 -> fetch();
                    

                    $_SESSION['auth'] = true;
                    $_SESSION['id_user'] = $seluser['id_user'];
                    $_SESSION['pseudo'] = $seluser['pseudo'];
                    $_SESSION['email'] = $seluser['email'];
                    $_SESSION['mdp'] = $seluser['mdp'];
                    $_SESSION['ages'] = $seluser['ages'];
                    $_SESSION['genre'] = $seluser['genre'];
                    $_SESSION['avatar'] = $seluser['avatar'];
                    
                    setcookie('log',$age,time() + 365 * 24 * 3600 ,null,null,false,true);

                    header('location: ../index.php');
                }
                else {
                    $erreur = "Ce pseudo est deja utiliser.";
                    return $erreur;
                }
            }
            else {
                setcookie('log',$age,time() + 365 * 24 * 3600 ,null,null,false,true);
                header('location: ?rev');
            }
            
        }
        else {
            $erreur = "champs du mots de passe incorrete.";
            return $erreur;
        }
    }
    else {
        $erreur = "Veuillez remplir tout les champs .";
        return $erreur;
    }
}


if (isset($_POST['getlog']) ) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp']) ) {
        
        $ps = analyse($_POST['pseudo']);
        // $el = analyse($_POST['email']);
        $mdp = analyse($_POST['mdp']);
        
            $selps = $bdd -> prepare("SELECT * FROM user WHERE pseudo = ?");
            $selps -> execute(array($ps));
            $selt = $selps -> fetchall();
            if (count($selt) != 0) {
                
                $seluser1 = $bdd -> prepare("SELECT * FROM user WHERE pseudo = ?");
                $seluser1 -> execute(array($ps));
                $seluser = $seluser1 -> fetch();

                if (isset($_COOKIE['log'])) {
                    if ($_COOKIE['log'] >= 18) {
                        
                        $_SESSION['auth'] = true;
                        $_SESSION['id_user'] = $seluser['id_user'];
                        $_SESSION['pseudo'] = $seluser['pseudo'];
                        $_SESSION['email'] = $seluser['email'];
                        $_SESSION['mdp'] = $seluser['mdp'];
                        $_SESSION['ages'] = $seluser['ages'];
                        $_SESSION['genre'] = $seluser['genre'];
                        $_SESSION['avatar'] = $seluser['avatar'];
                        header('location: ../index.php');
                    }
                    else {
                        header('location: login.php');
                    }
                }
                else {
                    $_SESSION['auth'] = true;
                    $_SESSION['id_user'] = $seluser['id_user'];
                    $_SESSION['pseudo'] = $seluser['pseudo'];
                    $_SESSION['email'] = $seluser['email'];
                    $_SESSION['mdp'] = $seluser['mdp'];
                    $_SESSION['ages'] = $seluser['ages'];
                    $_SESSION['genre'] = $seluser['genre'];
                    $_SESSION['avatar'] = $seluser['avatar'];

                    $age =  $seluser['ages'];
                    setcookie('log',$age,time() + 365 * 24 * 3600 ,null,null,false,true);
                    header('location: ../index.php');
                }
                
            }
            else {
                $erreur = "Pseudo incorect .";
                return $erreur;
            }
    }
    else {
        $erreur = "Veuillez remplir tout les champs .";
        return $erreur;
    }
}
    

?>