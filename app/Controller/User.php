<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\Controller as BaseController;

class User extends BaseController
{
    public function login()
    {
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
            return $this->view->render('User/login.phtml', [
                'errors' => $errors
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
                $user_id = $user->save($_POST['name'], $_POST['email'], $_POST['password']);

                $_SESSION['id'] = $user_id;
                header('location: /blog');
            }
        }


        if ($this->view) {
            return $this->view->render('User/registration.phtml', [
                'errors' => $errors
            ]);
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: /login');
    }

}