<?php
// 読み方：App\Http\Controllers\PostController ／ 意味：投稿コントローラー
use App\Http\Controllers\PostController;
// 読み方：App\Http\Controllers\ProfileController ／ 意味：プロフィールコントローラー
use App\Http\Controllers\ProfileController;
// 読み方：Illuminate\Support\Facades\Route ／ 意味：ルーティングファサード
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 読み方：Route::get('/', function () {...}) ／ 意味：トップページの表示
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('posts.index');
    }
    return redirect()->route('login');
});


// 読み方：Route::middleware('auth')->group(function () {...}) ／ 意味：認証済みユーザー向けのルートグループ
Route::middleware('auth')->group(function () {
    // 読み方：Route::get('/profile', [ProfileController::class, 'edit']) ／ 意味：プロフィール編集画面の表示
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // 読み方：Route::patch('/profile', [ProfileController::class, 'update']) ／ 意味：プロフィール情報の更新
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // 読み方：Route::delete('/profile', [ProfileController::class, 'destroy']) ／ 意味：プロフィール削除
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 読み方：Route::get('/posts', [PostController::class, 'index']) ／ 意味：投稿一覧の表示
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // 読み方：Route::get('/posts/create', [PostController::class, 'create']) ／ 意味：投稿作成画面の表示
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    // 読み方：Route::post('/posts', [PostController::class, 'store']) ／ 意味：新規投稿の保存
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    // 読み方：Route::get('/posts/{post}/edit', [PostController::class, 'edit']) ／ 意味：投稿編集画面の表示
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    // 読み方：Route::put('/posts/{post}', [PostController::class, 'update']) ／ 意味：投稿の更新
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    // 読み方：Route::delete('/posts/{post}', [PostController::class, 'destroy']) ／ 意味：投稿の削除
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// 読み方：require __DIR__.'/auth.php' ／ 意味：認証関連ルートの読み込み
require __DIR__.'/auth.php';
