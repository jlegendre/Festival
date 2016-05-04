<?php
namespace modele\dao;

use modele\dao\DAO;
use modele\Connexion;
use \PDO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDAO
 *
 * @author Admin
 */
class UserDAO implements DAO {
    public static function delete($idMetier) {
        
    }

    public static function enregistrementVersObjet($unEnregistrement) {
        
    }

    public static function getAll() {
        
    }

    public static function getOneById($valeurClePrimaire) {
        
    }
    
    public static function getIdByPseudo($pseudo) {
        $retour = null;
        try {
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "SELECT id FROM users WHERE pseudo = ?";
            // préparer la requête PDO
            $queryPrepare = Connexion::connecter()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($pseudo))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $enregistrement['id'];
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }
    
    public static function getPrivilegeByPseudo($pseudo) {
        $retour = null;
        try {
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "SELECT privilège FROM users WHERE pseudo = ?";
            // préparer la requête PDO
            $queryPrepare = Connexion::connecter()->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($pseudo))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $enregistrement['privilège'];
            }
        } catch (PDOException $e) {
            echo get_class() . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }

    public static function insert($objetMetier) {
        
    }

    public static function objetVersEnregistrement($objetMetier) {
        
    }

    public static function update($idMetier, $objetMetier) {
        
    }

//put your code here
}
