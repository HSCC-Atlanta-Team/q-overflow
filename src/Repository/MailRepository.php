<?php
class MailRepository extends Repository
{
    public function mailGet($username, $after=null)
    {
        try {
            $uri = "mail/" . $username . '?after='.$after;
            $response = $this->client->doRequest('GET', $uri);
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
            
            $response = $this->client->doRequest('POST', $uri, [
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