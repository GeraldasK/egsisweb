<?php

namespace Models;
use Models\Database\Db;
use PDO;

class Routes extends Db
{
    public function getRoutes(){
        $sql = "SELECT * FROM routes";
        $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>