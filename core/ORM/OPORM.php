<?php

namespace SivadasRajan\LitePHPServer;

use PDO;
use PDOException;
use RecursiveArrayIterator;
use SivadasRajan\LitePHPServer\ORM\Query;

class OPORM
{
   
    public static function all()
    {
        $ledgername = (static::class);
        $qry = new Query($ledgername);
        var_dump(static::objectifyArray($qry->all()));
       
    }

    public function where($field,$value,$operation = '=')
    {
        $ledgername = (static::class);
        $qry = new Query($ledgername);
        var_dump(static::objectifyArray($qry->where($field,$value,$operation)));
       
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
