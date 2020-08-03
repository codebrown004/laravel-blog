@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <div class="col-md-8">
        {{-- <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div> --}}
        <h1>Posts</h1>
        @if(count($posts) > 0)
            @foreach($posts as $post)
            <hr>
                <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="{{Storage::url($post->cover_image)}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <p>{!!$post->body!!}</p>
                        <small>written on {{$post->created_at->toDayDateTimeString()}} by {{$post->user->name}}</small>
                        @auth 
                            <form action="/posts/{{$post->id}}" method="POST">
                                 @csrf  @method('DELETE')
                              <input type="submit" name="submit" class="btn btn-danger btn-sm float-right" value="Delete Post"> 
                            </form>
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-sm float-right">Edit Post</a>
                        @endauth
                    </div>
                </div>
                </div>
            @endforeach
            {{-- {{$posts->links()}} --}}
        @else
            <h3>No posts to show</h3>
        @endif
    </div>
    @include('layouts.sidebar')
@endsection
