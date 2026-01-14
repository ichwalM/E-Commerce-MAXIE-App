<?php

namespace App\Actions;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class SendMessageAction
{
    public function execute(int $senderId, int $recipientId, string $body): Message
    {
        return DB::transaction(function () use ($senderId, $recipientId, $body) {
            // Find existing conversation or create new one
            // This is a simple direct message logic
            $conversation = Conversation::whereHas('participants', function ($q) use ($senderId) {
                $q->where('user_id', $senderId);
            })->whereHas('participants', function ($q) use ($recipientId) {
                $q->where('user_id', $recipientId);
            })->first();

            if (!$conversation) {
                $conversation = Conversation::create(['type' => 'direct']);
                ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $senderId]);
                ConversationParticipant::create(['conversation_id' => $conversation->id, 'user_id' => $recipientId]);
            }

            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $senderId,
                'body' => $body,
            ]);

            $conversation->touch(); // Update updated_at for sorting

            return $message;
        });
    }
}
