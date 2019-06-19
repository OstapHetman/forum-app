@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">Channels</div>

      <div class="card-body">
          <table class="table table-hover">
            <thead>
              <th>Name</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              @foreach ($channels as $channel)
                <tr>
                  <td> {{ $channel->title }} </td>
                  <td><a href="{{ route('channels.edit', ['channel' => $channel->id]) }}" class="btn btn-warning btn-xs">Edit</a></td>
                  <td>
                      <form action="{{ route('channels.destroy', ['channel' => $channel->id]) }}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                      </form>
                      
                  </td>
                </tr>

              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection
