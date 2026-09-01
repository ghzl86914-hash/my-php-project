<?php

class User
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

    public function RegUser($Username,$Password,$Email,$FullName,$PhoneNumber,$Address)
    {
        $CheckUser = $this->pdo->prepare("SELECT UserID FROM tblusers WHERE Username= ?");

        $CheckUser->execute([$Username]);

        if($CheckUser->rowCount() > 0 )
        {
            return false;
        }

        $is_success = $this->pdo->prepare("INSERT INTO tblusers(`Username`,`Password`,`Email`,`FirstNameAndLastName`,`PhoneNumber`,`Address`)VALUES(?,?,?,?,?,?)");
        $is_success->execute([$Username,$Password,$Email,$FullName,$PhoneNumber,$Address]);
        
        return [
            'success' => $is_success,
            'user_id' => $is_success ? $this->pdo->lastInsertId() : null
        ];
    }

    public function GetUser($UserName)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tblusers WHERE UserName = ?");

        $stmt->execute([
            $UserName
        ]);

        return $stmt->fetch();

    }
    public function CheckUser($UserName)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tblusers WHERE UserName = ?");

        $stmt->execute([
            $UserName
        ]);

        return $stmt->rowCount();

    }
    public function EditProfile($UserName,$FirstNameAndLastName,$Email,$PhoneNumber,$Address,$Userex,$Password = null)
    {
        $stmt = $this->pdo->prepare("UPDATE tblusers SET`UserName` = ?,`FirstNameAndLastName` = ?,`Email` = ?,`PhoneNumber` = ?,`Address` = ?,`Password` = COALESCE(?, `Password`) WHERE `UserName` = ?");

        return $stmt->execute([$UserName,$FirstNameAndLastName,$Email,$PhoneNumber,$Address,$Password,$Userex]);

    }
    public function ForgotPassword($Email,$HashedPassword)
    {
        $stmt = $this->pdo->prepare("UPDATE tblusers SET Password = ? WHERE Email = ?");

        $stmt->execute([
            $Email,
            $HashedPassword
        ]);
    }

    
}