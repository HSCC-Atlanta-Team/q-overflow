<?php

namespace Qoverflow\Model;

use Parsedown;

class Question extends Model
{
    protected $primaryKey = 'question_id';
    protected $question_id;
    protected $creator;
    protected $createdAt;
    protected $status;
    protected $title;
    protected $text;
    protected $views;
    protected $answers;
    protected $comments;
    protected $upvotes;
    protected $downvotes;
    protected $hasAcceptedAnswer;


    /**
     * Get the value of question_id
     */
    public function getQuestionId()
    {
        return $this->question_id;
    }

    /**
     * Set the value of question_id
     */
    public function setQuestionId($question_id): self
    {
        $this->question_id = $question_id;

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
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle($title): self
    {
        $this->title = $title;

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
     * Get the value of views
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the value of views
     */
    public function setViews($views): self
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get the value of answers
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set the value of answers
     */
    public function setAnswers($answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get the value of comments
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     */
    public function setComments($comments): self
    {
        $this->comments = $comments;

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
     * Get the value of hasAcceptedAnswer
     */
    public function getHasAcceptedAnswer()
    {
        return $this->hasAcceptedAnswer;
    }

    /**
     * Set the value of hasAcceptedAnswer
     */
    public function setHasAcceptedAnswer($hasAcceptedAnswer): self
    {
        $this->hasAcceptedAnswer = $hasAcceptedAnswer;

        return $this;
    }
    public function forCreateQuestion() {
        return [
            'creator' => $this->getCreator(),
            'title' => $this->getTitle(),
            'text' => $this->getText(),
        ];
    }

}