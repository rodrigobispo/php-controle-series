<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request)
    {
        $episodios = $temporada->episodios;
        $mensagem = $request->session()->get('mensagem');

        return view('episodios.index', compact('episodios', 'temporada', 'mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;

        $temporada->episodios->each(
            function (Episodio $ep) use ($episodiosAssistidos) {
                $ep->assistido = in_array($ep->id, $episodiosAssistidos);
        });

        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados como assistidos.');

        return redirect()->back(); // igualmente: return redirect('/temporadas/' . $temporada->id . '/episodios');
    }
}
