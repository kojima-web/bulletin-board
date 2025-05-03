@extends('layouts.app')

@section('content')
    <h1>投稿編集</h1>

    <form method="POST" action="{{ route('posts.update', $post->id) }}">
        @csrf
        @method('PUT')

        <label for="title">タイトル：</label><br>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"><br>
        @error('title')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <label for="body">本文：</label><br>
        <textarea name="body" id="body">{{ old('body', $post->body) }}</textarea><br>
        @error('body')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <button type="submit">更新する</button>
    </form>
@endsection
