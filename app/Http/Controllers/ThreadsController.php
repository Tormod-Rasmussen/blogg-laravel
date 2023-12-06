<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadsController extends Controller
{
    public function index()
    {
        $threads = Thread::latest()->paginate(10);
        return view(view:'welcome')->with(compact('threads'));
        return 'test';
    }

    public function show($id)
    {
        $post = Thread::findorfail($id);
        $unsortedReplies = $post->replies;
        $replies = $unsortedReplies->sortByDesc('created_at');
        return view('post')->with(compact('post', 'replies'));
    }
    public function create()
    {
        return view('create')->with(compact('user'));
    }
    public function store(Request $request)
    {

        if (Auth::guest() || !auth()->user()->is_admin) { // not logged in or not admin
            return redirect()->back()
                ->with('error', 'You do not have permission to create threads.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

    
        $thread = new Thread([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id
        ]);
        
        $thread->save();
        return redirect()->route('home');
    }
}
