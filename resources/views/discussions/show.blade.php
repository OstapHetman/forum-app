@extends('layouts.app')

@section('content')

  <div class="card mb-4 bg-info text-white">
      <div class="card-header">
          <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
          <span>{{ $d->user->name }}, <small>({{ $d->user->points }})</small></span>
          @if ($d->is_being_watched_by_auth_user())
            <a href="{{ route('unwatch', ['id' => $d->id]) }}" class="btn btn-success float-right btn-sm">unwatch</a>
          @else
            <a href="{{ route('watch', ['id' => $d->id]) }}" class="btn btn-success float-right btn-sm">watch</a>
          @endif

          @if (Auth::id() == $d->user->id)
            <a href="{{ route('discussion.edit', ['slug' => $d->slug]) }}" class="btn btn-secondary mr-2 float-right btn-sm">edit</a>
          @endif

      </div>

      <div class="card-body">
          <h4 class="text-center">
              {{ $d->title }}
          </h4>
          <hr>
          <p class="text-center">
              {!! Markdown::convertToHtml($d->content) !!}
          </p>
      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <p class="mb-0">{{ $d->replies->count() }} Replies</p>
        <span class="badge badge-warning">{{ $d->channel->title }}</span>
    </div>
  </div>

  @foreach ($d->replies as $r)
      
  <div class="card mb-4">
      <div class="card-header ">
        <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
        <span>{{ $r->user->name }}, <small>({{ $r->user->points }})</small></span>
        @if (Auth::id() == $r->user->id)
          @if (!$best_answer)
            <a href="{{ route('reply.best.answer', ['id' => $r->id]) }}" class="btn btn-primary btn-sm float-right text-white">Mark as Best Answer</a>
          @endif
        @endif

        @if ($best_answer && ($r->user->id == $best_answer->user_id))
          <span class="badge badge-success float-right">BEST ANSWER</span>
        @endif
      </div>

      <div class="card-body">
        <p class="text-center">
          {!! Markdown::convertToHtml($r->content) !!}
        </p>
      </div>

      <div class="card-footer">
        @if ($r->is_liked_by_auth_user())
          <a href="{{ route('reply.unlike', ['id' => $r->id]) }}" class="btn btn-danger">Unlike <span class="badge badge-light">{{ $r->likes->count() }}</span></a>
        @else
          <a href="{{ route('reply.like', ['id' => $r->id]) }}" class="btn btn-success">Like <span class="badge badge-light">{{ $r->likes->count() }}</span> </a>
        @endif
      </div>
  </div>

  @endforeach

  @if(Auth::check())
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
  @else
  <div class="text-center">
    <h2>Sign in to leave a reply.</h2>
  </div>
  @endif

@endsection
