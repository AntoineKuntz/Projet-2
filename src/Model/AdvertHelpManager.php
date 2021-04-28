<?php

namespace App\Model;

class AdvertHelpManager extends AbstractManager
{
    public const TABLE = 'adverthelp';

    public function insert(array $adverthelp): int
    {
        
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "(message, date, isValidate) VALUES (:message, :date, :isValidate)");
        $statement->bindValue('message', $adverthelp['message'], \PDO::PARAM_STR);
        $statement->bindValue('date', $adverthelp['date'], \PDO::PARAM_STR);
        $statement->bindValue('isValidate', $adverthelp['isValidate'], \PDO::PARAM_BOOL);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}

