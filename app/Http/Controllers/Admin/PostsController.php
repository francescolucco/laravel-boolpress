<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prendo tutti i post e restituisco la struttura
        $posts = Post::orderBy('id', 'desc')->paginate(8);
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
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

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dump($request);

        $request->validate(
            $this->validateData(),
            $this->validateErrors(),
        );

        // inizializzo una variabile a cui assegno i dati del form
        $data = $request->all();

        // inizializzo una nuova variabile con modello Post
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateSlug($new_post->title);
        $new_post->save();

        // verifico l'esistenza dell'array tags
        // se esiste eseguo l'attach
        // devo vedere se la chiave tags esiste dentro l'array data: per fare questo utilizzo il metodo array_key_exists. In quale chiave? tags In quale array?? $data
        // ciò risulta così array_key_exists('data', $data)
        if (array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);
  
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

        if($post)
        {
            return view('admin.posts.show', compact('post'));
        }
        abort(404, 'Post non trovato');
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
        $categories = Category::all();
        $tagss = Tag::all();

        if($post){
            return view('admin.posts.edit', compact('post', 'categories', 'tagss'));
        }
        abort(404, 'Pagina non trovata');
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
        $request->validate(
            $this->validateData(),
            $this->validateErrors(),
        );

        $data = $request->all();

        
        if($data['title'] !== $post->title){
            $data['slug'] = Post::generateSlug($data['title']);
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }else{
            // $post->tags()->sync([]);
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
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
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', "Il post {$post->title} è stato eliminato");
    }

    private function validateData(){
        return [
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:4',
            // 'tags'=> 'required'
        ];
    }

    private function validateErrors(){
        return
        [
            'title.required'=>'Il testo è un campo obbligatorio',
            'title.min'=>'Il titolo deve essere lungo almeno 2 caratteri',
            'title.max'=>'Il titolo può essere lungo massimo 50 caratteri',
            'description.required'=>'Il testo è un campo obbligatorio',
            'description.min'=>'La descrizione deve essere lunga  almeno 2 caratteri',
            'description.max'=>'La descrizione può essere lungoa massimo 50 caratteri',
            // 'tags.required'=>'Selezionare almeno una casella',
        ];
    }
}
