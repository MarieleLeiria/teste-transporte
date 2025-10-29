<?php

//array contendo as viagens e sua duração(chave e valor)
$travelTime = [
    'a' => 3,
    'b' => 5,
    'c' => 2,
    'd' => 4,
    'e' => 1,
    'f' => 6,
    'g' => 3,
    'h' => 5,
    'i' => 2,
    'j' => 7
];

// Objeto para armazenar as viagens
class Travel
{
    public $id = 0;
    public $route = [];

    public function __construct($id)
    {
        $this->id = $id;
    }
}

// Função onde o array ordena a duração das entregas
function sortList($travelTime)
{
    //Limite de horas diárias de viagem
    $limitHours = 8;

    //Número de caminhões disponíveis
    $trucks = 10;

    //Inicio o array de viagens vazio, onde vou adicionar meu objetos depois
    $travels = [];

    //Aqui armazeno minhas chaves e valores do array
    $values = array_values($travelTime);
    $keys = array_keys($travelTime);

    //Tamanho do array 
    $travelLength = count($values);

    //Neste laço for eu me certifico de percorrer todo o array
    for ($i = 0; $i < $travelLength; $i++) {
        $actualValue = $values[$i];
        $actualKey = $keys[$i];
        $beforePosition = $i - 1;

        // Aqui uso o laço while onde acontece a ordenação dos valores do array
        //Me certifico que estou partindo da primeira posição 
        while ($beforePosition >= 0 && $values[$beforePosition] > $actualValue) {
            // enquanto o meu valor atual for menor que minha posição anterior ele avança
            $values[$beforePosition + 1] = $values[$beforePosition];
            $beforePosition--;
        }
        //atualizo chaves e valores atuais
        $values[$beforePosition + 1] = $actualValue;
        $keys[$beforePosition + 1] = $actualKey;
    }
    //Novo array ordenado
    $travelTime = array_combine($keys, $values);

    //Variável para o id do objeto ser único a cada iteração 
    $id = 1;

    //Enquanto enquanto houver elementos no array o laço continua 
    while (!empty($travelTime)) {

        //Objeto para armazenar as viagens
        $travel = new Travel($id);

        //Guardar a soma de duração da entrega
        $sum = 0;

        //Armazenar os índices que já foram somados
        $usedKeys = [];

        //Armazeno aqui chave e valor do meu primeiro elemento(maior valor)
        $firstKey = array_key_first($travelTime);
        $firstValue = $travelTime[$firstKey];

        // Vou sempre somar meu maior valor com os valores dos primeiros índices (menores), inicio neste valor:
        $sum = $firstValue;

        //Adiciono a chave do meu último elemento no meu array de rotas 
        $travel->route[] = $firstKey;

        //Adiciono também a chave referente ao meu array de chaves já utilizadas, para posterior exclusão
        $usedKeys[] = $firstKey;

        //Laço para organizar as viagens de cada caminhão
        while (true) {
            //Verifico a partir da chave se a mesma existe ou já foi utilizada
            $lastKey = array_key_last($travelTime);
            if ($lastKey === null) break;
            if (in_array($lastKey, $usedKeys)) {
                unset($travelTime[$lastKey]);
                continue;
            }

            //Pego o valor da minha primeira posição
            $firstValue = $travelTime[$firstKey];

            //Caso o valor da soma respeite o limite de horas eu adiciono a primeira chave nas "usadas" e atualizo o valor
            if ($sum + $firstValue <= $limitHours) {
                $sum += $firstValue;
                $travel->route[] = $lastKey;
                $usedKeys[] = $lastKey;
                unset($travelTime[$lastKey]);
            } else {
                break;
            }
        }

        //Me certifico de remover as chaves usadas do meu array
        foreach ($usedKeys as $key) {
            unset($travelTime[$key]);
        }
        //adiciono a viagem ao atributo e adicio +1 ao id
        $travels[] = $travel;
        $id++;
    }

    //Envio um aviso 
    echo count($travels) > $trucks
        ? "Selecione algumas entregas para amanhã, limite de frota alcançado"
        : "Viagens programadas com sucesso";
};

sortList($travelTime);
