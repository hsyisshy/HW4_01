{{-- resources/views/messages/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Threads')

@section('content')
<div class="threads-container">
    @foreach ($messages as $message)
        <div class="thread-card">
            <div class="thread-header">
                <img src="/icons/user.svg" alt="avatar" class="avatar">
                <div>
                    <div class="author">{{ $message['author'] }}</div>
                    <div class="timestamp">{{ $message['created_at'] ?? '剛剛' }}</div>
                </div>
            </div>
            <div class="thread-content">
                {{ $message['content'] }}
            </div>
            <div class="thread-actions">
                ❤️ 7　💬 1　🔁
            </div>
        </div>
    @endforeach
</div>
@endsection
