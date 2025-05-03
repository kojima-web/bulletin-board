@extends('layouts.app')

@section('content')
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
                <small>投稿者ID: {{ $post->user_id }} ｜ 投稿日: {{ $post->created_at }}</small><br>

                <!-- 編集リンク -->
                <a href="{{ route('posts.edit', $post->id) }}">編集</a>

                <!-- 削除フォーム -->
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
