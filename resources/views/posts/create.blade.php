@extends('layouts.app')

@section('content')
    <h1>新規投稿</h1>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <label for="body">本文：</label><br>
        <textarea name="body" id="body">{{ old('body') }}</textarea><br>
        @error('body')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <button type="submit">投稿する</button>
    </form>
@endsection
