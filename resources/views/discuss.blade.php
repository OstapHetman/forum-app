@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Create a new discussion</div>

        <div class="card-body">
            <form action="{{ route('discussion.store') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="form-group">
                    <label>Pick a channel</label>
                    <select name="channel_id" class="form-control">
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ask a question</label>
                    <textarea name="content" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        Create discussion
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
