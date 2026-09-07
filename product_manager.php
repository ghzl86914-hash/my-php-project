<?php

class Product
{
    private PDO $pdo;

    public function __construct(PDO $db_connection)
    {
        $this->pdo = $db_connection;
    }

    public function AddProduct($Title, $Price, $ImageName, $Color, $CategoryID, $CommentID, $Score, $Stock, $Description, $Add_Date, $BrandID)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO product
            (`ProductTitle`, `PriceProduct`, `ProductImageName`, `ProductColor`, `CategoryID`, `CommentID`, `Score`, `Stock`, `Description`, `Add_Date`, `BrandID`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $Title, 
            $Price, 
            $ImageName, 
            $Color, 
            $CategoryID, 
            $CommentID, 
            $Score, 
            $Stock, 
            $Description, 
            $Add_Date, 
            $BrandID
        ]);
    }
}

?>