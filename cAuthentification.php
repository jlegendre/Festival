<?php

use modele\dao\ClientDAO;

require_once "_gestionErreurs.inc.php";
require_once "./includes/fonctions.inc.php";

session_start();
if (isset($_POST['pseudo']) && isset($_POST['password'])) {
    $pseudo = $_POST['pseudo'];
    $password = sha1($_POST['password']);
    if (ClientDAO::verification($pseudo, $password)) { // vérifier dans la BDD
        // changer l'identification de session (sécurité)
        session_regenerate_id();
        $_SESSION['pseudo'] = $pseudo; // service minimum
        $message = "BIENVENUE";
        header('Location:index.php');
    } else {
        
        header("refresh:0; url=erreur.php");
        $message = "";
        
    }
} else {
    $message = "le login ou le mot de passe ne sont pas renseignés";
    $message .= "<br/><a href=\"index.php\">retour</a>";
}
echo $message;
?>