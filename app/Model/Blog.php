<?php

namespace App\Model;

use Base\Model as BaseModel;
use Base\Db;

class Blog extends BaseModel
{
    public function createBlog(int $userId, string $message, string $image = null)
    {
        $blog = new Blog();
        $blog->user_id = $userId;
        $blog->message = $message;
        $blog->image = $image;
        $blog->save();
        return $blog['id'];
    }

    public function deleteBlog(int $messageId)
    {
        $data = Blog::where('id', $messageId)->delete();
        return $data;
    }

    public function getById(int $id)
    {
        $data = Blog::where('id', $id)->first();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function getListByUserId(int $id, int $limit = 20)
    {
        $data = User::where('id', $id)->with('blogs')->limit($limit)->get();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function getList(int $limit = 20)
    {
        $data = Blog::query()->with('user')->limit($limit)->get();
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}