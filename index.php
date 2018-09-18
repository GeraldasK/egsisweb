<?php 
session_start();
require "vendor/autoload.php";
use Models\Routes;
 ?>
<?php include_once 'inc/head.php' ;?>
    <?php include_once 'inc/navbar.php' ;?>
    <header class="bg-img">
        <div class="container">
            <h1 id="about" class="header-text">Egsis - Baidarių nuoma</h1>
        </div>
    </header>
    <main class="container">
        <div class="mt-5">
            <h2>Apie Mus</h2>
            <p><b>Žygis baidaremis</b> – nepaprastai maloni pramoga, leidžianti pasimegauti gamtos teikiamais malonumais.
            Firma „EGSIS“, kviecia palikti miesto šurmuli, kasdienius rupescius ir paplaukioti šiuolaikiškomis bei moderniomis baidaremis Aukštaitijos ežerais ir upeliais.<br>
            Ilgiausios vasaros dienos, švarus ir skaidrus kaip krištolas ežeru ir upiu vanduo, patogios baidares jums pades turiningai praleisti savaitgali ar atostogas, surasti sielos ramybe, atstatyti jegas, fantazija ir nauju ideju minciu atsiradima.
            Vandens myletojus firma „EGSIS“ siulo išsinuomoti baidares, mobilia pirti, ivairaus dydžio palapines ir turistini inventoriu reikalinga patogiam poilsiui ( miegmaišiai, pripuciami ciužiniai…) ir visko ko prireikia maloniam laiko praleidimui naturalioje gamtoje.<br>
            I Švencionelius galima atvykti traukiniu ar autobusu, keliautojus pasitiksime stotyje. Žygeiviai su baidaremis bus nuvežami i pasirinkto maršruto vieta, o baigus iškyla atvežami ten kur paliktos transporto priemones arba i geležinkelio ar autobusu stoti.
            Mes laukiame verslo,bei draugu kolektyvu, jaunimo grupiu, šeimu ir visu neabejingu vandens pramogoms plaukiant baidaremis.</p>
        </div>
        <div id="routes" class="mt-5">
            <h2>Maršrutai</h2>
            <div class="row">
            <?php 
            $routes = new Routes;
           foreach($routes->getRoutes() as $route): ?>
                <div class="col-md-4 mt-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="inc/style/photos/<?php echo $route['cover_image'];?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $route['river_name']." (".$route['route_distance']." km.) ";?></h5>
                            <p class="card-text"><?php echo $route['about_route'];?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
        <div id="order" class="mt-5">
            <h2>Pateikti Užsakymą</h2>
            <div class="row">
                <div class="col-md-6">
                <div>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success">
                        <?php   echo $_SESSION['message']; 
                        unset($_SESSION['message']);?>
                    </div>
                <?php endif; ?>
                </div>
                    <form action="action/orders.action.php" method="POST">
                        <div class="form-group">
                            <label for="name">Jūsų Vardas</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Vardas">
                        </div>
                        <div class="form-group">
                            <label for="phone">Tel. Numeris</label>
                            <input type="tel" name="phone" class="form-control" id="phone" placeholder="Tel. Numeris: pvz: 860022002">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Baidarių skaičius</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Baidarių skaičius">
                        </div>
                        <div class="form-group">
                            <label for="date">Pasirinkite datą</label>
                            <input type="date" name="date" class="form-control" id="date">
                        </div>
                        <div class="form-group">
                            <label for="route">Pasirinkite plaukimo marsrutą</label>
                            <select class="form-control" name="route_name" id="route">
                            <?php foreach($routes->getRoutes() as $route):?>
                                <option value="<?php echo $route['route_name'];?>"><?php echo $route['route_name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Pateikti</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="logo-cover bg-white">
                        <div class="container">
                            <h3>Gavę užsakymą mes su Jumis susisieksime per artimiausią valandą ir aptarsime likusias detales.</h3>
                        </div>
                        <div class="ml-5">
                            <img class="ml-5" src="inc/style/photos/egsis.jpg" alt="Egsis" width="230px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include_once 'inc/footer.php' ;?>