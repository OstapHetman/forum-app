@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new channel</div>

                <div class="card-body">
                    <form action="{{ route('channels.store') }}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input type="text" class="form-control" name="channel" placeholder="Channel name">
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Save Channel</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
