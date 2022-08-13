<?php

use Qoverflow\Model\Mail;

class MailRepository extends Repository
{

    public function mailGet($username, $after=null)
    {
        try {
            $uri = "mail/" . $username . '?after='.$after;
            $mails = $this->client->multiRequest('GET', $uri, Mail::class);
            
            return $mails;
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
            
            $mail = $this->client->singleRequest('POST', $uri, [
                'json' => $data,
            ]);

            return $mail;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];

        }
    }
}