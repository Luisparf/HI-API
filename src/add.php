<?php
// require_once 'vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
<head>
<title>Hi</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
  <a href="../index.php" class="w3-bar-item w3-button">Voltar</a>
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

 
  <a href="../index.php"  class="w3-center w3-button" style="font-size: 30px; margin-bottom: 20px;">Voltar</a>

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
                <option value="">Selecione... </option>
                <option value="1"> 1 </option>
                <option value="2"> 2 </option>
                <option value="3"> 3 </option>
                <option value="4"> 4 </option>
                <option value="5"> 5 </option>
                <option value="6"> 6 </option>
                <option value="7"> 7 </option>
                <option value="8"> 8 </option>
                <option value="9"> 9 </option>
                <option value="10"> 10 </option>
            </select>
            <div id="input-container"></div>
            <!-- <div class="w3-center w3-padding-16">Salvar</div>
            <a href="index.php"  class="w3-center wr-button" >Salvar</a> -->
            <button  id="save-button" type="button" onclick="saveDataAsJSON()" class="w3-button w3-right" style="display:none;">Salvar</button>

    </fieldset>

</form>
  
  <hr id="about">


<!-- End page content -->
</div>

<script>

const beneficiariesData = []; // Array para armazenar os dados dos beneficiários

function w3_open() {
  document.getElementById("mySidebar").style.display = "block";

}

 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
 

function saveDataAsJSON() {
        const beneficiariesElements = document.querySelectorAll('.beneficiary-fieldset');

        beneficiariesData.length = 0; // Limpar dados existentes antes de salvar

        let isValidData = true; // Variável para verificar se os dados são válidos
        let beneficiariesCount = beneficiariesElements.length;

  
        beneficiariesElements.forEach((fieldset, index) => {
        const nameInput = fieldset.querySelector('input[name^="beneficiary_"][name$="_name"]');
        const ageInput = fieldset.querySelector('input[name^="beneficiary_"][name$="_age"]');
        const registrationSelect = fieldset.querySelector('select[name^="beneficiary_"][name$="_registration"]');

        const name = nameInput.value.trim();
        const age = ageInput.value.trim();
        const price = 0;

        // Verificar se os campos de nome e idade não estão vazios antes de salvar os dados
        if (name && age && registrationSelect) {
            const registration = registrationSelect.value;

            // Check the number of beneficiaries with the same "registrationSelect"
            const lifes = beneficiariesData.filter(beneficiary => beneficiary.registration === registration).length + 1;

            const beneficiary = {
                name: name,
                age: age,
                cod_plan: registration,
                created_at: new Date().toISOString(),
            };

            beneficiariesData.push(beneficiary);
        } else {
            isValidData = false; // Algum campo está vazio, dados não são válidos
            alert(`Preencha os campos do Beneficiário ${index + 1}.`);
        }
        });

        // conta as ocorrências de planos iguais
        const registrationCounts = beneficiariesData.reduce((acc, beneficiary) => {
            acc[beneficiary.cod_plan] = (acc[beneficiary.cod_plan] || 0) + 1;
            return acc;
        }, {});

        // atualiza o campo de minimo vidas
        beneficiariesData.forEach(beneficiary => {
            beneficiary.lifes = registrationCounts[beneficiary.cod_plan];
        });

        console.log(beneficiariesData);


        if (isValidData) {
            const jsonData = JSON.stringify(  beneficiariesData );
            console.log('jsondata:' + jsonData); 

            $.ajax({
                url: 'src/Plano.php',
                type: 'POST',
                contentType: 'application/json',
                data: jsonData,
                success: function(data, status, message) {
                    console.log('Resposta do servidor:', data);
                    // alert('Sucesso!' + JSON.parse(data.message);
                    alert('Sucesso!' + JSON.parse(data).message);
                    window.location.href = 'index.php';
                    
                },
                error: function(xhr, status, error) {
                    console.log('XHR Object:', xhr);
                    console.log('Error Status:', status);
                    console.log('Error:', error);

                    try {
                        const errorMessage = JSON.parse(xhr.responseText).message;
                        console.log('Error Message:', errorMessage);
                        const confirmation = window.confirm('Erro ao enviar os dados para o servidor: ' + errorMessage);
                        // Do something if needed with the confirmation result
                    } catch (e) {
                        console.log('Error parsing response:', e);
                        window.confirm('Erro ao enviar os dados para o servidor. Por favor, tente novamente mais tarde.');
                    }
                }

            });
    }

}

    let registrationOptions = null;

function createInputs() {
    const selectValue = parseInt(document.getElementById('select-beneficiaries').value);
    const inputContainer = document.getElementById('input-container');
    inputContainer.innerHTML = ''; // Limpa os inputs existentes
    
    // Verifica se os dados já foram carregados anteriormente
    if (registrationOptions) {
        for (let i = 0; i < selectValue; i++) {
            const fieldset = document.createElement('fieldset');
            fieldset.classList.add('beneficiary-fieldset');

            const legend = document.createElement('legend');
            legend.textContent = 'Beneficiário ' + (i + 1);
            fieldset.appendChild(legend);

            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.name = 'beneficiary_' + (i + 1) + '_name';
            nameInput.placeholder = 'Nome*';
            nameInput.classList.add('custom-input');
            fieldset.appendChild(nameInput);

            const ageInput = document.createElement('input');
            ageInput.type = 'number';
            ageInput.name = 'beneficiary_' + (i + 1) + '_age';
            ageInput.placeholder = 'Idade*';
            ageInput.classList.add('custom-input');
            fieldset.appendChild(ageInput);

            const registrationSelect = document.createElement('select');
            registrationSelect.name = 'beneficiary_' + (i + 1) + '_registration';
            registrationSelect.classList.add('custom-input');

            console.log(registrationOptions);

            for (const option of registrationOptions) {
                const optionElement = document.createElement('option');
                optionElement.value = option.value;
                optionElement.textContent = option.text;
                registrationSelect.appendChild(optionElement);
            }

            fieldset.appendChild(registrationSelect);
            inputContainer.appendChild(fieldset);
    }
  } else {
    // Faz a requisição apenas se os dados ainda não foram carregados
    fetch('../plans.json')
        .then(response => response.json())
        .then(plansJson => {
        registrationOptions = plansJson.map(plan => ({
            value: plan.codigo,
            text: plan.nome
        }));

             // Chama a função novamente após carregar os dados
            createInputs();
        })
        .catch(err => {
            console.error('Erro ao obter o arquivo plans.json:', err);
        });
  }
}

 function toggleSaveButton() {
        const select = document.getElementById('select-beneficiaries');
        const saveButton = document.getElementById('save-button');

        if (select.value !== '') {
            saveButton.style.display = 'block';
        } else {
            saveButton.style.display = 'none';
        }
    }

    // Chamar a função para verificar o estado inicial ao carregar a página
    toggleSaveButton();

    // Chamar a função sempre que o valor do select for alterado
    document.getElementById('select-beneficiaries').addEventListener('change', toggleSaveButton);
</script>

</body>
</html>
