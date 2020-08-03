@extends('layouts.app')
@section('title', 'Single Post')

@section('content')
	<div class="well">
	<div class="row">
	    <div class="col-md-4 col-sm-4">
	        <img style="width:100%" src="{{Storage::url($post->cover_image)}}">
	    </div>
	    <div class="col-md-8 col-sm-8">
	        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
	        <p>{!!$post->body!!}</p>
	        <small>written on {{$post->created_at->toFormattedDateString()}} by {{$post->user->name}}</small>
	        @auth 
	            <form action="/posts/{{$post->id}}" method="POST">
	                 @csrf  @method('DELETE')
	              <input type="submit" name="submit" class="btn btn-danger btn-sm float-right" value="Delete Post"> 
	            </form>
	            <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-sm float-right">Edit Post</a>
	        @endauth
	        <h2>Comments</h2>
	        <ul class="list-group">
		        @foreach($post->comments as $comment)
		        	<li class="list-group-item">{{$comment->body}} {{ $comment->created_at->diffForHumans()}}</li>
		        @endforeach
	        </ul>

	        <form action="/posts/{{$post->id}}/comment" method="POST">
	        	@csrf
		       	<div class="form-group">
		       		<textarea name="body" class="form-control" placeholder="Write your comment here..."></textarea>
		       		<input type="submit" value="Submit" class="btn btn-primary">
		       	</div>
	        	
	        </form>
	    </div>
	</div>
@endsection

<!--diffForHumans
