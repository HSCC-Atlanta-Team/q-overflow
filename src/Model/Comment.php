<?php

namespace Qoverflow\Model;

class Comment extends Model
{
    protected $comment_id;
    protected $creator;
    protected $createdAt;
    protected $text;
    protected $upvotes;
    protected $downvote;


    /**
     * Get the value of comment_id
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * Set the value of comment_id
     */
    public function setCommentId($comment_id): self
    {
        $this->comment_id = $comment_id;

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
     * Get the value of downvote
     */
    public function getDownvote()
    {
        return $this->downvote;
    }

    /**
     * Set the value of downvote
     */
    public function setDownvote($downvote): self
    {
        $this->downvote = $downvote;

        return $this;
    }
}