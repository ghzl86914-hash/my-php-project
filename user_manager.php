<?php

class user 
{
    private PDO $pdo;

    public function __construct(PDO $db_connection){
        $this->pdo = $db_connection;
    }
}

?>