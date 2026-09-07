<?php

class Product
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

    public function AddProduct($CurrentUserName, $Title, $Price, $ImageName)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tblproducts 
            (UserName, ProductTitle, PriceProduct, ProductImageName)
            VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $CurrentUserName,
            $Title,
            $Price,
            $ImageName
        ]);
    }
}

?>