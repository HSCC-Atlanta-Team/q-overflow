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

    public function mail_get($username, $after=null)
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

    public function mail_post($mail)
    {
        try {
            $uri = 'mail';
            $mailData = $mail->toArray();
            $sender = $mailData['sender'];
            $receiver = $mailData['receiver'];
            $subject = $mailData['subject'];
            $text = $mailData['text'];

            $response = $this->client->request('POST', $uri, [
                'json' => "
                'sender': '$sender',
                'receiver': '$receiver',
                'subject': '$subject',
                'text': '$text'",
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