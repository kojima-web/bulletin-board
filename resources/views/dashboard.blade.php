@extends('layouts.app')

@section('content')
    <div class="py-12 px-6">
        <h1 class="text-2xl font-bold mb-4">ダッシュボード</h1>

        <ul class="list-disc pl-5 space-y-2">
            <li><a href="{{ route('posts.index') }}" class="text-blue-600 underline">▶ 投稿一覧ページへ</a></li>
            <li><a href="{{ route('posts.create') }}" class="text-green-600 underline">＋ 新規投稿はこちら</a></li>
        </ul>
    </div>
@endsection
