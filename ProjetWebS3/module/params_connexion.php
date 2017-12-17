<?php

class Parametre_connexion
{
    protected $host_name;
    protected $database;
    protected $user_name;
    protected $password;

    function __construct()
    {
        $this->host_name = 'database-etudiants.iut.univ-paris8.fr';
        $this->database = 'dutinfopw201693';
        $this->user_name = 'dutinfopw201693';
        $this->password = 'zedavedy';
    }
}