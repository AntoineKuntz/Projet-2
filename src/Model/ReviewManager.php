<?php

namespace App\Model;

class ReviewManager extends AbstractManager
{
    /**
     * Insert new item in database
     */
    public function insert(array $user): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`lastName`, `firstName`, `age`, `mail`, `password`, `adresseNumber`, 
        `adresseStreet`,`adressePostal`,`adresseCity`, `phoneNumber`, `avatar` ) 
        VALUES (:lastName, :firstName, :age, :mail, :password, :adresseNumber, 
        :adresseStreet, :adressePostal, :adresseCity, :phoneNumber, :avatar)");

        $statement->bindValue('lastName', $user['lastName'], \PDO::PARAM_STR);
        $statement->bindValue('firstName', $user['firstName'], \PDO::PARAM_STR);
        $statement->bindValue('age', $user['age'], \PDO::PARAM_STR);
        $statement->bindValue('mail', $user['mail'], \PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], \PDO::PARAM_STR);
        $statement->bindValue('adresseNumber', $user['adresseNumber'], \PDO::PARAM_INT);
        $statement->bindValue('adresseStreet', $user['adresseStreet'], \PDO::PARAM_STR);
        $statement->bindValue('adressePostal', $user['adressePostal'], \PDO::PARAM_INT);
        $statement->bindValue('adresseCity', $user['adresseCity'], \PDO::PARAM_STR);
        $statement->bindValue('phoneNumber', $user['phoneNumber'], \PDO::PARAM_INT);
        $statement->bindValue('avatar', $user['avatar'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
