<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Resources\MessageResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use AuthorizesRequests;

    // 🔹 API 用
    public function index()
    {
        $messages = Message::with('user')->get();
        return MessageResource::collection($messages);
    }

    // 🔹 前端頁面用
    public function indexPage()
    {
        $messages = Message::with('user')->latest()->get();

        $messagesArray = $messages->map(function ($msg) {
            return [
                'author' => $msg->user->name ?? '匿名',
                'content' => $msg->content,
                'created_at' => $msg->created_at->diffForHumans(),
            ];
        });

        return view('messages.index', [
            'messages' => $messagesArray
        ]);
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

    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        $this->authorize('update', $message);

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message->update([
            'content' => $request->content,
        ]);

        return new MessageResource($message);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        $this->authorize('delete', $message);

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully'], 204);
    }

    // ✨ 建立新留言
    public function create()
    {
        return view('messages.create');
    }
}
