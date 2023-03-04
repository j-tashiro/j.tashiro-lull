<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 2023.02.22 追加
use Illuminate\Support\Facades\Auth;

// 12行目のUserとUser.phpの10行目のclass Userを
// 同じ名前にすることでテーブルがリンクされ21行目のUser::が情報を受け取れるようになる
use App\User;


class UsersController extends Controller
{
    public function profile(){
        return view('users.profile');
    }
    // 2023.02.14 検索入力フォームの設置
    public function search(Request $request){
        $searchWord = $request->input('searchWord');
         // dd($searchWord);
        //  Laravel あいまい検索 で調べると分かりやすい
        if(!empty($searchWord)){
            $users = User::where ('username', 'LIKE', '%'.$searchWord.'%')->get();
        }
        else{
            // 30行目と31行目は同じ意味 30行目を理解した上で31行目の省略型を使おう
            // $users = User::where("id" , "!=" , Auth::user()->id)->get();
            $users = User::where("id" , "!=" , Auth::id())->get();
        }
        return view('users.search',['searchWord'=>$searchWord,'users'=>$users]);
    }

}
