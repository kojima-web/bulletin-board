<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * このアプリケーションの「ホーム」ルート。
     *
     * ユーザーが認証後にリダイレクトされる場所を指定します。
     *
     * @var string
     */
    public const HOME = '/posts';

    /**
     * アプリケーションのルートモデルバインディング、パターンフィルターなどを定義。
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
