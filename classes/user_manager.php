<?php

class User
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

    public function RegUser($UserName,$Password,$Email,$FirstName,$LastName,$PhoneNumber,$Address,$CreateDate)
    {
        $CheckUser = $this->pdo->prepare("SELECT UserID FROM user WHERE Username= ?");

        $CheckUser->execute([$UserName]);

        if($CheckUser->rowCount() > 0 )
        {
            return false;
        }

        $stmt = $this->pdo->prepare("INSERT INTO user(`UserName`,`Password`,`Email`,`FirstName`,`LastName`,`PhoneNumber`,`Address`,`CreateDate`)VALUES(?,?,?,?,?,?,?,?)");
        $is_success = $stmt->execute([$UserName,$Password,$Email,$FirstName,$LastName,$PhoneNumber,$Address,$CreateDate]);
        
        return $is_success;
            
        ;
    }

    public function GetUser($UserName)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE UserName = ?");

        $stmt->execute([
            $UserName
        ]);
            
        return $stmt->fetch();

    }
    public function CheckUser($UserName)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE UserName = ?");

        $stmt->execute([
            $UserName
        ]);

        return $stmt->rowCount();

    }
    public function EditProfile($Userex, $UserName = null, $FirstName = null, $LastName = null, $Email = null, $PhoneNumber = null, $Address = null, $Password = null, $UpdateAT = null)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET`UserName` = COALESCE(?, `UserName`),`FirstName` = COALESCE(?, `FirstName`), `LastName` = COALESCE(?, `LastName`),`Email` = COALESCE(?, `Email`),`PhoneNumber` = COALESCE(?, `PhoneNumber`),`Address` = COALESCE(?, `Address`),`Password` = COALESCE(?, `Password`), `UpdateAT` = COALESCE(?, `UpdateAT`)  WHERE `UserName` = ?");

        return $stmt->execute([$UserName,$FirstName,$LastName,$Email,$PhoneNumber,$Address,$Password,$UpdateAT,$Userex]);

    }
    public function ForgotPassword($HashedPassword,$Email)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET Password = ? WHERE Email = ?");

      return $stmt->execute([
            $HashedPassword,
            $Email
        ]);
    }

    public function GetEmailUser($Email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE Email = ?");

        $stmt->execute([
            $Email
        ]);

        return $stmt->fetch();
    }

    public function IsAdmin($UserID) 
    {
        $stmt = $this->pdo->prepare("SELECT UserID FROM `admin` WHERE UserID = ?");

        $stmt->execute([
            $UserID
        ]);

        if($stmt->rowCount() > 0 )
        {
            return true;
        } 
        else
        {
            return false;
        }        
              
    }
}