<?php

class user 
{
    private $pdo;

    public function __construct($db_connection){
        $this->pdo = $db_connection;
    }
}

?>