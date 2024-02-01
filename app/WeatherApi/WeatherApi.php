<?php

namespace App\WeatherApi;
class WeatherApi
{
    const BASE_URL = 'https://api.openweathermap.org';

    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function consultarClimaAtual($cidade, $uf)
    {
        return $this->get('/data/2.5/weather',[
            'q' => $cidade.',BR-'.$uf. ',BRA'
        ]);
    }

    public function consultarPrevisaoTempo($cidade, $uf)
    {
        return $this->get('/data/2.5/forecast',[
            'q' => $cidade.',BR-'.$uf. ',BRA'
        ]);
    }

    private function get($resource, $params = [])
    {
        $params['units'] = 'metric';
        $params['lang'] = 'pt_br';
        $params['appid'] = $this->apiKey;

        //ENDPOINT

        $endpoint = self::BASE_URL.$resource.'?'.http_build_query($params);

        //INICIALIZAÇÃO DO CURL

        $curl = curl_init($endpoint);

        //CONFIGURAÇÕES DO CURL

        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        //RESPONSE

        $response = curl_exec($curl);

        //FECHA A CONEXÃO
        curl_close($curl);

        //RESPONSE EM ARRAY
        return json_decode($response, true);
    }

}