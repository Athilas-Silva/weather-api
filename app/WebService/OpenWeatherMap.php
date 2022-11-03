<?php

namespace App\WebService;

class OpenWeatherMap{

    /**
     * 
     * URL base das APIs
     * @var string
     */
    const BASE_URL = 'https://api.openweathermap.org';

    /**
     * Chavee de acesso da API
     * @var string
     */
    private $apiKey;

    /**
     * Método responsavel por construir a classe definindo a Chave da API
     */
    public function __construct($apiKey){
        $this->apiKey = $apiKey;
    }

    /**
     * Método responsavel por obter o clima atual de uma cidade do Brasil
     * @param string $cidade
     * @param string $uf
     * @return array
     */
    public function consultarClimaAtual($cidade, $uf){
        return $this->get('/data/2.5/weather', [
            'q' => $cidade.',BR-'.$uf.',BRA'
        ]);
    }

    /**
     * Método responsavel por executar a consulta GET na API do open weather map
     * @param string $resource
     * @param array $params
     * @return array
     */
    private function get($resource, $params = []){
        // Parametros adicionais
        $params['units'] = 'metric';
        $params['lang'] = 'pt_br';
        $params['appid'] = $this->apiKey;

        // EndPoint
        $endPoint = self::BASE_URL.$resource.'?'.http_build_query($params);

        // Iniciar o CURL
        $curl = curl_init();

        // Configuração do curl
        curl_setopt_array($curl, [
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // Response
        $response = curl_exec($curl);

        // Fecha a conexão do curl
        curl_close($curl);

        // Response em Array
        return json_decode($response, true);
    }
}

?>