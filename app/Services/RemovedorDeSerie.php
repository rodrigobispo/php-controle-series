<?php

namespace App\Services;

use App\{Episodio, Serie, Temporada};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';

        DB::transaction(function() use (&$nomeSerie, $serieId) {

            $serie = Serie::find($serieId);
    
            $nomeSerie = $serie->nome;

            $this->removeTemporadas($serie);
            $serie->delete();
        });
        
        return $nomeSerie;
    }
    
    private function removeTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada){ 
            $this->removeEpisodios($temporada);
            $temporada->delete();
        });
    }
    
    private function removeEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}