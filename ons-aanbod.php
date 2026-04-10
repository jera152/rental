<?php require "includes/header.php" ?>
<?php require "database/connection.php" ?>
<?php
$merken = $_GET['name'] ?? [];
$capacities = $_GET['capacity'] ?? [];
$prijs = $_GET['price'] ?? 500; ?>
 
<?php //populair section//
$sql = "SELECT * FROM auto WHERE 1=1";
$params = [];
if (!empty($_GET['name'])) {
    // maak een placeholder voor elk merk
    $placeholders = [];
    foreach ($_GET['name'] as $index => $merk) {
        $key = ":merk" . $index;
        $placeholders[] = $key;
        $params[$key] = $merk;
    }
    $sql .= " AND `name` IN (" . implode(",", $placeholders) . ")";
}
 
// Capacity filter
if (!empty($_GET['capacity'])) {
    $placeholders = [];
    foreach ($_GET['capacity'] as $index => $cap) {
        $key = ":cap" . $index;
        $placeholders[] = $key;
        $params[$key] = $cap;
    }
    $sql .= " AND `capacity` IN (" . implode(",", $placeholders) . ")";
}
 
// Prijs filter
if (!empty($_GET['price'])) {
    $sql .= " AND `price` <= :price";
    $params[':price'] = $_GET['price'];
}
$query = $conn->prepare($sql);
$query->execute($params);
$aanbodcar = $query->fetchAll(PDO::FETCH_ASSOC); ?>
<head>
   <link rel="stylesheet" href="assets/css/aanbod.css">
</head>

<style>
    aside {
  width: 250px;
  background: white;
  padding: 20px;
  border-radius: 10px;
  height: 400px;
}
.aanbod-filter{
    display: flex;
    flex-direction: row;
    gap: 20px;

}
 
.cars {
  flex: 1;
}   


</style>
 
<header>
</header>
<main class="aanbod-filter">
<aside>
  <form id="formfilter" method="GET">
    <label class="fi-cla">Brand</label>
    <br>
    <br>
       <label><input type="checkbox" name="name[]" value="Koenigsegg">Koenigsegg</label><br>
       <label><input type="checkbox" name="name[]" value="Nissan GTR"> Nissan</label><br>
       <label><input type="checkbox" name="name[]" value="Bentley">Bentley</label><br>
       <label><input type="checkbox" name="name[]" value="Lamborghini">Lamborghini</label><br>
       <label><input type="checkbox" name="name[]" value="Ferrari">Ferrari</label><br>
       <label><input type="checkbox" name="name[]" value="Porsche">Porsche</label><br>
       <label><input type="checkbox" name="name[]" value="MG">MG</label><br>
 
 
   <label class="fi-cla">Capacity</label><br><br>
       <label><input type="checkbox" name="capacity[]" value="2"> 2</label><br>
       <label><input type="checkbox" name="capacity[]" value="4"> 4</label><br>
        <label><input type="checkbox" name="capacity[]" value="5"> 5</label><br>
      
    <label class="fi-cla">Max Price: €<span id="priceValue">100</span></label><br>
<input type="range" name="price" min="70" max="6000" value="100" id="priceRange"><br>
   <button  id= "filt-button" type="submit">Filter</button>
  </form>
</aside>
<div class="cars">
 
    <?php foreach ($aanbodcar as $car ) : ?>
        <div class="car-details">
            <div class="car-brand">
                <h3><?= $car['name']; ?></h3>
                <div class="car-type"><?= $car['type']; ?></div>
            </div>
 
            <img src="assets/images/products/<?= $car['image']; ?>" alt="">
 
            <div class="car-specification">
                <span><img src="assets/images/icons/gas-station.svg" alt=""><?= $car['gasoline']; ?></span>
                <span><img src="assets/images/icons/car.svg" alt=""><?= $car['operating system']; ?></span>
                <span><img src="assets/images/icons/profile-2user.svg" alt=""><?= $car['capacity']; ?></span>
            </div>
 
            <div class="rent-details">
                <span><span class="font-weight-bold">€<?= $car['price']; ?></span> / dag</span>
                <a href="/car-detail?kenteken=<?php echo $car['ID'] ?>" class="button-primary">Huur nu</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
 
 
<div class="show-more">
    <a class="button-primary" href="/ons-aanbod">Toon alle</a>
</div>

<script>
  const slider = document.getElementById("priceRange");
const output = document.getElementById("priceValue");
 

output.innerText = slider.value;
 

slider.oninput = function() {
    output.innerText = this.value;
}
 
</script>
</main>


<?php require "includes/footer.php" ?>
 