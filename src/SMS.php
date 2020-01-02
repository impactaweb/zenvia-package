<?php

namespace Fabioaov\Zenvia;

use GuzzleHttp\Client;

class SMS
{
    /**
     * Function to send a SMS through Zenvia API with GuzzleHttp.
     * 
     * @param Int $phoneNumber
     * @param String $text
     * 
     * @return Array
     */
    public function sendSms(Int $phoneNumber, String $text)
    {
        $client = new Client();

        $sendSmsRequest = [
            "from" => $_ENV['ZENVIA_SENDER_NAME'],
            "to" => $phoneNumber,
            "msg" => $text
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