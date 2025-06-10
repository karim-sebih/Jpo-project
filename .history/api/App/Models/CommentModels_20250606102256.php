<?php
namespace App\Models;

use CodeIgniter\Model; // Assumant que vous utilisez CodeIgniter


final class CommentModel extends Model // Changé de BaseModel à Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'event_id', // Ajouté pour correspondre à la relation avec l'événement
        'message',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCommentsByEventId($eventId)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function addComment($eventId, $userId, $content)
    {
        $data = [
            'event_id' => $eventId,
            'id_user' => $userId,
            'message' => $content
        ];
        
        return $this->insert($data);
    }

    public function deleteComment($commentId)
    {
        return $this->delete($commentId);
    }
    
}