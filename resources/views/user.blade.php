@extends('layouts.app')

@section('content')

<!-- User Information -->
<div class="card mb-4">
    <div class="card-header">
        <h3>{{ $user->name }}@if($user->is_admin == 1) <small class="h6 text-muted" >admin</small>@endif</h3>
    </div>
    <div class="card-body">
        bruker oprettet 
        <span class="relative-timestamp" title="{{ $user->created_at->format('Y-m-d H:i:s') }}">
            {{ $user->created_at->diffForHumans() }}
        </span>
     </div>
</div>

<!-- Threads -->
@if ($user->is_admin == 1)
    <div class="card mb-4">
        <div class="card-header">
            Brukerinlegg: ({{ $user->threads->count() }})
        </div>
        @foreach($user->threads as $key => $post)
            <div class="card-body">
                <a class="link-dark" href="{{ route('thread.show', $post->id) }}">{{ $post->title }}</a>
                <br>
                <span class="relative-timestamp" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                    {{ $post->created_at->diffForHumans() }}
                </span>
                @if($key < $user->threads->count() - 1)
                    <hr>
                @endif
            </div>
        @endforeach
    </div>
@endif

<!-- Comments -->
<div class="card mb-4">
    <div class="card-header">
        Kommentarer: ({{ $user->replies->count() }})
    </div>
    @foreach($user->replies as $key => $reply)
        <div class="card-body">
            <a class="link-dark" href="{{ route('thread.show', $reply->thread_id) }}">{{ $reply->thread->title }}</a>
            <div>{{ $reply->body }}</div>
            <span class="relative-timestamp" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
                {{ $post->created_at->diffForHumans() }}
            </span>
            @if($key < $user->replies->count() - 1)
                <hr>
            @endif
        </div>
    @endforeach
</div>
@endsection
