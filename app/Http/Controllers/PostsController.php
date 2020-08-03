<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::orderBy('created_at', 'desc')->simplePaginate(10);
        $posts = Post::latest()->filter(request(['month','year']))->get();



        $archives = Post::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) as published')->groupBy('year','month')->orderByRaw('min(created_at) desc')->get();
        return view('home',compact(['posts','archives']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image'))
        {
            $imageToStore = $request->file('cover_image')->store('public');
        }
        else
        {
            $imageToStore = 'noimage.jpg';
        }

        auth()->user()->publish(new Post([ //you can perform it lik this -> request(['','',''])
            'title' => request('title'),
            'body'  => request('body'),
            'cover_image' => $imageToStore
        ]));

        // $post = new Post;
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');
        // $post->user_id = auth()->user()->id;
        // $post->cover_image = $imageToStore;
        // $post->save();

        return redirect('posts')->with('success','Post Created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post === NULL)
        {
            abort(404);
        }
        if(isset(auth()->user()->id))
        {
            if(auth()->user()->id == $post->user_id)
            {
                return view('posts.single')->with('post',$post);
            }
             abort(404);
        }
        return view('posts.single')->with('post',$post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);


        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
            Storage::delete($post->cover_image);
            $post->cover_image = $request->file('cover_image')->store('public');
        }
        $post->save();

        return redirect('posts')->with('success','Post Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete($post->cover_image);
        Post::destroy($id);
        return redirect('posts')->with('success','Deleted Successfully');
    }
}
