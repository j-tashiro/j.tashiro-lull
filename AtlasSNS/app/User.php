<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


// 10行目のUserとUsersControllerのUserを
// 同じ名前にすることでテーブルがリンクされ情報を受け取れるようになる
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

// 2023.03.08 リレーションテーブル同士を連結させる
// 今回のフォロー機能はユーザーがユーザーをフォローする関係だからuserテーブル同士でリレーションする
// 多対多 リレーション https://qiita.com/ramuneru/items/db43589551dd0c00fef9
// Laravel belongsToMany https://solomaker.club/how-to-use-laravel-orm-belongs-to-many/
// 第一引数 User::class
// 第二引数 follows
// 第三引数 followed_id following_id
// 第四引数 following_id followed_id
public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
}

public function follows()
{
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
}



// 2023.03.07 フォローボタン
// フォローする
public function follow(Int $user_id)
{
    return $this->follows()->attach($user_id);
}

// フォロー解除する
public function unfollow(Int $user_id)
{
    return $this->follows()->detach($user_id);
}

// フォローしているか
public function isFollowing(Int $user_id)
{
    return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
}

// フォローされているか
public function isFollowed(Int $user_id)
{
    return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
}

// ['id']の部分がエラーの原因

}


