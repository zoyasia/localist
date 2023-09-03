<?php
require_once 'layout/header.php';
require_once 'functions/db.php';
?>

<div>
    <div>
    <img src="assets/<?php echo $address['picture']; ?>" class="card-img-top" alt="photo de l'établissement">
    </div>
    <h1><?php echo $address['addressName'] ?></h1>
    <p class="card-text"><?php echo $address['street'] ?></p>
    <p class="card-text"><?php echo $address['zipcode'] . " " . $address['city'] ?></p>
    <div>

    </div>
</div>

<?php
require_once 'layout/footer.php';