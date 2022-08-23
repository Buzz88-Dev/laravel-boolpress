<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $perPage = 20;
        $posts = Post::paginate($perPage);   // andiamo nel database a prenderci paginate(); capire meglio
        return view('admin.posts.index', compact('posts'));   // admin perche stiamo sotto ad Admin, posts perche siamo sotto a PostController e index perchè stiamo nel metodo index
                                                              // e siccome gli sto passando una sola variabile utilizzo il compact
    }


    public function create()
    {
        // mi prendo le categories e le passo al create per stampare una select composta da queste categories
        // stessa cosa faccio per la collection $tags che verra passato al fieldset Tags in create.blade.php
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }


    public function store(Request $request)
    {
        // dump($request->all()); // dump: per vedere cosa mi viene passato nel back-end quando clicco save in create.blade.php; decommentare e analizzare
        // dobbiamo fare la validation e il salvataggio all interno di store()
        // Validation: lo facciamo direttamente sulla $request
        $request->validate([
            'title'     => 'required|string|max:100',
            'slug'      => 'required|string|max:100|unique:posts',
            'category_id'  => 'required|integer|exists:categories,id',
            'tags'      => 'nullable|array',
            'tags.*'    => 'integer|exists:tags,id',
            // 'image'     => 'required_without:content|nullable|url',
            'image'     => 'required_without:content|nullable|file|image|max:1024',  // dimensione max in kilobytes
            'content'   => 'required_without:image|nullable|string|max:5000',
            'excerpt'   => 'nullable|string|max:200',
        ]);

        $form_data = $request->all();

        // salvare l immagine in public
        $img_path = Storage::put('uploads', $form_data['image']);

        // aggiornare il valore della chiave image con il nome dell immagine appena creata
        $form_data['image'] = $img_path;

        // dump($request->all());  // se la validation non passa torniamo nel form; se invece le validation passano ci stampera il dump; dopo aver inserito i campi, salvare e decommentare questo dump()
        $data = $form_data + [
            'user_id' => Auth::id(),
        ];
        // $request mi ritorna un array
        // dump($data);
        // dump(Auth::user())

        // salvataggio
        $post = Post::create($data);  // create accetta un array
        $post->tags()->sync($data['tags']);

        // redirect
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }


    public function show(Post $post)
    {
        // $user = $post->user()->first();    // $post->users() accediamo alla query; se facciamo poi il get otteniamo tutta la collection (array); mentre se faccio il first() lo prendo come oggetto in se (è direttamente utilzzabile)
        // $category = $post->categories()->first();
        // $user = $post->user;
        // $category = $post->category;  volevo passare user e category da compact ma lo indico direttamente in show.blade.php
        return view('admin.posts.show', compact('post'));
    }


    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }


    public function update(Request $request, Post $post)
    {
        // validation
        $request->validate([
            'title'     => 'required|string|max:100',
            'slug'      => 'required|string|max:100|unique:posts',
            'category_id'  => 'required|integer|exists:categories,id',
            'tags'      => 'nullable|array',
            'tags.*'    => 'integer|exists:tags,id',
            'image'     => 'required_without:content|nullable|url',
            'content'   => 'required_without:image|nullable|string|max:5000',
            'excerpt'   => 'nullable|string|max:200',
        ]);
        $data = $request->all();

        // aggiornare il database
        $post->update($data);

        // redirect
        return redirect()->route('admin.posts.show', ['post' => $post]);
    }


    public function destroy(Post $post)
    {
        $post->tags()->detach();  // da inserire quando c e una relazione molti a molti; errore perche c e una tabella ponte; detach() toglie tutto
        // $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
