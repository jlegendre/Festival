<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<?php include ("_debut.inc.php");
?>
<br><br>
<table width = '95%'>

    <tr>
        <td class = 'texteAccueil'>
        </td>
    </tr>
    <tr>
        <td >
        </td>
    </tr>
    <tr>
        <td >
        </td>
    </tr>
    <tr>
        <td class = 'texteAccueil'>
            Cette application web permet de gérer l'hébergement des groupes de musique 
            durant le festival Folklores du Monde.
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td class='texteAccueil'>
            Elle offre les services suivants :
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td class='texteAccueil'>
            <ul>
                <li>Consulter, créer, modifier ou supprimer des établissements acceptant d'héberger les groupes de musiciens.
                    <p>
                    </p>
                <li>Consulter, créer, modifier ou supprimer des caractéristiques de chambres.
                    <p>
                    </p>
                <li>Consulter, déclarer ou modifier les capacités d'accueil des établissements.
                    <p>
                    </p>
                <li>Consulter, réaliser ou modifier les attributions des chambres aux groupes dans les établissements.
            </ul>
        </td>
    </tr>
</table>
<?php
//$pseudo = (isset ($_SESSION ["pseudo"])) ? $_SESSION ["pseudo"] : "visitor";
//$privilège = (isset ($_SESSION ["privilège"])) ? $_SESSION ["privilège"] : "aucun";

if (!isset($_SESSION ["pseudo"])) {
    include ("vues/Accueil/Authentification.php");
} else {
    if (isset($_SESSION['pseudo']) && ($_SESSION['pseudo'] == 'Mairie')) {
        ?><br><br><br><?php echo "Vous êtes connecté en tant qu'Admin." ?>
        <?php
    }
    
    ?><form action = "cDeconnexion.php" method = "post">
        <br><br>
        <input type = "submit" class="btn btn-success" value = "Se Déconnecter"/><form>
            <?php
        }
        ?>
        <?php
        include ("_fin.inc.php");

        