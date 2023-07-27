<?php
require 'vendor/autoload.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
error_reporting(0);
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
            <div class="w3-center w3-padding-16">Histórico</div>
        </div>
    </div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <a href="add.php" class="w3-center w3-button" style="font-size: 30px; margin-bottom: 20px;">Novo</a>

    <div class="proposal-container"> <!-- Add the proposal-container div here -->

        <?php if (!empty($data)): ?>
            <?php foreach ($data as $proposalIndex => $proposal): ?>
                <fieldset>
                    <legend>Proposta (<?= $proposalIndex ?>)</legend>
                    <?php if (is_array($proposal) && isset($proposal['total'])): ?>
                        <?php foreach ($proposal as $key => $beneficiary): ?>
                            <?php if ($key !== 'total'): ?>
                                <div class="proposal-item">
                                    <h3><?= isset($beneficiary['name']) ? $beneficiary['name'] : 'N/A' ?></h3>
                                    <p>Idade: <?= isset($beneficiary['age']) ? $beneficiary['age'] : 'N/A' ?></p>
                                    <p>Plano: Bitix Customer Plano <?= isset($beneficiary['cod_plan']) ? $beneficiary['cod_plan'] : 'N/A' ?></p>
                                    <p>Valor: $<?= isset($beneficiary['price']) ? $beneficiary['price'] : 'N/A' ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <p><strong>Total do plano: $<?= $proposal['total'] ?></strong></p>
                    <?php else: ?>
                        <p>Nem dados de propostas <?= $proposalIndex ?></p>
                    <?php endif; ?>
                </fieldset>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum dado encontrado.</p>
        <?php endif; ?>
    </div>

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
