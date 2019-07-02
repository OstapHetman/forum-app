@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Update a discussion</div>

        <div class="card-body">
            <form action="{{ route('discussion.update', ['id' => $discussion->id]) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Ask a question</label>
                    <textarea name="content" rows="10" class="form-control">{{ $discussion->content }}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        Update discussion
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
