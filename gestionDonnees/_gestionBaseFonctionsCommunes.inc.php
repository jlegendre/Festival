<?php

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirIdNomEtablissements($connexion) {
    $req = "SELECT id, nom FROM etablissement ORDER BY id";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirIdNomEtablissementsOffrantChambres($connexion) {
    $req = "SELECT DISTINCT id, nom FROM etablissement e 
                INNER JOIN offre o ON e.id = o.idEtab 
                ORDER BY id";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirNomEtablissementsOffrantChambres($connexion) {
    $req = "SELECT DISTINCT nom FROM etablissement e 
                INNER JOIN offre o ON e.id = o.idEtab 
                ORDER BY id";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirIdEtablissementsOffrantChambres($connexion) {
    $req = "SELECT DISTINCT id FROM etablissement e 
                INNER JOIN offre o ON e.id = o.idEtab 
                ORDER BY id";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirDetailEtablissement($connexion, $id) {
    $req = "SELECT * FROM etablissement WHERE id=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function supprimerEtablissement($connexion, $id) {
    $req = "DELETE FROM etablissement WHERE id=?";
    $stmt = $connexion->prepare($req);
    $ok = $stmt->execute(array($id));
    return $ok;
}

function creerModifierEtablissement($connexion, $mode, $id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable) {
    /* INUTILE Avec requêtes préparées
    $nom = addslashes($nom);
    $adresseRue = str_replace("'", "''", $adresseRue);
    $ville = str_replace("'", "''", $ville);
    $adresseElectronique = str_replace("'", "''", $adresseElectronique);
    $nomResponsable = str_replace("'", "''", $nomResponsable);
    $prenomResponsable = str_replace("'", "''", $prenomResponsable);
     * 
     */
    if ($mode == 'C') {
        $req = "INSERT INTO etablissement VALUES (:id, :nom, :rue, :cdp, :ville, :tel, :email, :type, :civ, :nomResp, :prenomResp)";
    } else {
        $req = "UPDATE etablissement SET nom=:nom, adresseRue=:rue,
           codePostal=:cdp, ville=:ville, tel=:tel,
           adresseElectronique=:email, type=:type,
           civiliteResponsable=:civ, nomResponsable=:nomResp, prenomResponsable=:prenomResp 
           WHERE id=:id";
    }
    $stmt = $connexion->prepare($req);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':rue', $adresseRue);
    $stmt->bindParam(':cdp', $codePostal);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':email', $adresseElectronique);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':civ', $civiliteResponsable);
    $stmt->bindParam(':nomResp', $nomResponsable);
    $stmt->bindParam(':prenomResp', $prenomResponsable);
    $ok = $stmt->execute();
    return $ok;
}

function estUnIdEtablissement($connexion, $id) {
//    global $connexion;
    $req = "SELECT COUNT(*) FROM etablissement WHERE id=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetchColumn();
}

function estUnNomEtablissement($connexion, $mode, $id, $nom) {
//    global $connexion;
    $nom = str_replace("'", "''", $nom);
    // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
    // on vérifie la non existence d'un autre établissement (id!='$id') portant 
    // le même nom
    if ($mode == 'C') {
        $req = "SELECT COUNT(*) FROM etablissement WHERE nom=?";
        $stmt = $connexion->prepare($req);
        $stmt->execute(array($nom));
    } else {
        $req = "SELECT COUNT(*) FROM etablissement WHERE nom=? AND id<>?";
        $stmt = $connexion->prepare($req);
        $stmt->execute(array($nom, $id));
    }
    return $stmt->fetchColumn();
}

function obtenirNbEtab($connexion) {
//    global $connexion;
    $req = "SELECT COUNT(*) FROM etablissement";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function obtenirNbEtabOffrantChambres($connexion) {
//    global $connexion;
    $req = "SELECT COUNT(DISTINCT idEtab) FROM offre";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// FONCTIONS DE GESTION DES TYPES DE CHAMBRES

function obtenirTypesChambres($connexion) {
    $req = "SELECT * FROM typechambre";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirIdTypesChambres($connexion) {
    $req = "SELECT id FROM typechambre";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirLibelleTypesChambres($connexion) {
    $req = "SELECT libelle FROM typechambre ORDER BY id";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirLibelleTypeChambre($connexion, $id) {
    $req = "SELECT libelle FROM typechambre WHERE id = ?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetchColumn();
}

function obtenirNbTypesChambres($connexion) {
    $req = "SELECT count(*) FROM typechambre";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function supprimerTypeChambre($connexion, $id) {
    $req = "DELETE FROM typechambre WHERE id=?";
    $stmt = $connexion->prepare($req);
    $ok = $stmt->execute(array($id));
    return $ok;
}

function obtenirDetailTypeChambre($connexion, $id) {
    $req = "SELECT * FROM typechambre WHERE id=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt;
}

function creerModifierTypeChambre($connexion, $mode, $id, $libelle) {
    $libelle = str_replace("'", "''", $libelle);
    if ($mode == 'C') {
        $req = "INSERT INTO typechambre VALUES (:id, :lib)";
    } else {
        $req = "UPDATE typechambre SET libelle=:lib WHERE id=:id";
    }
    $stmt = $connexion->prepare($req);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':lib', $libelle);
    $ok = $stmt->execute();
    return $ok;
}

function estUnIdTypeChambre($connexion, $id) {
    $req = "SELECT COUNT(*) FROM typechambre WHERE id=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetchColumn();
}

function estUnLibelleTypeChambre($connexion, $mode, $id, $libelle) {
    $libelle = str_replace("'", "''", $libelle);
    // S'il s'agit d'une création, on vérifie juste la non existence du libellé
    // sinon on vérifie la non existence d'un autre type chambre (id!='$id') 
    // ayant le même libelle
    if ($mode == 'C') {
        $req = "SELECT COUNT(*) FROM typechambre WHERE libelle=:lib";
        $stmt = $connexion->prepare($req);
        $stmt->bindParam(':lib', $libelle);
    } else {
        $req = "SELECT COUNT(*) FROM typechambre WHERE libelle=:lib and id <> :id";
        $stmt = $connexion->prepare($req);
        $stmt->bindParam(':lib', $libelle);
        $stmt->bindParam(':id', $id);
    }
    $stmt->execute();
    return $stmt->fetchColumn();
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirIdNomGroupesAHeberger($connexion) {
    $req = "SELECT id, nom FROM groupe WHERE hebergement='O' ORDER BY id";
    $stmt = $connexion->prepare($req);
    $stmt->execute();
    return $stmt;
}

function obtenirNomGroupe($connexion, $id) {
    $req = "SELECT nom FROM groupe WHERE id=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetchColumn();
}

// FONCTIONS RELATIVES AUX OFFRES
// Met à jour (suppression, modification ou ajout) l'offre correspondant à l'id
// étab et à l'id type chambre transmis
function modifierOffreHebergement($connexion, $idEtab, $idTypeChambre, $nbChambresDemandees) {
    if ($nbChambresDemandees == 0) {
        $req = "DELETE FROM offre WHERE idEtab=:idEtab and idTypeChambre=
           :idTypeCh";
        $stmt = $connexion->prepare($req);
        $stmt->bindParam(':idEtab', $idEtab);
        $stmt->bindParam(':idTypeCh', $idTypeChambre);
    } else {
        $req2 = "SELECT nombreChambres FROM offre WHERE idEtab=:idEtab AND 
        idTypeChambre=:idTypeCh";
        $stmt2 = $connexion->prepare($req2);
        $stmt2->bindParam(':idEtab', $idEtab);
        $stmt2->bindParam(':idTypeCh', $idTypeChambre);
        $stmt2->execute();
        $lgOffre = $stmt2->fetchColumn();
        if ($lgOffre != 0) {
            $req = "UPDATE offre SET nombreChambres=:nb 
                WHERE idEtab=:idEtab AND idTypeChambre=:idTypeCh";
        } else {
            $req = "INSERT INTO offre VALUES(:idEtab, :idTypeCh, :nb)";
        }
        $stmt = $connexion->prepare($req);
        $stmt->bindParam(':idEtab', $idEtab);
        $stmt->bindParam(':idTypeCh', $idTypeChambre);
        $stmt->bindParam(':nb', $nbChambresDemandees);
    }
    $ok = $stmt->execute();
    return $ok;
}

// Retourne le nombre de chambres offertes pour l'id étab et l'id type chambre 
// transmis
function obtenirNbOffre($connexion, $idEtab, $idTypeChambre) {
    $req = "SELECT nombreChambres FROM offre WHERE idEtab=:idEtab AND 
        idTypeChambre=:idTypeCh";
    $stmt = $connexion->prepare($req);
    $stmt->bindParam(':idEtab', $idEtab);
    $stmt->bindParam(':idTypeCh', $idTypeChambre);
    $stmt->execute();
    $ok = $stmt->fetchColumn();
    if ($ok) {
        return $ok;
    } else {
        return 0;
    }
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement et le type de chambre transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $idTypeChambre, $nombreChambres) {
    $nbOccup = obtenirNbOccup($connexion, $idEtab, $idTypeChambre);
    return ($nombreChambres >= $nbOccup);
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS
// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id) {
    $req = "SELECT COUNT(*) FROM attribution WHERE idEtab=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetchColumn();
}

// Teste la présence d'attributions pour le type de chambre transmis 
function existeAttributionsTypeChambre($connexion, $id) {
    $req = "SELECT COUNT(*) FROM attribution WHERE idTypeChambre=?";
    $stmt = $connexion->prepare($req);
    $stmt->execute(array($id));
    return $stmt->fetchColumn();
}

// Retourne le nombre de chambres occupées pour l'id étab et l'id type chambre
// transmis
function obtenirNbOccup($connexion, $idEtab, $idTypeChambre) {
    $req = "SELECT IFNULL(SUM(nombreChambres), 0) AS totalChambresOccup FROM
        attribution WHERE idEtab=:idEtab AND idTypeChambre=:idTypeCh";
    $stmt = $connexion->prepare($req);
    $stmt->bindParam(':idEtab', $idEtab);
    $stmt->bindParam(':idTypeCh', $idTypeChambre);
    $stmt->execute();
    $nb = $stmt->fetchColumn();
    return $nb;
}
