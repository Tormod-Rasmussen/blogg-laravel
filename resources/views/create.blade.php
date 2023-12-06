@extends('layouts.app')

@section('content')

<!-- Thread Form -->
<div class="card mb-4">
    <div class="card-header">
        <h3>Oprett Inlegg</h3>
    </div>
    <div class="panel panel-default m-2">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <form method="POST" action="{{ route('thread.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">tittel:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="body">Innhold:</label>
                    <textarea id="body" name="body" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Opprett post</button>
            </form>
        </div>
    </div>
</div>
@endsection