<?php
//読み方：タグ「PHP（ピー・エイチ・ピー）」
//意味：このファイルは PHP言語で書かれていることを示します。


use Illuminate\Database\Migrations\Migration;
// 読み方：イリュミネート・データベース・マイグレーション・ミグレーション
// 意味：マイグレーション（テーブル構造を定義するクラス）を使うための宣言です。

use Illuminate\Database\Schema\Blueprint;
// 読み方：イリュミネート・データベース・スキーマ・ブループリント
// 意味：テーブルの設計図（カラム定義）を記述するために使います。

use Illuminate\Support\Facades\Schema;
// 読み方：イリュミネート・サポート・ファサード・スキーマ
// 意味：テーブルの作成や削除などを行うSchemaクラスを使えるようにします。

return new class extends Migration
// 読み方：マイグレーションクラスを継承する無名クラスを返す
// 意味：Laravelがマイグレーションとして実行できるクラスを作成しています。

{
    /**
     * Run the migrations.
     */
    public function up(): void
    // 読み方：アップ関数（テーブルを作成する処理）
    // 意味：この関数内で新しいテーブル（posts）を定義してデータベースに作成します。
    {
        Schema::create('posts', function (Blueprint $table) {
        // 読み方：スキーマの create メソッドで「posts」テーブルを作成する
        // 意味：「posts」という名前のテーブルを新たに作る指示です。

            $table->id(); // 投稿ID
            // 読み方：IDカラム（主キー）を追加
            // 意味：自動的に連番が振られる投稿IDを作成します。

            $table->string('title'); // タイトル（短いテキスト）
            // 読み方：タイトル用の文字列カラムを追加
            // 意味：投稿のタイトルを保存するカラムで、255文字以内の短文が対象です。

            $table->text('body');    // 本文（長文OK）
            // 読み方：本文用のテキストカラムを追加
            // 意味：投稿の内容を保存するための、長文に対応したカラムです。

            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 投稿者のID
            // 読み方：投稿者IDとして外部キーを設定し、ユーザーが削除されたら投稿も削除
            // 意味：「users」テーブルのIDと連携して、誰が投稿したかを記録します。
            //        「onDelete('cascade')」により、ユーザー削除時にその人の投稿も一緒に削除されます。

            $table->timestamps();    // created_at と updated_at
            // 読み方：作成日と更新日を自動で記録するカラムを追加
            // 意味：投稿がいつ作られたか、いつ更新されたかの日時を自動で記録します。
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    // 読み方：ダウン関数（テーブルを削除する処理）
    // 意味：マイグレーションを元に戻すときに、この関数が呼ばれます。

    {
        Schema::dropIfExists('posts');
        // 読み方：「posts」テーブルが存在していれば削除
        // 意味：ロールバック時に「posts」テーブルを削除する処理です。
    }
};
