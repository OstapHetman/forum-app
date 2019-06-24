@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($discussions as $d)
        <div class="card mb-4">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{ $d->user->name }}, <small>{{ $d->created_at->diffForHumans() }}</small></span>
                @if ($d->hasBestAnswer())
                    <span class="btn btn-success btn-sm float-right ml-2">CLOSED</span>
                @else
                    <span class="btn btn-danger btn-sm float-right ml-2">OPEN</span>
                @endif
                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-secondary float-right btn-sm">View</a>
            </div>
    
            <div class="card-body">
                <h4 class="text-center">
                    {{ $d->title }}
                </h4>
                <p class="text-center">
                    {{ str_limit($d->content, 50) }}
                </p>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <p class="mb-0">{{ $d->replies->count() }} Replies</p>
                <span class="badge badge-warning">{{ $d->channel->title }}</span>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $discussions->links() }}
    </div>
</div>
@endsection
