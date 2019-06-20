@extends('layouts.app')

@section('content')

  <div class="card mb-4 bg-info text-white">
      <div class="card-header">
          <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
          <span>{{ $d->user->name }}, <small>{{ $d->created_at->diffForHumans() }}</small></span>
      </div>

      <div class="card-body">
          <h4 class="text-center">
              {{ $d->title }}
          </h4>
          <hr>
          <p class="text-center">
              {{$d->content }}
          </p>
      </div>

      <div class="card-footer">
          <p class="mb-0">{{ $d->replies->count() }} Replies</p>
      </div>
  </div>

  @foreach ($d->replies as $r)
      
  <div class="card mb-4">
      <div class="card-header ">
        <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
        <span>{{ $r->user->name }}, <small>{{ $r->created_at->diffForHumans() }}</small></span>
      </div>

      <div class="card-body">
        <p class="text-center">
          {{$r->content }}
        </p>
      </div>

      <div class="card-footer">
        @if ($r->is_liked_by_auth_user())
          <a href="/" class="btn btn-danger">Unlike</a>
        @else
          <a href="/" class="btn btn-success">Like</a>
        @endif
      </div>
  </div>

  @endforeach

  <div class="card mb-4">
    <div class="card-body">
      <form action="{{ route('discussion.reply', ['id' => $d->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label><b>Leave a reply...</b></label>
          <textarea name="reply" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-success">Leave a reply</button>
        </div>
      </form>
    </div>
  </div>

@endsection
