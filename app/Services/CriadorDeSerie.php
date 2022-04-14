<?php

namespace App\Services;

use App\{Serie, Temporada};
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criar(
        string $nome,
        int $qtdTemporadas, 
        int $qtdEpisodiosPorTemporada
    ): Serie {
        
        $serie = null;
        DB::beginTransaction();

        $serie = Serie::create(['nome' => $nome]);
        $this->criaTemporadas($qtdTemporadas, $qtdEpisodiosPorTemporada, $serie);

        DB::commit();

        return $serie;
    }
    
    private function criaTemporadas(int $qtdTemporadas, int $qtdEpisodiosPorTemporada, Serie $serie)
    {        
        for ($i = 1; $i <= $qtdTemporadas ; $i++) {

            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($temporada, $qtdEpisodiosPorTemporada);
        }
    }
    
    private function criaEpisodios(Temporada $temporada, int $qtdEpisodiosPorTemporada)
    {        
        for ($j=1; $j <= $qtdEpisodiosPorTemporada; $j++) {

            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
