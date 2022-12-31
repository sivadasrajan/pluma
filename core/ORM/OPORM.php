<?php

namespace SivadasRajan\Pluma;

use PDO;
use PDOException;


class OPORM
{

    private const DATABASE_NAME = 'daybook';
    private const DATABASE_USERNAME = 'root';
    private const DATABASE_PASSWORD = 'root';
    private const DATABASE_HOSTNAME = 'localhost';
    private const DATABASE_PORT = '3306';

   
    private $conn;

    public function connect()
    {
        
        try {
            $this->conn = new PDO("mysql:host=".OPORM::DATABASE_HOSTNAME.";dbname=".OPORM::DATABASE_NAME, OPORM::DATABASE_USERNAME, OPORM::DATABASE_PASSWORD);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    
    public function selectQuery(string $query, array $params = [])
    {
     
        // $sql = "SELECT * FROM $this->ledgername";
        $conn = static::connect();
        try {
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);

            // set the resulting array to associativequeryString
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $this->objectifyArray($stmt->fetchAll());
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            
        }
    }



    public static function objectifyArray($arr){
        $out = [];
        foreach ($arr as  $value) {
            array_push($out,static::objectify($value));
        }
        return $out;
    }
    public static function objectify($item)
    {
        $obj = new (static::class);
        foreach (($item) as $key => $value) {
            $obj->{$key} = $value;
        }

        return $obj;
    }

}
