<!DOCTYPE html>
 <html lang="ja">
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>投稿詳細</title>
 </head>
 
 <body>
     <header>
         <nav>
             <a href="{{ route('posts.index') }}">投稿アプリ</a>
 
             <ul>
                 <li>
                  <!-- onclick処理以降で、javaを実行する(ブラウザのイベント処理を実行しないようにする。) -->
                   <!-- logout-formというidを持つHTML要素を取得し、フォームに送信する。 -->
                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST">
                         @csrf
                     </form>
                 </li>
             </ul>
         </nav>
     </header>
 
     <main>
         <h1>投稿詳細</h1>
         <a href="{{ route('posts.index') }}">&lt; 戻る</a>

         <!-- フラッシュメッセージを表示する。 -->
         @if (session('flash_message'))
             <p>{{ session('flash_message') }}</p>
         @endif
 
         <article>
             <h2>{{ $post->title }}</h2>
             <p>{{ $post->content }}</p>

             <!-- ユーザーIDと現在ログイン中のidを比較し、一致する場合に編集ボタンを表示する。 -->
             @if ($post->user_id === Auth::id())
                 <a href="{{ route('posts.edit', $post) }}">編集</a>
             @endif

         </article>
     </main>
 
     <footer>
         <p>&copy; 投稿アプリ All rights reserved.</p>
     </footer>
 </body>
 
 </html>
