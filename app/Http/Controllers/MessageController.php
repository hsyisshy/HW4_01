<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->get();
        return MessageResource::collection($messages);
    }

    public function show($id)
    {
        $message = Message::with('user')->findOrFail($id);
        return new MessageResource($message);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return new MessageResource($message);
    }

    public function update(Request $request, $id) {
        $message = Message::findOrFail($id);
        
        if ($message->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message->update([
            'content' => $request->content,
        ]);

        return new MessageResource($message);
    }

    public function destroy($id) {
        $message = Message::findOrFail($id);
        
        if ($message->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully'], 200);
    }
}
