@extends('layouts.app')

@section('content')

<!-- post -->
<div class="card mb-4">
    <div class="card-header">
        <h2>{{ $post->title }}</h2>
        <div >skrevet av <a class="link-dark" href="{{ route('user.profile', Str::slug($post->user->name, '-')) }}">{{ $post->user->name }}</a></div>
    </div>
    <div class="card-body">
        {{ $post->body }}
        <br>
        <span class="relative-timestamp" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
            {{ $post->created_at->diffForHumans() }}
        </span>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Kommentarer: ({{ $replies->count() }})
    </div>

    <!-- Reply Form -->
    @if (Auth::check())
        <div class="panel panel-default m-2">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <form method="POST" action="{{ route('reply.store', ['post' => $post]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="body">Skriv en kommentar:</label>
                        <textarea id="body" name="body" class="form-control my-2" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lagre kommentar</button>
                </form>
            </div>
        </div>
    @else
        <div class="panel panel-default m-2">
            <button type="submit" class="btn btn-primary" href="{{ route('login') }}">Logg inn for å kommentere
            </button>
        </div>
    @endif

    <!-- Replies -->
    @foreach($replies->values() as $index => $reply)
    <div class="card-body {{ $index % 2 === 0 ? 'gray' : '' }}">
        {{ $reply->body }}
        <br>
        <a class="link-dark" href="{{ route('user.profile', Str::slug($reply->user->name, '-')) }}">
            {{ $reply->user->name }}
        </a>   
        <span class="relative-timestamp" title="{{ $reply->created_at->format('Y-m-d H:i:s') }}">
            {{ $reply->created_at->diffForHumans() }}
        </span>

    </div>
    @endforeach
</div>
@endsection
