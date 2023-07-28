<?php

namespace Luis\HiApi;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class Plano
{
    private $jsonData;

    public function __construct($jsonData)
    {
        $this->jsonData = $jsonData;
    }

    static public function index()
    {
        $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'proposta.json';
        

        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            return json_decode($jsonData, true);
        }

        return [];
    }

    // Função para calcular o preço com base no código do plano, mínimo de vidas e idade do beneficiário
    public function calculatePrice($idadeBeneficiario, $codigoPlanoBeneficiario, $lifes)
    {
        $priceData = json_decode(file_get_contents('../prices.json'), true);
        $selectedPlan = null;
        foreach ($priceData as $plan) {
            if ($plan['codigo'] == $codigoPlanoBeneficiario && $lifes >= $plan['minimo_vidas']) {
                if ($selectedPlan === null || $plan['minimo_vidas'] > $selectedPlan['minimo_vidas']) {
                        $selectedPlan = $plan;
                    }
                }
        }

        if ($selectedPlan !== null) {
            if ($idadeBeneficiario < 18) {
                return $selectedPlan['faixa1'];
            } elseif ($idadeBeneficiario >= 18 && $idadeBeneficiario <= 40) {
                return $selectedPlan['faixa2'];
            } else {
                return $selectedPlan['faixa3'];
            }
        }

        return 0; // Valor padrão caso não encontre correspondência
    }

  

//   public function saveDataFromJSON()
//   {
//     // Receber o JSON enviado pelo cliente
//     $jsonData = file_get_contents('php://input');
//     $jsonData = json_decode($jsonData, true);

//     // Verificar se o JSON foi decodificado corretamente
//     if (is_array($jsonData)) {
//         $updatedData = array();
//         $total = 0;

//         // Check if the file exists and read its contents
//         $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'proposta.json';
//          $lastIndex = null;
//         foreach ($jsonData as $key => $beneficiario) {
//             // if ($key === 'total') continue; // Skip the "total" key when processing beneficiaries

//             $idadeBeneficiario = $beneficiario['age'];
//             $codigoPlanoBeneficiario = $beneficiario['cod_plan'];
//             $minimoVidas = $beneficiario['lifes'];

//             $preco = $this->calculatePrice($idadeBeneficiario, $codigoPlanoBeneficiario, $minimoVidas);
//             $total += $preco;

//             $beneficiario['price'] = $preco;
//             $updatedData[$key] = $beneficiario;
//         }

      
//         $updatedData['total'] = $total;

//         if (file_exists($filePath)) {
//             $existingData = file_get_contents($filePath);
//             $existingData = json_decode($existingData, true);

//             if (is_array($existingData)) {
//                 // Merge the existing data with the updated data (excluding the "total" key)
//                 $jsonData = array_merge($existingData,$updatedData);
//             }
//         } else {
//             $jsonData = $updatedData;
//         }

//         if (file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT))) {
//             // Resposta para o cliente (pode ser personalizada conforme necessário)
//             echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso em' . $filePath]);
//         } else {
//             if (!is_writable($filePath)) {
//                 echo json_encode(['success' => false, 'message' => 'Erro de permissão. O servidor não tem permissão para salvar o arquivo.']);
//             } else {
//                 echo json_encode(['success' => false, 'message' => 'Erro ao salvar os dados.']);
//             }
//         }
//     } else {
//         // Resposta para o cliente em caso de JSON inválido
//         echo json_encode(['success' => false, 'message' => 'JSON inválido.']);
//     }
// }

    public function saveDataFromJSON()
    {
        // Receber o JSON enviado pelo cliente
        $jsonData = file_get_contents('php://input');
        $jsonData = json_decode($jsonData, true);

        if (is_array($jsonData)) {
            $updatedData = array();
            $total = 0;

            $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'proposta.json';
            $proposalIndex = 0; 

            foreach ($jsonData as $beneficiario) {
                $idadeBeneficiario = $beneficiario['age'];
                $codigoPlanoBeneficiario = $beneficiario['cod_plan'];
                $createdAt = $beneficiario['created_at'];
                $minimoVidas = $beneficiario['lifes'];
                $preco = $this->calculatePrice($idadeBeneficiario, $codigoPlanoBeneficiario, $minimoVidas);
                $total += $preco;
                $beneficiario['price'] = $preco;
                $beneficiario['created_at'] = $createdAt;
                $updatedData[$proposalIndex][] = $beneficiario;
            }

            foreach ($updatedData as &$proposal) {
                $proposal['total'] = $total;
            }

            if (file_exists($filePath)) {
                $existingData = file_get_contents($filePath);
                $existingData = json_decode($existingData, true);

                if (is_array($existingData)) {
                    $jsonData = array_merge($existingData, $updatedData);
                }

            } else {
                $jsonData = $updatedData;
            }

            if (file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT))) {
                echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso em' . $filePath]);
            } else {
                if (!is_writable($filePath)) {
                    echo json_encode(['success' => false, 'message' => 'Erro de permissão. O servidor não tem permissão para salvar o arquivo.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao salvar os dados.']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'JSON inválido.']);
        }
    }


    public function create()
    {
        $this->saveDataFromJSON();
    }
}
$jsonData = file_get_contents('php://input');
$jsonData = json_decode($jsonData, true);

if (is_array($jsonData)) {
    $plano = new Plano($jsonData);
    $plano->create();
} else {
    echo '';
    // echo json_encode(['success' => false, 'message' => 'JSON inválido.']);
}






