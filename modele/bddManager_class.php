<?php

/**
 * Created by PhpStorm.
 * User: Emilien
 * Date: 05/02/2017
 * Time: 16:24
 */
class bddManager
{
    protected $host     =   "localhost";
    protected $dbname   =   "forteroche";
    protected $login    =   "root";
    protected $pswd     =   "root";


    /**
     * bddManager constructor.
     */
    public function __construct()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=forteroche;charset=utf8','root','root');
        $this->bdd = $bdd;
    }

}