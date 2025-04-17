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
        // return MessageResource::collection($messages);
        $messages = Message::with('user')->latest()->paginate(10);
        return view('messages.index', [
            'messages' => MessageResource::collection($messages),
            'hasMore' => $messages->hasMorePages()
        ]);
    }

    public function loadMore(Request $request)
    {
        $page = $request->get('page', 1);
        $messages = Message::with('user')->latest()->paginate(10, ['*'], 'page', $page);
        return response()->json([
            'data' => MessageResource::collection($messages),
            'hasMore' => $messages->hasMorePages()
        ]);
    }

    // 🔹 前端頁面用
    public function indexPage()
    {
        $messages = Message::with('user')->latest()->get();

        return view('messages.index', [
            'messages' => $messages
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

        return redirect()->route('messages.index')->with('status', '貼文成功送出！');
    }

    public function update(Request $request, $id) {
        
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

    public function destroy($id) {
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
