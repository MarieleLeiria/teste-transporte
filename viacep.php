<?php
$adress = (object) [
    'cep' =>  '',
    'logradouro' =>  '',
    'bairro' =>  '',
    'localidade' =>  '',
    'uf' => ''
];
if (isset($_POST['cep']) && !empty($_POST['cep'])) {
    $cep = $_POST['cep'];
    $cep = preg_replace('/[^0-9]/', '', $_POST['cep']);


    $url = "http://viacep.com.br/ws/{$cep}/json/";

    $response = @file_get_contents($url);

    if (strlen($cep) === 8) {

        if ($response !== false) {

            $data = json_decode($response);

            $adress = (object) [
                'cep' => $data->cep ?? '',
                'logradouro' => $data->logradouro ?? '',
                'bairro' => $data->bairro ?? '',
                'localidade' => $data->localidade ?? '',
                'uf' => $data->uf ?? ''
            ];
        }
    }
}
