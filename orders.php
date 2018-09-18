<?php 
require "vendor/autoload.php";
use Models\Orders;
use Models\Pages;

$pages = new Pages;
$orders = new Orders;

?>
<?php include_once 'inc/head.php' ;?>
<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Egsis</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php">Pagrindinis</a>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rušiuoti pagal</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="?sort=trip_date">Išplaukimo data</a>
                        <a class="dropdown-item" href="?sort=route_name">Pagal Maršrutą</a>
                    </div>
                </div>
            </div>
        </div>
        <form action="" class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" name="search" type="text" placeholder="Ieškoti pagal vardą" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Ieškoti</button>
        </form>
    </div>
</nav>
<header class="container-fluid pb-1 pt-1 text-center">
    <h1>Visi užsakymai</h1>
</header>
<main class="container">
    <table class="table">
        <thead class="thead-dark text-center">
            <tr>
                <th scope="col">Nr.</th>
                <th scope="col">Užsakovas</th>
                <th scope="col">Tel. Nr</th>
                <th scope="col">Data</th>
                <th scope="col">Maršrutas</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php if(isset($_GET['page'])){
                $start_points = $pages->getStartPoint($_GET['page']);
                }else{
                    $start_points = 1;
                }
                $i=0;
            foreach($orders->getOrders($start_points, $_GET) as $order):
                ++$i;?>
            <tr>
                <th scope="row"><?php echo $i."."?></th>
                <td><?php echo $order['customer_name'];?></td>
                <td><?php echo $order['customer_phone'];?></td>
                <td><?php echo $order['trip_date'];?></td>
                <td><?php echo $order['route_name'];?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="container">
        <ul class="pagination">
            <?php
                if(!isset($_GET['sort'])){
                    for($page=1; $page<=$pages->number_of_pages();$page++){
                        echo '<li class="page-item"><a class="page-link" href="orders.php?page=' . $page .'">'.$page. '</a></li>';
                    }
                }else{
                    for($page=1; $page<=$pages->number_of_pages();$page++){
                        echo '<li class="page-item"><a class="page-link" href="orders.php?sort=' . $_GET['sort'] . '&page=' . $page .'">'.$page. '</a></li>';
                    }
                }
            ?>
        </ul>
    </div>
</main>
<?php include_once 'inc/footer.php' ;?>


