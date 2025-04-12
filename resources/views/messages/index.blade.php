{{-- resources/views/messages/index.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])

@extends('layouts.app')

@section('title', 'Threads')

@section('content')
<div class="threads-container">
    @foreach ($messages as $message)
        <div class="thread-card">
            <div class="thread-header">
                <img src="/icons/user.svg" alt="avatar" class="avatar">
                <div>
                    <div class="author">{{ $message['user']['name'] }}</div>
                    <div class="timestamp">{{ $message['created_at'] ?? '剛剛' }}</div>
                </div>
            </div>
            <div class="thread-content">
                {{ $message['content'] }}
            </div>
            <div class="thread-actions">
                <div class="thread-buttons">
                    <button class="">
                        ❤️
                    </button>
                    <span>
                        {{ $message['likes'] ?? 0 }}
                    </span>
                </div>
                <div class="thread-buttons">
                    <button class="">
                        💬
                    </button>
                    <span>
                        {{ $message['comments'] ?? 0 }}
                    </span>
                </div>
                <div>
                    <button class="">
                        🔁
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
