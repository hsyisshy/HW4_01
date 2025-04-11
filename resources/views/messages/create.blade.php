{{-- resources/views/messages/create.blade.php --}}
@extends('layouts.app')

@section('title', '發文 Threads')

@section('content')
<div class="thread-card">
    <form method="POST" action="{{ route('messages.store') }}">
        @csrf
        <div class="thread-header">
            <img src="/icons/user.svg" class="avatar" alt="avatar">
            <div>
                <input type="text" name="author" placeholder="你的名字" class="input-author" required>
            </div>
        </div>

        <div class="thread-content-area">
            <textarea name="content" rows="5" placeholder="分享你的想法..." required></textarea>
        </div>

        <div class="form-submit">
            <button type="submit">送出 Threads</button>
        </div>
    </form>
</div>
@endsection
