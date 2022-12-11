<?php

namespace App\Model;

use Base\Model as BaseModel;
use Base\Db;

class Blog extends BaseModel
{
    public function save(int $userId, string $message, string $image = null)
    {
        $db = Db::getInstance();
        $queryUserAdd = "INSERT INTO `blog` (`user_id`, `message`, `image`) 
            VALUES (:user_id, :user_message, :user_image)";
        $id = $db->exec($queryUserAdd, [
            ':user_id' => $userId,
            ':user_message' => $message,
            ':user_image' => $image
        ]);
        return $id;
    }

    public function delete(int $messageId)
    {
        $db = Db::getInstance();
        $queryUserAdd = "DELETE FROM `blog` WHERE `id` = :message_id";
        $data = $db->exec($queryUserAdd, [
            ':message_id' => $messageId,
        ]);
        return $data;
    }

    public function getById(int $id)
    {
        $db = Db::getInstance();
        $queryUser = "SELECT * FROM `blog` WHERE `id` = :blog_id";
        $data = $db->fetchOne($queryUser, [':blog_id' => $id]);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function getListByUserId(int $id, int $limit = 20)
    {
        $db = Db::getInstance();
        $queryBlog = "SELECT blog.id, blog.message, blog.created_at, blog.user_id, users.name, users.email FROM `blog`, `users` WHERE users.id = blog.user_id AND blog.user_id = :blog_id LIMIT $limit";
        $data = $db->fetchAll($queryBlog, ['blog_id' => $id]);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function getList(int $limit = 20)
    {
        $db = Db::getInstance();
        $queryBlog = "SELECT blog.*, users.name, users.email FROM `blog`, `users` WHERE blog.user_id = users.id LIMIT $limit";
        $data = $db->fetchAll($queryBlog);
        if (!$data) {
            return null;
        }
        return $data;
    }
}