@extends('layouts.app')

@section('title', '個人頁面')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <img src="/icons/user.svg" alt="Avatar" class="profile-avatar">
        <div class="profile-info">
            <h2 class="profile-name">Shan-Yu</h2>
            <p class="profile-bio">探索中的 Laravel 學習者 🌱</p>
            <div class="profile-stats">
                <span>32 Threads</span>・<span>120 Followers</span>・<span>80 Following</span>
            </div>
        </div>
    </div>

    <div class="threads-container">
        {{-- 以下可重複使用 index.blade.php 的 thread-card --}}
        @foreach ($messages as $message)
            <div class="thread-card">
                <div class="thread-header">
                    <img src="https://via.placeholder.com/40" alt="avatar" class="avatar">
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
</div>
@endsection
