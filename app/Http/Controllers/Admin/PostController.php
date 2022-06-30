<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewPostCreated;
use App\Mail\PostUpdatedAdminMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderByDesc('id')->get();
        $categories= Category::all();
        $tags= Tag::all();
        /* $categories = Category::all(); */
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\PostRequest  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(PostRequest $request)
    {
        $request->all();
        $val_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;

        $val_data['user_id'] = Auth::id();

        if($request->hasfile('cover_image')){

            //validiamo il file

            $request->validate([
                'cover_image' => 'nullable|image|max:3000',
            ]);  

            //salvaggio del file nel filesystem

            //recuperiamo il percorso

            /* ddd($request->all()); */
            $path = Storage::put('post_images', $request->cover_image);

            /* ddd($path); */

            //passiamo il percorso all'array di dati validati per il salvataggio della risorsa
            $val_data['cover_image']= $path;

        }

        $new_post=Post::create($val_data);
        $new_post->tags()->attach($request->tags);
        
        Mail::to('account@mail.com')->send(new NewPostCreated($new_post));

        return redirect()->route('admin.posts.index')->with('message', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\PostRequest   $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // ($request->all());
        $val_data = $request->validate([
            'title'=> ['required', Rule::unique('posts')->ignore($post)],
            'category_id'=> 'nullable|exists:categories,id',
            'tags'=>'exists:tags,id',
            'cover'=> 'nullable',
            'content'=>'nullable',
        ]);

        $slug = Str::slug($request->title, '-');
        $val_data['slug'] = $slug;
        if($request->hasfile('cover_image')){
            //validiamo il file
            $request->validate([
                'cover_image' => 'nullable|image|max:3000',
            ]);  
            //salvaggio del file nel filesystem
            Storage::delete($post->cover_image);
            //recuperiamo il percorso
            /* ddd($request->all()); */
            $path = Storage::put('post_images', $request->cover_image);
            /* ddd($path); */
            //passiamo il percorso all'array di dati validati per il salvataggio della risorsa
            $val_data['cover_image']= $path;
        }

        $post->update($val_data);
        $post->tags()->sync($request->tags);

       // return(new PostUpdatedAdminMessage($post))->render();
       Mail::to('admin@boolpress.it')->send(new PostUpdatedAdminMessage($post));

        return redirect()->route('admin.posts.index')->with('message', "$post->title updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted");
    }
}
