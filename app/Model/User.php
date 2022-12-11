<?php

namespace App\Model;

use Base\Model as BaseModel;
use Base\Db;

class User extends BaseModel
{

    public function save($name, $email, $password)
    {
        $db = Db::getInstance();
        $queryUserAdd = "INSERT INTO `users` (`name`, `email`, `password`) 
            VALUES (:user_name, :user_email, :user_password)";
        $id = $db->exec($queryUserAdd, [
            ':user_name' => $name,
            ':user_email' => $email,
            ':user_password' => self::getPasswordHash($password)
        ]);
        return $id;
    }

    public static function getById(int $id)
    {
        $db = Db::getInstance();
        $queryUser = "SELECT * FROM `users` WHERE `id` = :user_id";
        $data = $db->fetchOne($queryUser, [':user_id' => $id]);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public static function getByEmail(string $email)
    {
        $db = Db::getInstance();
        $queryUser = "SELECT * FROM `users` WHERE `email` = :user_email";
        $data = $db->fetchOne($queryUser, [':user_email' => $email]);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('kxwZ0aBB' . $password);
    }


}