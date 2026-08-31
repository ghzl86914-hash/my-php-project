<?php

class User 
{
    private PDO $pdo;

    public function __construct(PDO $db_connection){
        $this->pdo = $db_connection;
    }

    public function RegUser($Username,$Password,$Email,$FullName,$Address)
}

?>