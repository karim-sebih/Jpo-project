<?php
namespace App\Controllers;

use App\Models\CommentModel; // Corrigé le nom du modèle
use CodeIgniter\API\ResponseTrait; // Pour gérer les réponses API

class CommentController extends BaseController // Retiré abstract, étend BaseController
{
    use ResponseTrait; // Pour les réponses formatées
    
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function getComments($eventId)
    {
        try {
            // Validation de l'ID
            if (!is_numeric($eventId) || $eventId <= 0) {
                return $this->failValidationError('Invalid event ID');
            }

            $comments = $this->commentModel->getCommentsByEventId($eventId);
            return $this->respond($comments);
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred');
        }
    }

    public function addComment()
    {
        try {
            $data = $this->request->getJSON(true);
            
            // Validation des entrées
            if (!isset($data['eventId'], $data['userId'], $data['content'])) {
                return $this->failValidationError('Missing required fields');
            }

            $result = $this->commentModel->addComment(
                $data['eventId'],
                $data['userId'],
                $data['content']
            );

            if ($result) {
                return $this->respondCreated(['message' => 'Comment added successfully']);
            }
            
            return $this->fail('Failed to add comment');
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred');
        }
    }

    public function deleteComment($commentId)
    {
        try {
            // Validation de l'ID
            if (!is_numeric($commentId) || $commentId <= 0) {
                return $this->failValidationError('Invalid comment ID');
            }

            if ($this->commentModel->deleteComment($commentId)) {
                return $this->respondDeleted(['message' => 'Comment deleted successfully']);
            }
            
            return $this->failNotFound('Comment not found');
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred');
        }
    }
}