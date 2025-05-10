<?php

// 読み方：ネームスペース App\Http\Controllers（エイチティーティーピー コントローラーズ） ／ 意味：このファイルが所属する名前空間を定義する
namespace App\Http\Controllers;

// 読み方：ユーズ App\Models\Post（モデルズ ポスト） ／ 意味：Postモデルをインポートする
use App\Models\Post;
// 読み方：ユーズ Illuminate\Http\Request（イリュミネート エイチティーティーピー リクエスト） ／ 意味：リクエストクラスをインポートする
use Illuminate\Http\Request;
// 読み方：ユーズ Illuminate\Support\Facades\Auth（イリュミネート サポート ファサード オース） ／ 意味：認証機能を提供するAuthファサードをインポートする
use Illuminate\Support\Facades\Auth;

// 読み方：クラス PostController（ポストコントローラー） エクステンズ Controller（コントローラー） ／ 意味：投稿を管理するコントローラークラスを定義し、基底コントローラーを継承する
class PostController extends Controller
{
    // 読み方：メソッド index（インデックス） ／ 意味：投稿一覧を表示し、検索キーワードがあれば絞り込む
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $posts = Post::with('user')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('body', 'like', "%{$keyword}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }

    // 読み方：メソッド create（クリエイト） ／ 意味：投稿作成フォームを表示する
    public function create()
    {
        return view('posts.create');
    }

    // 読み方：メソッド store（ストア） ／ 意味：投稿内容を保存する
    public function store(Request $request)
    {
        // 読み方：リクエスト バリデート ／ 意味：入力内容を検証する
        $request->validate([
            // 読み方：ボディ 必須 最大100文字 ／ 意味：本文は必須で最大100文字まで
            'body' => 'required|string|max:100',
        ]);

        // 読み方：ポスト コロンコロン クリエイト ／ 意味：新しい投稿データを作成し保存する
        Post::create([
            // 読み方：ボディ イコール リクエスト ボディ ／ 意味：本文にリクエストから取得した値をセット
            'body' => $request->body,
            // 読み方：ユーザーアイディー イコール オース アロー アイディー ／ 意味：現在認証中のユーザーIDをセット
            'user_id' => Auth::id(),
        ]);

        // 読み方：リターン リダイレクト ルート ポスツ インデックス ウィズ サクセス ／ 意味：投稿一覧画面にリダイレクトし、成功メッセージを表示する
        return redirect()->route('posts.index')->with('success', '投稿が作成されました');
    }

    // 読み方：メソッド edit（エディット） ／ 意味：投稿編集フォームを表示する
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を編集する権限がありません');
        }
        // 読み方：リターン ビュー ポスツ ドット エディット カンマ コンパクト ポスト ／ 意味：'posts.edit'ビューに編集対象の投稿データを渡して表示する
        return view('posts.edit', compact('post'));
    }

    // 読み方：メソッド update（アップデート） ／ 意味：投稿内容を更新する
    public function update(Request $request, Post $post)
    {
        // 読み方：リクエスト バリデート ／ 意味：入力内容を検証する
        $request->validate([
            // 読み方：ボディ 必須 最大100文字 ／ 意味：本文は必須で最大100文字まで
            'body' => 'required|string|max:100',
        ]);

        // 読み方：ポスト アロー アップデート ／ 意味：指定した投稿データを更新する
        $post->update([
            // 読み方：ボディ イコール リクエスト ボディ ／ 意味：本文にリクエストから取得した値をセット
            'body' => $request->body,
        ]);

        // 読み方：リターン リダイレクト ルート ポスツ インデックス ウィズ サクセス ／ 意味：投稿一覧画面にリダイレクトし、成功メッセージを表示する
        return redirect()->route('posts.index')->with('success', '投稿を更新しました');
    }

    // 読み方：メソッド destroy（デストロイ） ／ 意味：投稿を削除する
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'この投稿を削除する権限がありません');
        }
        // 読み方：ポスト アロー デリート ／ 意味：指定した投稿データを削除する
        $post->delete();
        // 読み方：リターン リダイレクト ルート ポスツ インデックス ウィズ サクセス ／ 意味：投稿一覧画面にリダイレクトし、成功メッセージを表示する
        return redirect()->route('posts.index')->with('success', '投稿を削除しました');
    }

}
