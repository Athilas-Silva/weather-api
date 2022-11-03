<?php
//Autoload de classes
require __DIR__ .'/vendor/autoload.php';
$token = require __DIR__ .'/config.php';

// Dependencias
use App\WebService\OpenWeatherMap;

// Instancia da API
$obOpenWeatherMap = new OpenWeatherMap($token);

if(!isset($argv[2])){
    die('Cidade e UF são obrigatórios');
}

// Variaveis
$cidade = $argv[1];
$uf = $argv[2];

// Executa a consulta na API Open Weather Map
$dadosClima = $obOpenWeatherMap->consultarClimaAtual("São Paulo", "SP");

// CIDADE
echo 'Cidade: '.$cidade.'/'.$uf."\n";

// Temperatura
echo 'Temperatura: ' .($dadosClima['main']['temp'] ?? 'Desconhecido')."\n";
echo 'Sensação Térmica: ' .($dadosClima['main']['feels_like'] ?? 'Desconhecido')."\n";

// Clima
echo 'Temperatura: ' .($dadosClima['weather'][0]['description'] ?? 'Desconhecido')."\n";