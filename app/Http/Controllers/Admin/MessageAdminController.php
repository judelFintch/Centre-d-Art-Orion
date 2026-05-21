<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageAdminController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(20);
        $nonLus   = Message::nonLu()->count();
        return view('admin.messages.index', compact('messages', 'nonLus'));
    }

    public function show(Message $message)
    {
        if ($message->statut === 'non_lu') {
            $message->update(['statut' => 'lu', 'lu_le' => now()]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Message supprimé.');
    }
}
