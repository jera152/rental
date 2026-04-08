<?php require "includes/header.php" ?> 
<?php require "database/connection.php" ?>
<?php

$stmt = $conn->prepare("SELECT * FROM auto");
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <header>
        <div class="advertorials">
            <div class="advertorial">
                <h2>Hét platform om een auto te huren</h2>
                <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
                <a href="#" class="button-primary">Huur nu een auto</a>
                <img src="assets/images/products/ferraricompetizone.webp" alt="">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
            <div class="advertorial">
                <h2>Wij verhuren ook bedrijfswagens</h2>
                <p>Voor een vaste lage prijs met prettig voordelen.</p>
                <a href="#" class="button-primary">Huur een bedrijfswagen</a>
                <img src="assets/images/products/lamborghini_aventador_svj.webp" alt="">
                <img src="assets/images/header-block-background.svg" alt="" class="background-header-element">

            </div>
        </div>
    </header>

    <main>
    <h2 class="section-title">Populaire auto's</h2>
    <div class="cars">
        <?php foreach ($cars as $car) : ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= $car['name'] ?></h3>
                   
                    <div class="car-type">
                        <?= $car['type'] ?>
                    </div>
                </div>
                <img src="assets/images/products/<?= $car['image'] ?>" alt="">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt=""><?= $car['gasoline'] ?></span>
                    <span><img src="assets/images/icons/car.svg" alt=""><?= $car['operating system'] ?></span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt=""><?= $car['capacity'] ?></span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold"><span>€</span><?= $car['price'] ?><span>/dag</span>
                    <a href="/car-detail" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
   
     
  
    <div class="show-more">
        <a class="button-primary" href="#">Toon alle</a>
    </div>
    </main>

<?php require "includes/footer.php" ?>