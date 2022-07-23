<?php
class MailRepository
{
    private $client;

    public function __construct(string $apiKey, QClient $client = null)
    {
        if (!$client) {

            $client = new QClient($apiKey);

        }
        $this->client = $client;

    }

    public function mailGet($username, $after=null)
    {
        try {
            $uri = "mail/" . $username . '?after='.$after;
            $response = $this->client->request('GET', $uri);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function createMail($mail)
    {
        try {
            $data = [
                'sender' => $mail->getSender(),
                'receiver' => $mail->getReceiver(),
                'subject' => $mail->getSubject(),
                'text' => $mail->getText(),
            ];
            
            $response = $this->client->request('POST', $uri, [
                'json' => $data,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;

        } catch (\Exception $e) {

            return [
                'error' => $e->getMessage(),
            ];

        }
    }
}