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

$dadosClima = $obWeatherMap->consultarClimaAtual($cidade, $uf);

//CIDADE
echo 'Cidade: '.$cidade. '/' .$uf."\n";

//TEMPERATURA
echo 'Temperatura: '.($dadosClima['main']['temp'] ?? 'Desconhecido')."\n";
echo 'Sensação térmica: '.($dadosClima['main']['feels_like'] ?? 'Desconhecido')."\n";

//CLIMA
echo 'Clima: '.($dadosClima['weather'][0]['description'] ?? 'Desconhecido')."\n";