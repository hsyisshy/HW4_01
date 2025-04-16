{{-- resources/views/messages/index.blade.php --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])

@extends('layouts.app')

@section('title', 'Threads')

@section('content')
    <div class="flex flex-col">

        <div class="threads-container" id="threads-container">
            @foreach ($messages as $message)
                @include('messages._message_card', ['message' => $message])
            @endforeach
        </div>
        @if ($hasMore)
            <div class="load-more-container text-center my-4 flex justify-center">
                <button id="load-more"
                    class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-black duration-300">載入更多</button>
            </div>
        @endif
    </div>
@endsection
