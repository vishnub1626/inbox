<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Inbox;

class InboxController extends Controller
{
    public function index()
    {
        $q = request('q');

        $messages = Inbox::query()
            ->when($q, function ($query, $q) {
                $query->search($q);
            })->latest('received_at')
            ->paginate(30);

        if ($q) {
            ActivityLog::logUserActivity("User searched for {$q}");
        }

        return view('inbox', [
            'messages' => $messages
        ]);
    }

    public function find(Inbox $message)
    {
        return view('message', [
            'message' => $message
        ]);
    }

    public function destroy(Inbox $message)
    {
        try {
            $message->delete();

            return response()->json([
                'message' => 'Message deleted!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete the message.',
            ]);
        }
    }
}
