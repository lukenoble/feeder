@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-primary"href="{{route('add-feed')}}">Add New Feed</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">View</th>
                            <th scope="col">url</th>
                            <th scope="col">Feed Type</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($feeds as $feed)
                            <tr>
                                <th scope="row"><a class="btn btn-secondary" href="/home?feed_id={{$feed->id}}" role="button">View Feed</a></th>
                                <td >{{$feed->url}}</td>
                                <td>{{$feed->feed_type->name}}</td>
                            @if(is_null($feed->deleted_at))
                                <td>
                                    <form method="POST" action="{{route('disable-feed')}}">
                                        @csrf
                                        <input type="hidden" id="feed_id" name="feed_id" value="{{ $feed->id }}">
                                        <button type="submit" class="btn btn-danger">Disable</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <form method="POST" action="{{route('enable-feed')}}">
                                        @csrf
                                        <input type="hidden" id="feed_id" name="feed_id" value="{{ $feed->id }}">
                                        <button type="submit" class="btn btn-success">Enable</button>
                                    </form>
                                </td>
                            @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
