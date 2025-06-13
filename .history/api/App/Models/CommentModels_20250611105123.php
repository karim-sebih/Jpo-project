<?php
namespace App\Models;




final class CommentModel extends Model // Changé de BaseModel à Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'user_fk',
        'event_fk',
        'message',
        'created_at',
        'updated_at'
    ];
    
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCommentsByEventId($eventId)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function addComment($data)
    {
        return $this->insert($data);
    }

    public function deleteComment($commentId)
    {
        return $this->delete($commentId);
    }
}