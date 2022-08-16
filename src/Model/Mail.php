<?php

namespace Qoverflow\Model;

class Mail extends Model
{
    protected $primaryKey = 'mail_id';
    protected $mail_id;
    protected $sender;
    protected $receiver;
    protected $createdAt;
    protected $subject;
    protected $text;


    /**
     * Get the value of mail_id
     */
    public function getMailId()
    {
        return $this->mail_id;
    }

    /**
     * Set the value of mail_id
     */
    public function setMailId($mail_id): self
    {
        $this->mail_id = $mail_id;

        return $this;
    }

    /**
     * Get the value of sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     */
    public function setSender($sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of receiver
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     */
    public function setReceiver($receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     */
    public function setSubject($subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     */
    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }
}