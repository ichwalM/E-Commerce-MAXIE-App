<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        \Illuminate\Support\Facades\View::composer('components.app-layout', function ($view) {
            $unreadCount = 0;
            if (\Illuminate\Support\Facades\Auth::check()) {
                $user = \Illuminate\Support\Facades\Auth::user();
                // Count unread messages in conversations where the user is a participant
                // Message must be NOT from the user AND read_at is null
                // We need to query messages relative to conversations the user is in.
                // A simpler query: Message where sender != user AND conversation has user AND read_at null
                
                $unreadCount = \App\Models\Message::where('sender_id', '!=', $user->id)
                    ->whereNull('read_at')
                    ->whereHas('conversation.participants', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })
                    ->count();
            }
            $view->with('unreadMessagesCount', $unreadCount);
        });
    }
}
