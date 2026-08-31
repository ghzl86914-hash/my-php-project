<?php

class User
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

<<<<<<< HEAD
    public function RegUser($Username, $Password, $Email, $FullName, $PhoneNumber, $Address)
=======
    public function RegUser($Username,$Password,$Email,$FullName,$PhoneNumber,$Address)
>>>>>>> c34c7286f50313d623de70123de8a386b6e50ee1
    {
        $CheckUser = $this->pdo->prepare("SELECT UserID FROM tblusers WHERE Username= ?");

        $CheckUser->execute([$Username]);

<<<<<<< HEAD
        if ($CheckUser->rowCount() > 0) {
=======
        if($CheckUser->rowCount() > 0 )
        {
>>>>>>> c34c7286f50313d623de70123de8a386b6e50ee1
            return false;
        }

        $stmt = $this->pdo->prepare("INSERT INTO tblusers(`Username`,`Password`,`Email`,`FirstNameAndLastName`,`PhoneNumber`,`Address`)VALUES(?,?,?,?,?,?)");

<<<<<<< HEAD
        return $stmt->execute([$Username, $Password, $Email, $FullName, $PhoneNumber, $Address]);
    }

    public function GetUser($Username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tblusers WHERE UserName = ?");

$stmt->execute([
    $CurrentUserName
]);

return;
=======
        return $stmt->execute([$Username,$Password,$Email,$FullName,$PhoneNumber,$Address]);  
>>>>>>> c34c7286f50313d623de70123de8a386b6e50ee1

    }
}
