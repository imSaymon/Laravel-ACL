<?php

namespace App\Http\Controllers;

use App\Thread;
use Exception;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        try {
            $reply = $request->all();
            $reply['user_id'] = 1;
            
            $thread = Thread::find($request->thread_id);
            $thread->replies()->create($reply);

            return redirect()->back();

        } catch(Exception $e) {
            return redirect()->back();
        }
    }
}
