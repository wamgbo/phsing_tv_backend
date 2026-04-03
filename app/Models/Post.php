<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['username', 'password'];

    // app/Models/Post.php
    public function scopeIndex($query)
    {
        return $query->get();
    }
    public function scopeRecent($query)
    {
        // 自定義邏輯：只拿 3 天內更新的資料
        return $query->where('updated_at', '>=', now()->subDays(3));
    }

    public function scopeByUsername($query, $name)
    {
        // 帶參數的自定義邏輯
        return $query->where('username', $name);
    }
}
