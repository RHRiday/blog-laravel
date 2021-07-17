<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'home', 'createSlug', 'postTags', 'show', 'tag', 'user']
        ]);
    }
    /**
     * Create a slug using the title.
     */
    public function createSlug($string)
    {
        return preg_replace('/[^a-z0-9\-]/', '', str_replace(' ', '-', strtolower($string)));
    }

    /**
     * Make Post available tags.
     */
    public function postTags()
    {
        $c = [];
        foreach (DB::table('posts')->select('tag')->get() as $data) {
            array_push($c, $data->tag);
        }
        return array_unique($c);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $data = DB::table('posts')->orderByDesc('created_at')->get();
        return view('welcome')->with([
            'posts' => $data,
            'tags' => $this->postTags()
        ]);
    }

    /**
     * Redirect back to root.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create', [
            'tags' => $this->postTags()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts,title|string|max:120',
            'description' => 'required|string',
            'tag' => 'required|string|max:25',
            'cover' => 'required|image|max:1024'
        ]);

        $img = uniqid(Auth::id() . time()) . '.' . $request->cover->extension();
        $request->cover->move(public_path('images/post'), $img);

        Post::create([
            'title' => ucfirst($request->input('title')),
            'slug' => $this->createSlug($request->title),
            'description' => ucfirst($request->input('description')),
            'tag' => ucfirst($request->input('tag')),
            'img_path' => $img,
            'user_id' => Auth::id()
        ]);

        return redirect('/')->with('success', 'Your blog has been posted. Please browse through');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show')->with([
            'data' => $post,
            'slugName' => $this->createSlug($post->user->name),
            'tags' => $this->postTags(),
            'prev' => Post::where('id', '<', $post->id)->max('id'),
            'next' => Post::where('id', '>', $post->id)->min('id')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(404);
        } else {
            return view('post.create')->with([
                'data' => $post,
                'tags' => $this->postTags()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:120|unique:posts,title,' . $post->id,
            'description' => 'required|string',
            'tag' => 'required|string|max:25',
            'cover' => 'image|max:1024'
        ]);


        if ($request->cover) {
            $img = uniqid(Auth::id() . time()) . '.' . $request->cover->extension();
            $request->cover->move(public_path('images/post'), $img);
        } else {
            $img = $post->img_path;
        }
        $post->update([
            'title' => ucfirst($request->input('title')),
            'slug' => $this->createSlug($request->title),
            'description' => ucfirst($request->input('description')),
            'tag' => ucfirst($request->input('tag')),
            'img_path' => $img
        ]);

        return redirect(route('post.show', $post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id);
        $post->delete();

        return redirect('/')->with('success', 'Your blog has been Deleted.');
    }

    /**
     * Filer Post according to tag.
     * and return index view with those Post
     *
     * @param  string  $tag
     * @return \Illuminate\Http\Response
     */
    public function tag($tag)
    {
        $data = Post::where('tag', ucfirst($tag))->get();
        return view('welcome')->with([
            'posts' => $data,
            'tags' => $this->postTags()
        ]);
    }

    /**
     * Filer Post according to user.
     * and return index view with those Post
     *
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */
    public function user($user)
    {
        $data = Post::where('user_id', User::where('name', str_replace('-', ' ', $user))->first()->id)->get();
        return view('welcome')->with([
            'posts' => $data,
            'tags' => null,
            'user' => User::where('name', str_replace('-', ' ', $user))->first()->name
        ]);
    }
}
