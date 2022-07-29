<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugger;

class Post extends Model
{
    use Slugger;

    protected $fillable = [
        'title', 'content', 'excerpt', 'category_id', 'image', 'slug', 'user_id',
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category'); // uno a molti
    }

    public function user() {    // il belongs to sta dalla parte dell'1 della relazione e il nome deve essere singolare
        return $this->belongsTo('App\Models\User'); // uno a molti; belongsTo la tabella con la foreign key
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag'); // molti a molti, tabella ponte suo entrambi i nomi delle funzioni al plurale
    }

    // per usare nei link lo slug anziche l'id; l importante che sia univoca
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
