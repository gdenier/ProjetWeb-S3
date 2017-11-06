<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 05/11/2017
 * Time: 15:08
 */

class Parametre_connexion
{
    protected $host_name;
    protected $database;
    protected $user_name;
    protected $password;

    function __construct()
    {
        $this->host_name = 'db706681381.db.1and1.com';
        $this->database = 'db706681381';
        $this->user_name = 'dbo706681381';
        $this->password = 'SPcoa-17';
    }
}