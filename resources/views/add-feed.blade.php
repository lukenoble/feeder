@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Feed</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('save-feed') }}">
                            @csrf
                            <div class="form-group">
                                <label for="InputUrl">Feed URL</label>
                                <input type="text" class="form-control" id="InputUrl" name="url" placeholder="Feed URL">
                            </div>
                            <div class="form-group">
                                <label for="feedSelect">Type of Feed</label>
                                <select class="form-control" id="feedSelect" name="feed_type">
                                    @foreach ($feed_types as $feed_type)
                                        <option>{{ $feed_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
