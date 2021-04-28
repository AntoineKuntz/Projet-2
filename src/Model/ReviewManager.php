<?php

namespace App\Model;

class ReviewManager extends AbstractManager
{
    /**
     * Insert new item in database
     */
    public function insert(array $help): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`advertHelp_id`, `user_id`, `comment`, 'date' ) 
        VALUES (:advertHelp, :user_id, :comment, :date)");

        $statement->bindValue('advertHelp_id', $help['advertHelp_id'], \PDO::PARAM_INT);
        $statement->bindValue('user_id', $help['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('comment', $help['comment'], \PDO::PARAM_STR);
        $statement->bindValue('date', $help['date'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
