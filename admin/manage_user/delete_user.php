<?php

class User 
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

    public function DeleteUser($id,$UserName,$Password,$Email,$FirstName,$LastName,$PhoneNumber,$Address)
    {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");

        return $stmt->execute([$id]);
    }
}

?>