<?php
namespace App\Models;

use CodeIgniter\Model;

final class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'event_id',
        'message',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Create
    public function createComment($data)
    {
        return $this->insert($data);
    }

    // Read (single comment)
    public function getComment($commentId)
    {
        return $this->find($commentId);
    }

    // Read (all comments for an event)
    public function getCommentsByEventId($eventId)
    {
        return $this->where('event_id', $eventId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Update
    public function updateComment($commentId, $data)
    {
        return $this->update($commentId, $data);
    }

    // Delete
    public function deleteComment($commentId)
    {
        return $this->delete($commentId);
    }
}