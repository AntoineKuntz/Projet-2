<?php

namespace App\Model;

class AdvertManager extends AbstractManager
{
    public const TABLE = 'advert';

// insertions de nouvelle information dans la bdd

    public function insert(array $advert): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (title , description , comment) VALUES (:title, :description, :comment)");
        $statement->bindValue('title', $advert['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $advert['description'], \PDO::PARAM_STR);
        $statement->bindValue('comment', $advert['comment'], \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

// mise a jours des informations présente dans la bdd

    public function update(array $advert): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `title`= :title , `description` = :description ,`comment` = :comment WHERE id=:id");
        $statement->bindValue('id', $advert['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $advert['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $advert['description'], \PDO::PARAM_STR);
        $statement->bindValue('comment', $advert['comment'], \PDO::PARAM_STR);
        return $statement->execute();
    }
}
