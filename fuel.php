<?php


$dist = [20, 50, 32, 12, 80];
$fuel = 25;
$maxDist = 4 * $fuel;
$totalDist = array_sum($dist);
rsort($dist);
$result = [];

while (count(array_filter($dist)) > 0) {
    $sum = 0;
    $elementsToDelete = [];

    foreach ($dist as $n => $num) {
        if (!isset($num)) continue;
        if ($sum + $num <= $maxDist) {
            $sum += $num;
            $elementsToDelete[] = $num;
        }
    }

    if (count($elementsToDelete) > 0) {
        $result[] = [
            'values' => $elementsToDelete,
            'sum' => $sum
        ];
    }


    foreach ($elementsToDelete as $element) {
        $index = array_search($element, $dist);
        if ($index !== false) {
            unset($dist[$index]);
        }
    }
}

echo "Combinações encontradas:\n\n";
$pos = 1;
foreach ($result as $r) {
    echo $pos++ . ") [";
    echo implode(", ", $r['values']);
    echo "] = " . $r['sum'] . "\n";
}
$countTravel = count($result);
$needToRefuel = $countTravel - 1;
$fuelConsumption = ($totalDist - $maxDist) / 4;
if ($countTravel > 1) {
    echo "Você tem um total de " . $totalDist . "Km's hoje. Para que todas as viagens possam ser realizadas você necessitará de mais " . $fuelConsumption . " litros de combustível, abasteça " . $needToRefuel . "x.";
    //echo "saida teste  " . $needToRefuel;
}
