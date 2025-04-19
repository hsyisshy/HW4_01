@php use Carbon\Carbon; @endphp
<div class="thread-card">
    <div class="thread-header">
        <img src="/icons/user.svg" alt="avatar" class="avatar">
        <div>
            <div class="author">{{ $message['user']['name'] }}</div>
            <div class="timestamp">
                @if (isset($message['created_at']) && \Carbon\Carbon::parse($message['created_at'])->gt(now()->subMinute()))
                    剛剛
                @elseif(isset($message['created_at']))
                    {{ \Carbon\Carbon::parse($message['created_at'])->diffForHumans() }}
                    {{-- {{ $message['created_at'] }} --}}
                @else
                    剛剛
                @endif
            </div>
        </div>
    </div>
    <div class="thread-content">
        {{ $message['content'] }}
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
