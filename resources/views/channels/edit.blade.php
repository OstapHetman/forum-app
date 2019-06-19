@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">Update a channel</div>

      <div class="card-body">
          <form action="{{ route('channels.update', ['channel'=> $channel->id]) }}" method="post">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
              <input type="text" class="form-control" name="channel" placeholder="Channel name" value="{{ $channel->title }}">
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-success">Update Channel</button>
            </div>
          </form>
                
        </div>
    </div>
</div>
@endsection
