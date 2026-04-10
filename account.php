<?php require __DIR__ . "/../includes/header.php"; ?>
<?php require __DIR__ . "/../database/connection.php" ?>

<?php
$acc = $conn->prepare("SELECT * FROM account WHERE ID = :id");
$acc->execute([':id' => $_SESSION['ID']]);
$account = $acc->fetch(PDO::FETCH_ASSOC);
?>

<main class="account">
    <div class="grid">
        <div class="row">
            <h2>Mijn Account</h2>
        </div>
        <div class="row white-background">
            <p>Welkom terug, <?= $account['email'] ?>!</p>
        </div>
    </div>
</main>
<?php require __DIR__ . "/../includes/footer.php" ?>