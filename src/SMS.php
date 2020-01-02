<?php

namespace Impactaweb\Zenvia;

use GuzzleHttp\Client;

class SMS
{
    /**
     * Função que envia a requisição para a API do Zenvia através do GuzzleHttp.
     * 
     * @param Int $numero
     * @param String $texto
     * 
     * @return Array
     */
    public function sendSms(Int $numero, String $texto)
    {
        $client = new Client();

        $sendSmsRequest = [
            "from" => $_ENV['ZENVIA_SENDER_NAME'],
            "to" => $numero,
            "msg" => $texto
        ];

        try {
            $response = $client->request('POST', 'https://api-rest.zenvia.com/services/send-sms', [
                'headers' => [
                    "Authorization" => "Basic " . $_ENV['ZENVIA_AUTH_TOKEN'],
                    'Content-Type' => "application/json",
                    'Accept' => "application/json"
                ],

                'json' => [
                    "sendSmsRequest" => $sendSmsRequest
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());
            if ($response->sendSmsResponse->statusCode != "00") {
                return [
                    'status' => 2,
                    'message' => $response->sendSmsResponse->detailDescription,
                    "sendSmsRequest" => $sendSmsRequest
                ];
            } else {
                return [
                    'status' => 0,
                    'message' => "SMS sent successfully!",
                    "sendSmsRequest" => $sendSmsRequest
                ];
            }
        } catch(\Exception $e) {
            return [
                'status' => 3,
                'message' => $e->getMessage(),
                "sendSmsRequest" => $sendSmsRequest
            ];
        }
    }
}