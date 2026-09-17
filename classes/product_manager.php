<?php

class Product
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

    public function AddProduct($Title, $Price, $ImageName, $Color, $CategoryID, $Score, $Stock, $Description, $Add_Date, $BrandID)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO product
            (`ProductTitle`, `PriceProduct`, `ProductImageName`, `ProductColor`, `Score`, `CategoryID`, `Stock`, `Description`, `Add_Date`, `BrandID`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $Title, 
            $Price, 
            $ImageName, 
            $Color, 
            $CategoryID, 
            $Score, 
            $Stock, 
            $Description, 
            $Add_Date, 
            $BrandID
        ]);
    }

    public function CategoryName($CategoryName)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM category WHERE `CategoryName` = ?");

        $stmt->execute([$CategoryName]);

        return $stmt->fetch();
    }

    public function BrandName($Name)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM brand WHERE `Name` = ?");

        $stmt->execute([$Name]);

        return $stmt->fetch();
    }
}

?>