<?php

include("_debut.inc.php");

require_once(__DIR__ . "/../../includes/fonctions.inc.php");
// CONSULTER LES OFFRES DE TOUS LES ÉTABLISSEMENTS
// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT ET UN TYPE CHAMBRE POUR QUE 
// L'AFFICHAGE SOIT EFFECTUÉ


if (isset($_SESSION['pseudo'])) {
    $privil = \modele\dao\UserDAO::getPrivilegeByPseudo($_SESSION['pseudo']);
}
if ($nbEtab != 0 && $nbTypesChambres != 0) {
    // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE DU NOM ET D'UN TABLEAU COMPORTANT 1
    // LIGNE D'EN-TÊTE ET 1 LIGNE PAR TYPE DE CHAMBRE
    // BOUCLE SUR LES ÉTABLISSEMENTS
    for ($i = 0; $i < count($arrayEtab); $i++) {
        $unEtab = $arrayEtab[$i];
        $idEtab = $unEtab->getId();
        $nom = $unEtab->getNom();
        if (isset($_SESSION['pseudo']) && ($_SESSION['pseudo'] == 'Mairie' || $_SESSION['pseudo'] == $idEtab)) {
            $access = '1';
        } else {
            $access = '0';
        }
        // AFFICHAGE DU NOM DE L'ÉTABLISSEMENT ET D'UN LIEN VERS LE FORMULAIRE DE
        // MODIFICATION
        echo "<strong>$nom</strong><br>";
        if (isset($_SESSION['pseudo']) && ($privil == '1' || $privil == '10') && $access == '1') {
            echo "<a href='cOffreHebergement.php?action=demanderModifierOffre&idEtab=$idEtab'>
      Modifier</a>";
        }
        echo "<table width='45%' cellspacing='0' cellpadding='0' class='tabQuadrille'>";

        // AFFICHAGE DE LA LIGNE D'EN-TÊTE
        echo "
         <tr class='enTeteTabQuad'>
            <td width='30%'>Type</td>
            <td width='35%'>Capacité</td>
            <td width='35%'>Nombre de chambres</td> 
         </tr>";



        // BOUCLE SUR LES TYPES DE CHAMBRES (AFFICHAGE D'UNE LIGNE PAR TYPE DE 
        // CHAMBRE AVEC LE NOMBRE DE CHAMBRES OFFERTES DANS L'ÉTABLISSEMENT POUR 
        // LE TYPE DE CHAMBRE)

        for ($z = 0; $z < count($arrayTypeChambre); $z++) {
            $unTypeChambre = $arrayTypeChambre[$z];
            $idTypeChambre = $unTypeChambre->getId();
            $libelle = $unTypeChambre->getLibelle();


            echo " 
            <tr class='ligneTabQuad'>
               <td>$idTypeChambre</td>
               <td>$libelle</td>";
            // On récupère le nombre de chambres offertes pour l'établissement 
            // et le type de chambre actuellement traités
            $nbOffre = modele\dao\OffreDAO::obtenirNbOffre($idEtab, $idTypeChambre);
            echo "
               <td>$nbOffre</td>
            </tr>";
        }
        echo "
      </table><br>";
    }
}

include("_fin.inc.php");

