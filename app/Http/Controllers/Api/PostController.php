<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)  // il Request è quell oggetto che contiene tutte le informazioni riguardo alla richiesta fatta dall utente (Header, indirizzo, parametri, cookie)
    {
        $per_page = $request->query('per_page', 9);   // ora vado in: http://127.0.0.1:8000/api/posts?page=1  e ottengo due oggetti data per page (cambiare numero pagina)
        if ($per_page < 1 || $per_page > 10){      // ho impostato 2 come valore per_page
            return response()->json(['success' => false], 400);  // errore 400 lo troviamo in ispector, Network sotto a Status
        };
        $posts = Post::with('user')->with('category')->paginate($per_page);   // con with('user') mi aggiunge dentro al file json l oggetto user con i suoi dati; stessa cosa per la category
        // $posts = Post::paginate(15);

        // return 'sono la index dell api';
        //return response()->json(Post::all());  // con questa sinstassi mi ritorna un array di oggetti dove ogni oggetto rappresenta un data
        return response()->json([      // risposta sotto forma di json
            'success' => true,
            'response' => $posts                     // con questa sintassi mi ritorna un oggetto in cui i dati sono in data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
