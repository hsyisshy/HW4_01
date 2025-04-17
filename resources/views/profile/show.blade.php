@extends('layouts.app')

@section('title', '個人頁面')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar" class="profile-avatar">
        <div class="profile-info">
            <h2 class="profile-name">{{ Auth::user()->name }}</h2>
            <p class="profile-bio">探索中的 Laravel 學習者 🌱</p>
            <div class="profile-stats">
                <span>{{ $messages->count() }} Threads</span>・<span>120 Followers</span>・<span>80 Following</span>
            </div>
        </div>
    </div>

    <div class="threads-container">
        @foreach ($messages as $message)
            <div class="thread-card">
                <div class="thread-header">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="avatar" class="avatar">
                    <div>
                        <div class="author">{{ Auth::user()->name }}</div>
                        <div class="timestamp">{{ $message->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="thread-content">
                    {{ $message->content }}
                </div>
                <div class="thread-actions">
                    <div class="thread-buttons">
                        <button>❤️</button>
                        <span>{{ $message['likes'] ?? 0 }}</span>
                    </div>
                    <div class="thread-buttons">
                        <button>💬</button>
                        <span>{{ $message['comments'] ?? 0 }}</span>
                    </div>
                    <div>
                        <button>🔁</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
