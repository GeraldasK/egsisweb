<?php
namespace Models;
use Models\Database\Db;
use PDO;

class Pages extends Orders
{   
   
    private $results_per_page = 10;
    public $number_of_results;


    private function getResults(){
        $sql = "SELECT * FROM orders";
        $result = $this->query($sql);
        $number_of_results = $result->rowCount();
        return $number_of_results;
    }
    public function number_of_pages(){
        $result = ceil($this->getResults()/$this->results_per_page);
        return $result;
    }

    public function getStartPoint($number){
        $start_point = ($number - 1) * $this->results_per_page;
        return $start_point;
    }
}

?>