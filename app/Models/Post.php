<?php

namespace App\Models; // 読み方：ナームスペース アップ モデルズ ／ 意味：App配下のModels名前空間を指定

use Illuminate\Database\Eloquent\Model; // 読み方：ユース イルミネート データベース エロクアント モデル ／ 意味：EloquentのModelクラスをインポート

class Post extends Model // 読み方：クラス ポスト エクステンズ モデル ／ 意味：PostクラスはModelクラスを継承

{
  protected $fillable = ['title', 'body', 'user_id']; // 読み方：プロテクテッド フィラブル ／ 意味：代入可能な属性を指定（title, body, user_id）

  // 投稿はユーザーに属している
  public function user()
  {
    return $this->belongsTo(User::class);
  }

}
