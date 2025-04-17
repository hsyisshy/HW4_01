{{-- resources/views/messages/index.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])

@extends('layouts.app')

@section('title', 'Threads')

@section('content')
    <div class="flex flex-col mb-2">

        <div class="threads-container" id="threads-container">
            @foreach ($messages as $message)
                @include('messages._message_card', ['message' => $message])
            @endforeach
        </div>
        @if ($hasMore)
            <div id="loading-spinner" class="flex-col items-center py-4 hidden">
                <div class="w-6 h-6 border-4 border-black border-t-transparent rounded-full animate-spin mb-2"></div>
                <span class="text-gray-500 text-sm">載入中...</span>
            </div>
            
        @endif
    </div>
@endsection
