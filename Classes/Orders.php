<?php

namespace Models;
use Models\Database\Db;
use PDO;

class Orders extends Db
{
    private $customer_name;
    private $customer_phone;
    private $quantity;
    private $trip_date;
    private $route_name;

    public function __construct($data = []){

        $this->getDb();

        if(count($data) > 0):
            $this->customer_name = $data['name'];
            $this->customer_phone = $data['phone'];
            $this->quantity = $data['quantity'];
            $this->trip_date = $data['date'];
            $this->route_name = $data['route_name'];
        endif;
    }

    public function storeOrders(){
        $sql = "INSERT INTO orders (customer_name, customer_phone, quantity, trip_date, route_name)
        VALUES (:customer_name, :customer_phone, :quantity, :trip_date, :route_name)";

        $result = $this->query($sql, [
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'quantity' => $this->quantity,
            'trip_date' => $this->trip_date,
            'route_name' => $this->route_name
        ]);
    }

    public function getOrders($start_point, $get=[]){
        $result_per_page = 10;
        
        if(isset($get['search'])){
            $keyword = $get['search'];
        }else{
            $keyword = null;
        }
        if(isset($get['sort'])){
            $sortBy = $get['sort'];
        }else{
            $sortBy = null;
        }
 
        if(empty($sortBy) && empty($keyword)){
            $sql = "SELECT * FROM orders LIMIT $start_point, $result_per_page";
            $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }elseif(!empty($keyword)){
            $sql = "SELECT * FROM orders WHERE customer_name LIKE :keyword";
            $result = $this->query($sql,[
            'keyword' => "%".$keyword."%"
            ]);
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        else{
            $sql = "SELECT * FROM orders ORDER BY $sortBy ASC LIMIT $start_point, $result_per_page";
            $result = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }

    public function searchOrders($keyword){
        $sql = "SELECT * FROM orders WHERE customer_name LIKE :keyword";
        $result = $this->query($sql,[
            'keyword' => "%".$keyword."%"
        ]);
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}