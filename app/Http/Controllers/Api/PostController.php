<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // private function fixImageUrl($imgPath) {
    //     return $imgPath ? asset('storage/' . $imgPath) : null;
    // }
    public function index(Request $request)  // il Request è quell oggetto che contiene tutte le informazioni riguardo alla richiesta fatta dall utente (Header, indirizzo, parametri, cookie)
    {
        $per_page_default = 10;
        $per_page = $request->query('per_page', $per_page_default);
        // $per_page = $request->query('per_page', 9);   // ora vado in: http://127.0.0.1:8000/api/posts?page=1  e ottengo due oggetti data per page (cambiare numero pagina)
        if ($per_page < 1 || $per_page > 100){      // ho impostato 2 come valore per_page
            $per_page = $per_page_default;
            // return response()->json(['success' => false], 400);
            // return response()->json(['success' => false], 400);  // errore 400 lo troviamo in ispector, Network sotto a Status
        };
        $posts = Post::with('user')->with('category')->paginate($per_page);   // con with('user') mi aggiunge dentro al file json l oggetto user con i suoi dati; stessa cosa per la category
        // $posts = Post::paginate(15);

        // foreach ($posts as $post) {
        //     // $post->image = asset('storage/'. $post->image);
        //     $post->image = $this->fixImageUrl($post->image);
        // }

        // return 'sono la index dell api';
        //return response()->json(Post::all());  // con questa sinstassi mi ritorna un array di oggetti dove ogni oggetto rappresenta un data
        return response()->json([      // risposta sotto forma di json
            'success' => true,
            'response' => $posts                     // con questa sintassi mi ritorna un oggetto in cui i dati sono in data
        ]);
    }

    // Restituisce 9 post random per la homepage in Vue
    public function random() {
        // $sql = Post::with(['user', 'category', 'tags'])->limit(9)->inRandomOrder();  // metodo per estrarre dati random dal database; immagini random nella home
        $sql = Post::with(['user', 'category', 'tags'])->whereNotNull('image')->limit(9)->inRandomOrder();
        $posts = $sql->get();

        // foreach ($posts as $post) {
        //     // $post->image = asset('storage/'. $post->image);
        //     $post->image = $this->fixImageUrl($post->image);
        // }

        return response()->json([
            // 'sql'       => $sql->toSql(), // solo per debugging
            'success'   => true,
            'result'    => $posts,
        ]);
    }


    public function show($slug)
    {
        $post = Post::with(['user', 'category', 'tags'])->where('slug', $slug)->first();

        if ($post) {
            // $post->image = $post->image ? '/storage/' . $post->image : null;
            // $post->image = $post->image ? asset('storage/'. $post->image) : null;     // mi da errore; non mi fa vedere le immagini quando entro nel dettaglio
            $post->image = $this->fixImageUrl($post->image);
            return response()->json([
                'success'   => true,
                'result'    => $post
            ]);
        } else {
            return response()->json([
                'success'   => false,
            ]);
        }
    }


    // per usare new File(__DIR__ . '/../../storage/app/immagini/immagine' .$number. '.jpg'); in PostSeeder.php, decommentare i foreach ($posts as $post) e la private function fixImageUrl($imgPath)
}
