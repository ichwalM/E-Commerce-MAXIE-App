<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actions\SendMessageAction;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $conversations = Conversation::whereHas('participants', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->with(['participants.user', 'messages' => function($q) {
            $q->latest()->limit(1);
        }])->orderBy('updated_at', 'desc')->get();

        return view('chat.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        // Ensure user is participant
        if (!$conversation->participants->contains('user_id', Auth::id())) {
            abort(403);
        }

        $conversation->load(['messages.sender', 'participants.user']);
        
        // Mark messages as read (simplified)
        $conversation->messages()->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('chat.show', compact('conversation'));
    }

    public function create(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'Cannot chat with yourself.']);
        }

        // Check if conversation exists
        $conversation = Conversation::whereHas('participants', function ($q) {
            $q->where('user_id', Auth::id());
        })->whereHas('participants', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->first();

        if ($conversation) {
            return redirect()->route('chat.show', $conversation);
        }

        return view('chat.create', compact('user'));
    }

    public function store(Request $request, SendMessageAction $action)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        $message = $action->execute(Auth::id(), $request->recipient_id, $request->body);

        return redirect()->route('chat.show', $message->conversation_id);
    }
}
