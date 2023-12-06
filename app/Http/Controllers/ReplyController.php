<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    public function store(Request $request, Thread $post)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|max:500'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = auth()->user();
        $reply = new Reply();
        $reply->body = $request->input('body');
        $reply->user_id = $user->id;
        $reply->thread_id = $post->id;
        $reply->save();
        return redirect()->route('thread.show', ['id' => $post->id]);
    }
}