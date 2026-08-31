<?php

class User 
{
    private PDO $pdo;

    public function __construct(PDO $db_connection){
        $this->pdo = $db_connection;
    }

    public function RegUser($Username,$Password,$Email,$FullName,$Address,$PhoneNumber)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tblusers
                (`Username`,`Password`,`Email`,`FirstNameAndLastName`,`PhoneNumber`,`Address`)VALUES(?,?,?,?,?,?)");

        return $stmt->execute([
        $Username,
        $Password,
        $Email,
        $FullName,
        $PhoneNumber,
        $Address
        ]);  


    }
    
}

?>