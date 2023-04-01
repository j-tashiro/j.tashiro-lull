<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
// 2023.04.01 Auth::userを起動させるために必要な記述
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // 2023.03.31 フォローリスト
    public function followList()
    {
        // 2023.04.01 フォローしているユーザーのidを取得
        // https://takuma-it.com/laravel-pluck/
        // https://course.lull-inc.co.jp/curriculum/7821/
        $following_id = Auth::user()->follows()->pluck('followed_id');

        // 2023.04.01 フォローしているユーザーのidを元に投稿内容を取得
        // https://qiita.com/miriwo/items/553dccbae72a25b5467b
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();

        $users = User::whereIn('id', $following_id)->get();
        return view('follows.followList',['users'=>$users,'posts'=>$posts]);
    }

    // 2023.03.31 フォロワーリスト
    public function followerList()
    {
        $list = User::get();
        return view('follows.followerList',['post'=>$list]);
    }
}
