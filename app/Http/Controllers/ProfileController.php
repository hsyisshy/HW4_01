<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $messages = Message::where('user_id', $request->user()->id)->latest()->get();

        return view('profile.show', [
            'messages' => $messages,
        ]);
    }
}
