@extends('layouts.app')

@section('content')
<form action="{{ route('posts.index') }}" method="GET" class="mb-4">
    <input type="text" name="keyword" placeholder="キーワードで検索" value="{{ request('keyword') }}">
    <button type="submit">検索</button>
</form>
@if($posts->isEmpty())
    <p>該当する投稿はありません。</p>
@endif
    <h1>投稿一覧</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('posts.create') }}">新規投稿はこちら</a>

    <ul>
        @foreach ($posts as $post)
            <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->body }}</p>
                <small>投稿者名: {{ $post->user->name }} ｜ 投稿日: {{ $post->created_at }}</small><br>

                @if (Auth::id() === $post->user_id)
                    <a href="{{ route('posts.edit', $post->id) }}">編集</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
