<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = MessageModel::with('user')->get();
        return response()->json(['data' => $messages], 200);
    }

    public function show($id)
    {
        $message = MessageModel::with('user')->findOrFail($id);
        return response()->json(['data' => $message], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message = MessageModel::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Message sent successfully', 'data' => $message,], 201);
    }

    public function update(Request $request, $id) {
        $message = MessageModel::findOrFail($id);
        
        if ($message->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message->update([
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Message updated successfully', 'data' => $message], 200);
    }

    public function destroy($id) {
        $message = MessageModel::findOrFail($id);
        
        if ($message->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully'], 200);
    }
}
