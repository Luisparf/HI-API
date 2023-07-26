<?php
namespace Luis\HiApi;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Plano
{
    // Função para calcular o preço com base no código do plano, mínimo de vidas e idade do beneficiário
    public function calculatePrice($nomeBeneficiario, $idadeBeneficiario, $codigoPlan)
    {
        $priceData = json_decode(file_get_contents('../price.json'), true);
    
        foreach ($priceData as $plan) {
            if ($plan['codigo'] === $codigoPlano && $plan['minimo_vidas'] <= $minimoVidas) {
                if ($idadeBeneficiario < 18) {
                    return $plan['faixa1'];
                } elseif ($idadeBeneficiario >= 18 && $idadeBeneficiario < 60) {
                    return $plan['faixa2'];
                } else {
                    return $plan['faixa3'];
                }
            }
        }
    
        // Caso não encontre uma faixa de preço correspondente, pode retornar um valor padrão ou uma mensagem de erro, caso desejado.
        return 0; // Valor padrão caso não encontre correspondência
    }

    public function saveDataFromJSON()
    {
        // Receber o JSON enviado pelo cliente
        $jsonData = file_get_contents('php://input');
        $jsonData = json_decode($jsonData, true);


        $prices = file_get_contents('../prices.json');
        $prices = json_decode($prices, true);
      

        var_dump($jsonData);
        die();

        // var_dump($prices);
        // die();

        // var_dump($jsonData);
        // die();

        // Verificar se o JSON foi decodificado corretamente
        if (is_array($jsonData)) {
             foreach ($jsonData as $beneficiario) {
                // Access individual fields of each beneficiary
                $nomeBeneficiario = $beneficiario['name'];
                $idadeBeneficiario = $beneficiario['age'];
                $codigoPlan = $beneficiario['cod'];
                // var_dump($beneficiario);

                // Call the function to calculate the price
                $preco = $this->calculatePrice($nomeBeneficiario, $idadeBeneficiario, $codigoPlan);

                // Add the calculated price to the beneficiary data
                $jsonData['price'] = $preco;
                
                // Output the updated beneficiary data (for demonstration purposes)
                echo json_encode($beneficiario) . "\n";
            }

            // var_dump($jsonData);
            // die();
        
   
            if (file_put_contents($filePath, json_encode($jsonData))) {
                // Resposta para o cliente (pode ser personalizada conforme necessário)
                echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso em' . $filePath]);
            
            } else {
                 if (!is_writable($filePath)) {
                     echo json_encode(['success' => false, 'message' => 'Erro de permissão. O servidor não tem permissão para salvar o arquivo.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao salvar os dados.']);
                }
            }
        } else {
            // Resposta para o cliente em caso de JSON inválido
            echo json_encode(['success' => false, 'message' => 'JSON inválido.']);
        }
    }
    

    public function create(){
        $plano = new Plano();
        $plano->saveDataFromJSON();
    }
}
$newPlano = new Plano();
$newPlano->create();
