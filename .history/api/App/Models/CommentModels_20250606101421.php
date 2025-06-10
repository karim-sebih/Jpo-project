<?php
namespace App\Models;

final class CommentModels extends BaseModel
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'id_user',
        'conten',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCommentsByEventId($eventId)
    {
        return $this->where('event_id', $eventId)->findAll();
    }

    public function getCommentsByLocationId($locationId)
    {
        return $this->where('location_id', $locationId)->findAll();
    }
}