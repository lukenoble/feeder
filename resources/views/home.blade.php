@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if(is_array($ordered_feed) && count($ordered_feed) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Source</th>
                            <th scope="col">Headline</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ordered_feed as $feed)
                        <tr>
                            <th scope="row"><a href="?feed_id={{$feed['feed_id']}}"><img src="{{$feed['image']}}" class="img-fluid" alt="Responsive image"></a></th>
                            <td><a href="{{$feed['link']}}">{{ $feed['title'] }}</a></td>
                            <td>{{ $feed['description'] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @else
                        <p>It looks like there is nothing in your feed. Why don't you go to the <a href="{{route('feeds')}}">feeds page</a> to set one up.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
