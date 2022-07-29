<?php

use App\Models\Tag;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $posts = Post::all();
        $tags = Tag::all()->pluck('id');    // col pluck() estraggo gli id
        $nTags = count($tags);

        foreach ($posts as $post) {
            $postTags = $faker->randomElements($tags, rand(0, $nTags ));

            foreach ($postTags as $tagId) {
                $post->tags()->attach($tagId);  // questo attach() mi permette di scrivere sulla tabella ponte la relazione che mi lega l oggetto $post con l id dell oggetto di $tagId
            }
        }

        // entro nel tinker: php artisan tinker   ---> $faker = Faker\Factory::create() ---> $faker->randomElements([1,2,3,4,5], 0)   ---> click e analizzare (cambiare numero al posto di 0 e testare)
        // tinker mi da errore
    }
}
