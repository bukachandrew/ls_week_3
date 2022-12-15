<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\Controller as BaseController;
use App\Model\Blog as BlogModel;

class Blog extends BaseController
{
    public function list()
    {
        $errors = [];
        $list = [];
        if (!isset($_SESSION['id'])) {
            header('location: /login');
        }
        $user = UserModel::getById($_SESSION['id']);
        if (!$user) {
            header('location: /login');
        }

        $blogQuery = new BlogModel();
        $list = $blogQuery->getList(20);

        if ($this->view) {
            return $this->view->render('Blog/list.html', [
                'errors' => $errors,
                'list' => $list,
                'user' => $user,
                'login' => true,
                'admin' => ($user['id'] == ADMIN_ID) ? true : false,
            ]);
        }
    }

    public function addMessage()
    {
        if (!isset($_SESSION['id'])) {
            header('location: /login');
        }
        $user = UserModel::getById($_SESSION['id']);
        if (!$user) {
            header('location: /login');
        }

        $message = null;
        if (!empty($_FILES['image']['tmp_name'])) {
            $fileContent = file_get_contents($_FILES['image']['tmp_name']);
            file_put_contents(PROJECT_ROOT_DIR . '/public/images/'. $_FILES['image']['name'], $fileContent);
            $message = '/images/'. $_FILES['image']['name'];
        }
        $blogQuery = new BlogModel();
        $blog = $blogQuery->save($user['id'], $_POST['message'], $message);

        if ($blog) {
            header('location: /blog');
        }
    }

    public function deleteMessage()
    {
        $list = [];
        if (!isset($_SESSION['id']) && !isset($_POST['blog_id'])) {
            header('location: /login');
        }
        $user = UserModel::getById($_SESSION['id']);
        if (!$user && $user['id'] == ADMIN_ID) {
            header('location: /login');
        }

        $blogQuery = new BlogModel();
        $blog = $blogQuery->delete($_POST['blog_id']);
        header('location: /blog');
    }

    public function userMessages() {
        if (!isset($_POST['user_id'])) {
            return json_encode([
                "message" => "Сообщений от пользователя с таким-то id нет",
                "code" => 422
            ]);
        }
        $blogQuery = new BlogModel();
        $list = $blogQuery->getListByUserId($_POST['user_id'], 20);
        if (!$list) {
            return json_encode([
                "message" => "Нет данных",
                "code" => 200
            ]);
        }
        return json_encode([
            "message" => "Успех",
            "data" => $list,
            "code" => 200
        ]);
    }
}