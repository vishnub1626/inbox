<?php

namespace App\Http\Controllers;

use App\Inbox;

class InboxController extends Controller
{
    public function index()
    {
        return view('inbox', [
            'messages' => Inbox::latest('received_at')->paginate(3)
        ]);
    }

    public function find(Inbox $message)
    {
        return view('message', [
            'message' => $message
        ]);
    }
}
