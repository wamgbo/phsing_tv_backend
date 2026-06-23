<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // 建議引入關聯的型別提示

// 1. 在 Fillable 中加入 'tags'，允許批量賦值 (Mass Assignment)
#[Fillable(['name', 'email', 'password', 'tags'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // 2. 新增 tags 型別轉換：寫入資料庫是 JSON 字串，讀取出來會自動變成 PHP Array
            'tags' => 'array', 
        ];
    }

    /**
     * 3. 取得該用戶「追蹤了哪些人」 (Following)
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'user_follows',  // 中介表名稱
            'follower_id',   // 自己在中介表的外鍵
            'following_id'   // 對方在中介表的外鍵
        )->withTimestamps(); // 自動維護 created_at 與 updated_at
    }

    /**
     * 4. 取得「哪些人追蹤了該用戶」 (Followers / 粉絲)
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 
            'user_follows', 
            'following_id',  // 注意：這裡的外鍵位置要與上面對調
            'follower_id'
        )->withTimestamps();
    }
}