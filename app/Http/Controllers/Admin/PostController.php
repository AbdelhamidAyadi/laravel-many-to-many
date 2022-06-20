<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreationMail;

use App\Models\Post;
use App\Models\Tag;

use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::All();

        return view('admin.posts.index',compact('posts','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        $tags = Tag::All();
        return view('admin.posts.create' , compact('categories' ,'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('posts_images',$data['image']);
            $data['image'] = $image_url ; 
        }

        $new_post = New Post();
        $new_post->fill($data);
        $new_post->slug = Str::of($new_post->title)->slug('-');
        $new_post->save();

        if ( array_key_exists('tags' , $data) ) {
            $new_post->tags()->attach($data['tags']);
        }

        $mail = New PostCreationMail($new_post);
        Mail::to($user->email)->send($mail);

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::All();
        $tags = Tag::All();
        $post_tags_id = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post' , 'categories', 'tags','post_tags_id'));
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
        $data = $request->all();
        if (array_key_exists('image', $data)) {
            if ($post->image) {
               Storage::delete($post->image);
            }
            $image_url = Storage::put('posts_images',$data['image']);
            $data['image'] = $image_url ; 
        }
        $post->slug = Str::of($post->title)->slug('-');
        $post->update($data);

        if ( array_key_exists('tags' , $data) ) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('admin.posts.index')->with('message', "The post: $post->title has been deleted with success!");
    }
}
