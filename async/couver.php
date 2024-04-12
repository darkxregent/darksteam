<?php
require('../action/act.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
    
    if (isset($_POST['mycavsContent']) && !empty($_POST['mycavsContent'])) {
        $cavxName = $_POST['mycavsContent'];
        $cavxUrl = "../filesdir/couvers/" .$cavxName;
        if (file_exists($cavxUrl)) {
            unlink($cavxUrl);
        }
    }
    $fileName = $_FILES['image']['name']; // Le nom original du fichier   
    $fileType = $_FILES['image']['type']; // Le type du fichier (ex: image/webp)
    $fileSizei = $_FILES['image']['size'];
    $fileTmpName = $_FILES['image']['tmp_name']; // Le nom temporaire du fichier
    $romdfilesi = uniqid() . ".jpeg"; // Le nouveau nom du fichier
    $chenincouver = "../filesdir/couvers/" .$romdfilesi;
    $couverCanvas = move_uploaded_file($fileTmpName, $chenincouver);

    echo json_encode(['recu' => 1 , 'cavx' => $romdfilesi]);
}else{
    $errorcavx = "une error a été détécter , veillez resillez";
    echo json_encode(['recu' => 0 , 'cavx' => $errorcavx]);
}



?>