<?php

namespace modele\dao;

use modele\Connexion;

class ClientDAO {

    public static function verification($pseudo, $password) {
        $cnx = Connexion::connecter(); // fonction définie par ailleurs
        // préparation de la requête
        $pseudoSql = $cnx->quote($pseudo);
        $passwordSql = $cnx->quote(($password)); // le mot de passe est chiffré dans la BDD
        $sql = "SELECT COUNT(*) as id FROM users WHERE pseudo=$pseudoSql AND
   password=$passwordSql";
        $result = $cnx->query($sql);
        $row = $result->fetch();
        $cnx = "";
        return ($row['id'] == 1);
    }

}
