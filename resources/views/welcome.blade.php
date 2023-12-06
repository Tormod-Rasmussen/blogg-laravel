@extends('layouts.app')

@section('content')

<!-- Threads -->
@foreach($threads as $post)
<div class="card mb-4">
    <div class="card-header">
        <a href="{{ route('thread.show', $post->id) }}" class="link-dark h3">{{ $post->title }}</a>
        <div >skrevet av <a href="{{ route('user.profile', $post->user->name) }}" class="link-dark"> {{ $post->user->name }}</a></div>
    </div>
    <div class="card-body">
        {{ Str::limit($post->body, 200) }}
        @if (strlen($post->body) > 200)
            <a href="{{ route('thread.show', $post->id) }}">Les mer</a>
        @endif
        <br>
        <span class="relative-timestamp" title="{{ $post->created_at->format('Y-m-d H:i:s') }}">
            {{ $post->created_at->diffForHumans() }}
        </span>
    </div>
</div>
@endforeach

<!-- Pagination -->
{{ $threads->links() }}

@endsection
