<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = [
            ['author' => 'Shan-Yu', 'content' => '這是一則測試留言'],
            ['author' => 'Alice', 'content' => 'Hello Laravel!'],
        ];

        return view('messages.index', ['messages' => $messages]);
    }

    public function create()
    {
        return view('messages.create');
    }
}


