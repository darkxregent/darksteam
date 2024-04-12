<?php
require('../action/act.php');

$success = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['auth']) {
        session_destroy();
        $success = 1;
    }
$respx = ["success" => $success];
echo json_encode($respx);
}
?>