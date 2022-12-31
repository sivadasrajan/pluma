<?php

namespace SivadasRajan\Pluma\ORM;

use PDO;
use PDOException;
use RecursiveArrayIterator;

class Query
{  
   
    private $conn;
    private $query;
    private $queryString;
    private $parameterCount = 0;



    public function __construct($ledgername) {

        $this->query = [
            'action' => 'SELECT',
            'fields' => [],
            'type' => 'query',
            'table'  => static::titleCaseConvert($ledgername),
            'where' => [],
            'parameters' => []
        ];

    }

    public static function titleCaseConvert($name)
    {
        $classname =  explode('\\',$name);
        $classname = $classname[count($classname)-1];

        $classname = (substr($classname,-1) == 's' ? ($classname.'es') : ($classname.'s'));

        return substr(strtolower(preg_replace('/([A-Z])/','_$1',$classname)),1);
    }

    public function connect()
    {
        
        try {
            $this->conn = new PDO("mysql:host=".static::DATABASE_HOSTNAME.";dbname=".static::DATABASE_NAME, static::DATABASE_USERNAME, static::DATABASE_PASSWORD);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function all()
    {
        return $this->run();
    }

    public function where($field,$value,$operation = '=')
    {
       array_push($this->query['where'],[
        'field' => $field,
        'operation' => $operation,
        'paramName' => ':param'.$this->parameterCount
       ]);

       $this->query['parameters'][':param'.$this->parameterCount] = $value;

       $this->parameterCount += 1;

       return $this->run();
     
    }

    public function run()
    {
        if($this->query['type'] == 'query') return $this->runQuery();
    }
    private function runQuery()
    {
        $this->compile();
        var_dump($this->queryString);
        // $sql = "SELECT * FROM $this->ledgername";
        $conn = static::connect();
        try {
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->conn->prepare($this->queryString);
            $stmt->execute($this->query['parameters']);

            // set the resulting array to associativequeryString
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return ($stmt->fetchAll());
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            
        }
    }
    private function compile()
    {
        $queryString = '';
        switch($this->query['action']){
            case 'SELECT':{
                $this->queryAppend('SELECT');
                if(!$this->query['fields'])
                $this->queryAppend("*");
                else{
                    foreach ($this->query['fields'] as  $value) {
                        
                        if( !next($this->query['fields']) ) {
                            $this->queryAppend($value,',');
                        }else{
                            $this->queryAppend($value,'');
                        }
                    }
                }
                $this->queryAppend('FROM');
                $this->queryAppend($this->query['table']);
                
                if($this->query['where']){
                    $this->queryAppend('WHERE');
                    foreach ($this->query['where'] as $where) {
                        $this->queryAppend($where['field']);
                        $this->queryAppend($where['operation']);
                        $this->queryAppend($where['paramName']);
                    }                    
                }
                $this->queryAppend(';','');
                break;
            }
        }
    }

    private function queryAppend($str,$postfix = ' ')
    {
        $this->queryString .= $str;
        $this->queryString .= $postfix;
    }


}