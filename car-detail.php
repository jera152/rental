<?php require "includes/header.php" ?>
<?php require "database/connection.php" ?>
<?php
$id = $_GET['ID'] ?? null;
 
$query = $conn->prepare("SELECT * FROM auto WHERE ID = :id");
$query->execute([':id' => $id]);
$car = $query->fetch(PDO::FETCH_ASSOC);
 
if (!$car) {
    echo "<p>Geen auto gevonden voor kenteken: " . htmlspecialchars($id) . "</p>";
    exit;
}
 ?>

<main class="car-detail">
    <div class="grid">
        <div class="row">
            <div class="advertorial">
                <h2>een hypercar met de beste design en snelheid</h2>
                <p>Veiligheid en comfort terwijl je rijd in een futiristische en elante auto </p>
                <img src="assets/images/products/<?= $car['image'] ?>" alt="">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
        </div>
        <div class="row white-background">
            <h2><?= $car['name'] ?></h2>
            <div class="rating">
                <span class="stars stars-4"></span>
                <span>440+ reviewers</span>
            </div>
            <p><?= $car['description'] ?></p>
            <div class="car-type">
                <div class="grid">
                    <div class="row"><span class="accent-color">Type Car</span><span><?= $car['type'] ?></span></div>
                    <div class="row"><span class="accent-color">Capacity</span><span><?= $car['capacity'] ?></span></div>
                </div>
                <div class="grid">
                    <div class="row"><span class="accent-color">transmission</span><span><?= $car['operating system'] ?></span></div>
                    <div class="row"><span class="accent-color">Gasoline</span><span><?= $car['gasoline'] ?></span></div>
                </div>
                <div class="call-to-action">
                    <div class="row"><span class="font-weight-bold">€<?= $car['price'] ?>,00</span> / dag</div>
                    <div class="row"><a href="" class="button-primary">Huur nu</a></div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php require "includes/footer.php" ?>
