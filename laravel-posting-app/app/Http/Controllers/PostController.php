<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // 投稿一覧画面
    public function index()
     {
        // ログイン中のユーザー情報を全て取得する。orderbyメソッドで作成日時が新しい順で取得する。
         $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
 
         return view('posts.index', compact('posts'));
     }

    //  詳細ページ
     public function show(Post $post)
     {
         return view('posts.show', compact('post'));
     }

     // 作成ページ
     public function create()
     {
         return view('posts.create');
     }

     // 作成機能
     public function store(PostRequest $request)
     {
        // インスタンス化する。
         $post = new Post();
         $post->title = $request->input('title');
         $post->content = $request->input('content');
         $post->user_id = Auth::id();
         $post->save();
 
        //  indexに投稿が完了しましたと表示する。
         return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
     }

     // 編集ページ
     public function edit(Post $post)
     {
        // Authファサードにより現在ログイン中のユーザーidを直接取得する。
         if ($post->user_id !== Auth::id()) {
            // エラーメッセージと共にリダイレクトする。
             return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
         }
 
         return view('posts.edit', compact('post'));
     }

     // 更新機能
     public function update(PostRequest $request, Post $post)
     {
        // Authファサードにより現在ログイン中のユーザーidを直接取得する。
         if ($post->user_id !== Auth::id()) {
             return redirect()->route('posts.index')->with('error_message', '不正なアクセスです。');
         }
 
        //  フォームからのデータを割り当てる。
         $post->title = $request->input('title');
         $post->content = $request->input('content');
        //  データを保存する。
         $post->save();
 
        //  フラッシュメッセージと共にリダイレクトする。
         return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
     }
}
