<?php

namespace App\Model;

use Base\Model as BaseModel;
use Base\Db;

class User extends BaseModel
{

    public function createUser($name, $email, $password)
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = self::getPasswordHash($password);
        $user->save();
        return $user['id'];
    }

    public static function getById(int $id)
    {
        $data = User::where('id', $id)->first();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public static function getByEmail(string $email)
    {
        $data = User::where('email', $email)->first();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('kxwZ0aBB' . $password);
    }

    public function getList(int $limit = 20)
    {
        $data = User::query()->limit($limit)->get();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function editUser(int $id, string $name, string $email, string $password = null, string $image = null)
    {
        $user = User::where('id', $id)->first();
        $user->name = $name;
        $user->email = $email;
        if ($password) {
            $user->password = $password;
        }
        if ($image) {
            $user->image = $image;
        }
        $user->save();
        return $user['id'];
    }

    public function deleteUser(int $userId)
    {
        $data = User::where('id', $userId)->delete();
        return $data;
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }
}