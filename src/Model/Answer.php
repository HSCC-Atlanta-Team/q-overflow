<?php

namespace Qoverflow\Model;

use Parsedown;

class Answer extends Model
{  
    protected $primaryKey = 'answer_id';
    protected $answer_id;
    protected $creator;
    protected $createdAt;
    protected $text;
    protected $upvotes;
    protected $downvotes;
    protected $accepted;



    /**
     * Get the value of answer_id
     */
    public function getAnswerId()
    {
        return $this->answer_id;
    }

    /**
     * Set the value of answer_id
     */
    public function setAnswerId($answer_id): self
    {
        $this->answer_id = $answer_id;

        return $this;
    }

    /**
     * Get the value of creator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the value of creator
     */
    public function setCreator($creator): self
    {
        $this->creator = $creator;

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
     * Get the value of text
     */
    public function getText()
    {
        $parser = new Parsedown();
        return $parser->text($this->text);
    }

    /**
     * Set the value of text
     */
    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of upvotes
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }

    /**
     * Set the value of upvotes
     */
    public function setUpvotes($upvotes): self
    {
        $this->upvotes = $upvotes;

        return $this;
    }

    /**
     * Get the value of downvotes
     */
    public function getDownvotes()
    {
        return $this->downvotes;
    }

    /**
     * Set the value of downvotes
     */
    public function setDownvotes($downvotes): self
    {
        $this->downvotes = $downvotes;

        return $this;
    }

    /**
     * Get the value of accepted
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set the value of accepted
     */
    public function setAccepted($accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function forCreateAnswer()
    {
        return [
            'creator' => $this->getCreator(),
            'text' => $this->getText(),
        ];
    }
}