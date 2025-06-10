<?php
namespace App\Models;

final class CommentModels extends BaseModel
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'id_user',
        'message',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}