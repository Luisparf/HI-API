<?php
require 'vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Luis\HiApi\Plano;

$data = Plano::index();
// var_dump($data);
// die();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
</style>
</head>
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Fechar menu</a>
  <a href="add.php" class="w3-bar-item w3-button">Novo</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">Sobre</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <!-- <div class="w3-right w3-padding-16">Mail</div> -->
    <div class="w3-center w3-padding-16">Histórico</div>
  </div>
</div>
  
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <a href="add.php" class="w3-center w3-button" style="font-size: 30px; margin-bottom: 20px;">Novo</a>

    <!-- First Photo Grid-->
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $key => $item): ?>
            <?php if (!is_array($item)) continue; ?>

            <fieldset>
                <legend>Beneficiario (<?= $key + 1 ?>)</legend>
                <div class="proposal-item">
                    <?php if (isset($item['name'])): ?>
                        <h3><?= $item['name'] ?></h3>
                    <?php else: ?>
                        <h3>Name not found</h3>
                    <?php endif; ?>
                    <?php if (isset($item['age'])): ?>
                        <p>Idade: <?= $item['age'] ?></p>
                    <?php else: ?>
                        <p>Idade not found</p>
                    <?php endif; ?>
                    <?php if (isset($item['cod_plan'])): ?>
                        <p>Plano: Bitix Customer Plano <?= $item['cod_plan'] ?></p>
                    <?php else: ?>
                        <p>Plano not found</p>
                    <?php endif; ?>
                    <!-- <p>Lives: <?= $item['lifes'] ?? 'Lifes not found' ?></p> -->
                    <?php if (isset($item['price'])): ?>
                        <p>Valor: $<?= $item['price'] ?></p>
                    <?php else: ?>
                        <p>Price not found</p>
                    <?php endif; ?>
                </div>
            </fieldset>
        <?php endforeach; ?>
        <!-- <p><strong>Total do plano: $<?= $data['total'] ?></strong></p> -->
    <?php else: ?>
        <p>No data found.</p>
    <?php endif; ?>

    <!-- Pagination -->
    <!-- <div class="w3-center w3-padding-32">
        <div class="w3-bar">
        <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
        <a href="#" class="w3-bar-item w3-black w3-button">1</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
        </div>
    </div> -->
    
    <hr id="about">
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

</body>
</html>
