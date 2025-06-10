<?php
namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\API\ResponseTrait;

class CommentController extends BaseController
{
    use ResponseTrait;
    
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    // Create
    public function create()
    {
        try {
            $data = $this->request->getJSON(true);
            
            if (!isset($data['eventId'], $data['userId'], $data['content'])) {
                return $this->failValidationError('Missing required fields: eventId, userId, content');
            }

            $commentData = [
                'event_id' => $data['eventId'],
                'id_user' => $data['userId'],
                'message' => $data['content']
            ];

            $result = $this->commentModel->createComment($commentData);

            if ($result) {
                return $this->respondCreated([
                    'message' => 'Comment created successfully',
                    'id' => $result
                ]);
            }
            
            return $this->fail('Failed to create comment');
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    // Read (single comment)
    public function show($commentId)
    {
        try {
            if (!is_numeric($commentId) || $commentId <= 0) {
                return $this->failValidationError('Invalid comment ID');
            }

            $comment = $this->commentModel->getComment($commentId);
            
            if (!$comment) {
                return $this->failNotFound('Comment not found');
            }

            return $this->respond($comment);
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    // Read (all comments for an event)
    public function index($eventId)
    {
        try {
            if (!is_numeric($eventId) || $eventId <= 0) {
                return $this->failValidationError('Invalid event ID');
            }

            $comments = $this->commentModel->getCommentsByEventId($eventId);
            return $this->respond($comments);
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    // Update
    public function update($commentId)
    {
        try {
            if (!is_numeric($commentId) || $commentId <= 0) {
                return $this->failValidationError('Invalid comment ID');
            }

            $data = $this->request->getJSON(true);
            
            if (!isset($data['content'])) {
                return $this->failValidationError('Missing required field: content');
            }

            $commentData = [
                'message' => $data['content']
            ];

            if ($this->commentModel->updateComment($commentId, $commentData)) {
                return $this->respond([
                    'message' => 'Comment updated successfully'
                ]);
            }
            
            return $this->failNotFound('Comment not found');
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    // Delete
    public function delete($commentId)
    {
        try {
            if (!is_numeric($commentId) || $commentId <= 0) {
                return $this->failValidationError('Invalid comment ID');
            }

            if ($this->commentModel->deleteComment($commentId)) {
                return $this->respondDeleted(['message' => 'Comment deleted successfully']);
            }
            
            return $this->failNotFound('Comment not found');
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }
}