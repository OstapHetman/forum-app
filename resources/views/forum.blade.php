@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($discussions as $d)
        <div class="card mb-4">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" alt="" width="70px" height="70px">
            </div>
    
            <div class="card-body">
                {{ $d->content }}
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $discussions->links() }}
    </div>
</div>
@endsection
