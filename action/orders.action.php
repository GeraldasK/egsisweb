<?php
session_start();
require "../vendor/autoload.php";
use Models\Orders;
use Models\Database\Db;


if(isset($_POST['submit'])){
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    if(empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['quantity']) || empty($_POST['date'])){
        $_SESSION['message'] = "Nepalikite tuščių įvesties laukelių";
        header("Location: ../index.php#order");
    }else{
        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $data['name'])){
            $_SESSION['message'] = "Klaida: Nevartokite simbolių";
            header("Location: ../index.php#order");
        }else{
            if(!filter_var($_POST['phone'], FILTER_VALIDATE_INT)){
                $_SESSION['message'] = "Tel.Numerio įvesties langelyje galimi tik skaičiai";
                header("Location: ../index.php#order");
            }else{
                $order = new Orders($data);
                $order->storeOrders();
                $_SESSION['message'] = "Jūsų užsakymas priimtas. Greitai su jumis susisieksime :)";
                header("Location: ../index.php#order");
            }
        }
    }
}
?>
