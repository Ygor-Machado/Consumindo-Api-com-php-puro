<?php

require __DIR__ . '/vendor/autoload.php';

use App\WeatherApi\WeatherApi;

$obWeatherMap = new WeatherApi("43be6b180e37d6459235a839f3942841");

//VERIFICA OS ARGUMENTOS
if (!isset($argv[2])) {
    die('Cidade e UF são obrigatórios');
}

$cidade = $argv[1];
$uf = $argv[2];

$dadosPrevisao = $obWeatherMap->consultarPrevisaoTempo($cidade, $uf);

echo "<pre>";
print_r(array_keys($dadosPrevisao));
echo "</pre>";

//CIDADE
echo 'Cidade: '.$cidade. '/' .$uf."\n";

foreach (($dadosPrevisao['list'] ?? []) as $previsao) {
    $output = [
        $previsao['dt_txt'],
        number_format($previsao['main']['temp'],2,'.',''),
        number_format($previsao['main']['feels_like'],2,'.',''),
        $previsao['weather'][0]['description'] ?? ''
    ];

    echo implode(' | ', $output)."\n";
}

