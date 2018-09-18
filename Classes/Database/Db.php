<?php

namespace Models\Database;
use PDO;
use Exception;

class Db
{
    protected function getDb(){
        try {
            return new PDO('mysql:host=localhost;dbname=dbegsis', 'root', '');
        }
        catch (Exception $e){
            echo "Negalima prisijungti prie DB";
        }
    }

    protected function query($sql, $params = []){
        $sth = $this->getDb()->prepare($sql);
        $sth->execute($params);
        return $sth;
    }
}

?>