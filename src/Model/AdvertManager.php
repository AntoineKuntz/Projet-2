<?php

namespace App\Model;

class AdvertManager extends AbstractManager
{
    public const TABLE = 'advert';

// insertions de nouvelle information dans la bdd

    public function insert(array $advert): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (user_id, title, category_id, description, disponibility)
        VALUES 
        (:user_id, :title, :category_id, :description, :disponibility)");
        $statement->bindValue('user_id', $advert['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $advert['title'], \PDO::PARAM_STR);
        $statement->bindValue('category_id', $advert['category_id'], \PDO::PARAM_INT);
        $statement->bindValue('description', $advert['description'], \PDO::PARAM_STR);
        $statement->bindValue('disponibility', $advert['disponibility'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

// mise a jours des informations présente dans la bdd

    public function update(array $advert): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET 
        `user_id`= :user_id,
        `title`= :title ,
        `category_id`= :category_id,
        `description` = :description ,
        `disponibility` = :disponibility
         WHERE id=:id");
        $statement->bindValue('user_id', $advert['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('id', $advert['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $advert['title'], \PDO::PARAM_STR);
        $statement->bindValue('category_id', $advert['category_id'], \PDO::PARAM_INT);
        $statement->bindValue('description', $advert['description'], \PDO::PARAM_STR);
        $statement->bindValue('disponibility', $advert['disponibility'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function selectByUserId(int $id): array
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE user_id=:user_id");
        $statement->bindValue('user_id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectByCategoryId(int $id):array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE category_id=:category_id");
        $statement->bindValue('category_id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

}
