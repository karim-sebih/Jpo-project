<?php
namespace App\Controllers;

use App\Models\CommentModels;

abstract class CommentController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModels();
    }

    public function getComments($eventId)
    {
        return $this->commentModel->getCommentsByEventId($eventId);
    }

    public function addComment($eventId, $userId, $content)
    {
        return $this->commentModel->addComment($eventId, $userId, $content);
    }

    public function deleteComment($commentId)
    {
        return $this->commentModel->deleteComment($commentId);
    }
}