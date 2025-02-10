<?php

namespace App\Models;

use App\config\Database;

class Review
{
    protected int $id;
    protected User $reviewer;
    protected User $reviewed;
    protected string $review;

    public function __construct(int $id, User $reviewer, User $reviewed, string $review)
    {
        $this->id = $id;
        $this->reviewer = $reviewer;
        $this->reviewed = $reviewed;
        $this->review = $review;
    }

    
    public function getId() { return $this->id; }
    public function getReviewer() { return $this->reviewer; }
    public function getReviewed() { return $this->reviewed; }
    public function getReview() { return $this->review; }

    
    public function setId($id) { $this->id = $id; }
    public function setReviewer($reviewer) { $this->reviewer = $reviewer; }
    public function setReviewed($reviewed) { $this->reviewed = $reviewed; }
    public function setReview($review) { $this->review = $review; }

    public function __toString()
    {
        return "Review : {$this->getId()}, Reviewer : {$this->getReviewer()}, Reviewed : {$this->getReviewed()}, Review: {$this->getReview()}";
    }
}
