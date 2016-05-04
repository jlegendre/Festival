<?php

namespace modele\metier;

class Client {
    private $pseudo;
    private $password;
    
    function __construct($pseudo, $password) {
        $this->pseudo = $pseudo;
        $this->password = $password;
    }
    function getPseudo() {
        return $this->pseudo;
    }

    function getPassword() {
        return $this->password;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setPassword($password) {
        $this->password = $password;
    }



}
