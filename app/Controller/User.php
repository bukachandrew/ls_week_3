<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\Controller as BaseController;

class User extends BaseController
{
    public function login()
    {
        if (isset($_SESSION['id'])) {
            header('location: /blog');
        }
        $errors = [];
        if (isset($_POST['email'])) {
            $user = UserModel::getByEmail($_POST['email']);
            if ($user == null) {
                $errors[] = "Неверный логин или пароль";
            }
            if ($user) {
                if ($user['password'] != UserModel::getPasswordHash($_POST['password'])) {
                    $errors[] = "Неверный логин или пароль";
                } else {
                    $_SESSION['id'] = $user['id'];
                    header('location: /blog');
                }
            }
        }

        if ($this->view) {
            return $this->view->render('User/login.html', [
                'errors' => $errors,
                'login' => false
            ]);
        }
    }

    public function registration()
    {
        $errors = [];
        $success = true;

        if ($_POST) {
            if (!isset($_POST['name']) || $_POST['name'] == '') {
                $errors[] = "Name не может быть пустым";
                $success = false;
            }

            if (!isset($_POST['email']) || $_POST['email'] == '') {
                $errors[] = "Email не может быть пустым";
                $success = false;
            }

            if (!isset($_POST['password']) || $_POST['password'] == '') {
                $errors[] = "Password не может быть пустым";
                $success = false;
            }

            if ($_POST['password'] != $_POST['confirm']) {
                $errors[] = "Password и Сonfirm не совпадают";
                $success = false;
            }

            if ($success) {
                $user = new UserModel();
                $user_id = $user->createUser($_POST['name'], $_POST['email'], $_POST['password']);

                $_SESSION['id'] = $user_id;
                header('location: /blog');
            }
        }


        if ($this->view) {
            return $this->view->render('User/registration.html', [
                'errors' => $errors,
                'login' => false,
            ]);
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: /login');
    }


    public function usersList($limit = 20)
    {
        if (!isset($_SESSION['id']) || $_SESSION['id'] != ADMIN_ID) {
            header('location: /login');
        }
        $errors = [];
        $users = new UserModel();
        $users = $users->getList(20);

        if ($this->view) {
            return $this->view->render('User/list.html', [
                'errors' => $errors,
                'users' => $users,
                'login' => true,
                'admin' => ($_SESSION['id'] == ADMIN_ID) ? true : false,
            ]);
        }
    }

    public function userInfo()
    {
        if (!isset($_SESSION['id']) || $_SESSION['id'] != ADMIN_ID) {
            header('location: /login');
        }
        $errors = [];
        $user = new UserModel();
        $user = $user->getById($_GET['user-id']);

        if ($this->view) {
            return $this->view->render('User/edit.html', [
                'errors' => $errors,
                'user' => $user,
                'login' => true,
                'admin' => ($_SESSION['id'] == ADMIN_ID) ? true : false,
            ]);
        }
    }

    public function userEdit() {
        if (!isset($_SESSION['id'])) {
            header('location: /login');
        }
        $user = UserModel::getById($_POST['id']);
        if (!$user) {
            header('location: /login');
        }

        $image = null;
        if (!empty($_FILES['image']['tmp_name'])) {
            $fileContent = file_get_contents($_FILES['image']['tmp_name']);
            file_put_contents(PROJECT_ROOT_DIR . '/public/images/'. $_FILES['image']['name'], $fileContent);
            $image = '/images/'. $_FILES['image']['name'];
        }
        $blogQuery = new UserModel();
        $blog = $blogQuery->editUser($user['id'], $_POST['name'], $_POST['email'], UserModel::getPasswordHash($_POST['password']), $image);

        if ($blog) {
            header('location: /users');
        }
    }

    public function deleteUser() {
        $list = [];
        if (!isset($_SESSION['id']) && !isset($_POST['blog_id'])) {
            header('location: /login');
        }
        $user = UserModel::getById($_SESSION['id']);
        if (!$user && $user['id'] == ADMIN_ID) {
            header('location: /login');
        }

        $userQuery = new UserModel();
        $user = $userQuery->deleteUser($_POST['user_id']);
        header('location: /users');
    }
}