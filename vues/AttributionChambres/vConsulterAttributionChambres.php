<?php

include("_debut.inc.php");

// CONSULTER LES ATTRIBUTIONS DE TOUS LES ÉTABLISSEMENTS
// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT OFFRANT DES CHAMBRES POUR QUE 
// L'AFFICHAGE SOIT EFFECTUÉ
$nbEtabOffrantChambres = modele\dao\AttribDAO::obtenirNbEtabOffrantChambres();
if (isset($_SESSION['pseudo'])) {
    $privil = \modele\dao\UserDAO::getPrivilegeByPseudo($_SESSION['pseudo']);
}
if ($nbEtabOffrantChambres != 0) {
    if (isset($_SESSION['pseudo']) && $privil == '1') {
        echo "
   <center> <a href='cAttributionChambres.php?action=demanderModifierAttrib'>
   Effectuer ou modifier les attributions</a> <br> <br>";
    }
        // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE D'UN TABLEAU COMPORTANT 2 LIGNES 
        // D'EN-TÊTE (LIGNE NOM ET LIGNE DISPONIBILITÉS) ET LE DÉTAIL DES ATTRIBUTIONS
        // Détermination du :
        //    . % de largeur que devra occuper chaque colonne contenant les attributions
        //      (100 - 35 pour la colonne d'en-tête) / nb de types chambres
        //    . nombre de colonnes de chaque tableau
        $pourcCol = 65 / $nbTypesChambres;
        $nbCol = $nbTypesChambres + 1;

        // BOUCLE SUR LES ÉTABLISSEMENTS
        while ($lgEtab = $rsEtab->fetch(PDO::FETCH_ASSOC)) {
            $idEtab = $lgEtab['id'];
            $nomEtab = $lgEtab['nom'];

            echo "
      <table width='70%' cellspacing='0' cellpadding='0' class='tabQuadrille'>";

            // AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE
            echo "
         <tr class='enTeteTabQuad'>
            <td colspan='$nbCol'><strong>$nomEtab</strong></td>
         </tr>";

            // AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE : 1 LIT : NOMBRE DE CHAMBRES 
            // DISPONIBLES, 2 À 3 LITS : NOMBRE DE CHAMBRES DISPONIBLES...  
            echo "
         <tr class='enTete2TabQuad'>
      
            <td width='35%'><i>Disponibilités</i></td>";

            $rsTypeChambre = modele\dao\AttribDAO::obtenirTypesChambres();

            // BOUCLE SUR LES TYPES DE CHAMBRES 
            while ($lgTypeChambre = $rsTypeChambre->fetch(PDO::FETCH_ASSOC)) {
                $idTypeChambre = $lgTypeChambre['id'];
                $libelle = $lgTypeChambre['libelle'];
                // On recherche les disponibilités pour l'établissement et le type
                // de chambre en question
                $nbChDispo = modele\dao\AttribDAO::obtenirNbDispo($idEtab, $idTypeChambre);
                echo "<td><center>$libelle<br>$nbChDispo</center></td>";
            }
            echo "
         </tr>";

            // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ 
            // DANS L'ÉTABLISSEMENT

            $rsGroupe = modele\dao\AttribDAO::obtenirGroupesEtab($idEtab);

            // BOUCLE SUR LES GROUPES (CHAQUE GROUPE EST AFFICHÉ EN LIGNE)
            while ($lgGroupe = $rsGroupe->fetch(PDO::FETCH_ASSOC)) {
                $idGroupe = $lgGroupe['id'];
                $nomGroupe = $lgGroupe['nom'];
                echo "
            <tr class='ligneTabQuad'>
               <td width='35%'>&nbsp;$nomGroupe</td>";
                $rsTypeChambre = modele\dao\AttribDAO::obtenirIdTypesChambres();

                // BOUCLE SUR LES TYPES DE CHAMBRES (CHAQUE TYPE DE CHAMBRE 
                // FIGURE EN COLONNE)
                while ($lgTypeChambre = $rsTypeChambre->fetch(PDO::FETCH_ASSOC)) {
                    // On recherche si des chambres du type en question ont 
                    // déjà été attribuées à ce groupe dans l'établissement
                    $nbOccupGroupe = modele\dao\AttribDAO::obtenirNbOccupGroupe($idEtab, $lgTypeChambre["id"], $idGroupe);
                    echo "
                  <td width='$pourcCol%'><center>$nbOccupGroupe</center></td>";
                } // Fin de la boucle sur les types de chambres
                echo "
            </tr>";
            } // Fin de la boucle sur les groupes
            echo "
      </table>
      <br>";
        } // Fin de la boucle sur les établissements
    }

    include("_fin.inc.php");

    