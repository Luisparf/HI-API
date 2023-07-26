<?php
// require_once 'vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// use App\Product\Product;

// $products =  App\Product\Product::all();
// var_dump($products);

// $path = "src/app/";
?>
<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous"> -->
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
.custom-input {
  /* Adicione aqui os estilos desejados para os inputs */
  width: 400px;
  margin: 5px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.beneficiary-fieldset {
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px;

  /* Centraliza o conteúdo no centro do fieldset */
  display: flex;
  flex-direction: column;
  align-items: center;
}

.beneficiary-fieldset legend {
  /* Centraliza a legenda no centro do fieldset */
  text-align: center;
}
</style>
</head>
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Fechar menu</a>
  <a href="#food" onclick="w3_close()" class="w3-bar-item w3-button">Novo</a>
  <a href="index.php" class="w3-bar-item w3-button">Voltar</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <!-- <div class="w3-right w3-padding-16">Mail</div> -->
    <div class="w3-center w3-padding-16">Novo</div>
  </div>
</div>
  
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">

 
  <a href="index.php"  class="w3-center w3-button" style="font-size: 30px; margin-bottom: 20px;">Voltar</a>

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

  <form class="pure-form">
  

    <fieldset>
        <legend>Insira os dados abaixo:</legend>
        <label for="select-beneficiaries">Quantidade de beneficiários:</label>
            <select id="select-beneficiaries"  name="beneficiaries" required onchange="createInputs()">
                <option value="">Selecione...</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <div id="input-container"></div>

    </fieldset>

</form>
  
  <hr id="about">

  <!-- About Section -->
  <!-- <div class="w3-container w3-padding-32 w3-center">  
    <h3>About Me, The Food Man</h3><br>
    <img src="/w3images/chef.jpg" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
    <div class="w3-padding-32">
      <h4><b>I am Who I Am!</b></h4>
      <h6><i>With Passion For Real, Good Food</i></h6>
      <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    </div>
  </div> -->
  <!-- <hr> -->
  
  <!-- Footer -->
  <!-- <footer class="w3-row-padding w3-padding-32">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  
    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third w3-serif">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dinner</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Salmon</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">France</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Drinks</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Flavors</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Cuisine</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Chicken</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dressing</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fried</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fish</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Duck</span>
      </p>
    </div>
  </footer> -->

<!-- End page content -->
</div>

<script>

    // const registrationOptions = [
    //     { value: 'reg1', text: 'Bitix Customer Plano 1' },
    //     { value: 'reg2', text: 'Bitix Customer Plano 2' },
    //     { value: 'reg3', text: 'Bitix Customer Plano 3' },
    //     { value: 'reg4', text: 'Bitix Customer Plano 4' },
    //     { value: 'reg5', text: 'Bitix Customer Plano 5' },
    //     { value: 'reg6', text: 'Bitix Customer Plano 6' },
    // ];
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
function createInputs() {
  const selectValue = parseInt(document.getElementById('select-beneficiaries').value);
  const inputContainer = document.getElementById('input-container');
  inputContainer.innerHTML = ''; // Limpa os inputs existentes
  var registrationOptions;

  fetch('plans.json')
    .then(response => response.json())
    .then(plansJson => {
      // Criando o array registrationOptions
      registrationOptions = plansJson.map(plan => ({
        value: plan.registro,
        text: plan.nome
      }));

      console.log(registrationOptions);

      // Agora que temos os dados, criamos os elementos HTML
      for (let i = 0; i < selectValue; i++) {
        const fieldset = document.createElement('fieldset');
        fieldset.classList.add('beneficiary-fieldset');

        const legend = document.createElement('legend');
        legend.textContent = 'Beneficiário ' + (i + 1);
        fieldset.appendChild(legend);

        const nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = 'beneficiary_' + (i + 1) + '_name';
        nameInput.placeholder = 'Nome';
        nameInput.classList.add('custom-input');
        fieldset.appendChild(nameInput);

        const ageInput = document.createElement('input');
        ageInput.type = 'text';
        ageInput.name = 'beneficiary_' + (i + 1) + '_age';
        ageInput.placeholder = 'Idade';
        ageInput.classList.add('custom-input');
        fieldset.appendChild(ageInput);

        const registrationSelect = document.createElement('select');
        registrationSelect.name = 'beneficiary_' + (i + 1) + '_registration';
        registrationSelect.classList.add('custom-input');

        for (const option of registrationOptions) {
          const optionElement = document.createElement('option');
          optionElement.value = option.value;
          optionElement.textContent = option.text;
          registrationSelect.appendChild(optionElement);
        }

        fieldset.appendChild(registrationSelect);
        inputContainer.appendChild(fieldset);
      }
    })
    .catch(err => {
      console.error('Erro ao obter o arquivo plans.json:', err);
    });
}
</script>

</body>
</html>
