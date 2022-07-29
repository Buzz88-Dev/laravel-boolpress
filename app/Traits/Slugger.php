<?php
namespace App\Traits;
use Illuminate\Support\Str;
trait Slugger
{
    static protected $slugColumnName = 'slug';
    static public function getSlug($strOrigin){
        $slugOrigin = Str::slug($strOrigin) . '';   // restituisce un oggetto; per questo motivo aggiungiamo una stringa vuota
        $slug = $slugOrigin;

        $i = 1;
        while (self::where(self::$slugColumnName, $slug)->first()) {
            $slug = $slugOrigin . '-' . $i;       // se entriamo nel ciclo restituisce una stringa altrimenti un oggetto
            $i++;
        }

        return $slug;
    }
}
?>
