<?php
namespace Core;
use PDO;
use PDPOStatment;
use Exception;

abstract class Database{
    private ?PDO $pdo = null;

    protected ?PDOStatement $stmt = null;

    private string $tableName;

    
}