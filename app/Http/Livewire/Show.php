<?php

namespace App\Http\Livewire;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{
    public $datos, $termino, $tipoRes = "gifs";
    private Response $respuesta;
    public $readyToLoad = false;
    public string $res;

    private $busquedasInicio = ['green', 'marvel', 'space', 'blue'];

    public function mount()
    {
        $this->idVideo = rand(0, 200);
        $this->termino = $this->busquedasInicio[rand(0, 3)];
        $this->buscar();
    }

    public function loadResults()
    {
        $this->readyToLoad = true;
    }

    public function buscar()
    {
        if ($this->tipoRes == "gifs") {
            $this->buscarGifs();
        } elseif ($this->tipoRes == "imagenes") {
            $this->buscarImagenes();
        } elseif ($this->tipoRes == "videos") {
            $this->buscarVideos();
        }
    }

    public function search($tipo)
    {
        if ($tipo == "gifs") {
            $this->tipoRes = $tipo;
            $this->termino = $this->busquedasInicio[rand(0, 3)];
            $this->buscarGifs();
        } elseif ($tipo == "imagenes") {
            $this->tipoRes = $tipo;
            $this->buscarImagenes();
        } elseif ($tipo == "videos") {
            $this->tipoRes = $tipo;
            $this->buscarVideos();
        }
    }

    public function buscarGifs()
    {

        $this->respuesta = Http::get("https://api.giphy.com/v1/gifs/search?api_key=oyRB1czUtgUqAGWGUfET37v9KnoYq3oa&q=" . $this->termino . "&limit=45");
        $this->datos = $this->respuesta->json();

        if ($this->datos["data"] == []) {
            $this->res = "0";
        } else {
            $this->res = "1";
        }

        $this->reset('termino');
    }

    public function buscarImagenes()
    {
        if ($this->termino == null) {

            $this->respuesta = Http::get("https://pixabay.com/api/?key=25077191-8ef3e88a7eedef42519d4205e");
        } else {

            $this->respuesta = Http::get("https://pixabay.com/api/?key=25077191-8ef3e88a7eedef42519d4205e&q=" . $this->termino);
        }

        $this->datos = $this->respuesta->json();

        if ($this->datos["hits"] == []) {
            $this->res = "0";
        } else {
            $this->res = "1";
        }

        $this->reset('termino');
    }

    public function buscarVideos()
    {
        if ($this->termino == null) {

            $this->respuesta = Http::get("https://pixabay.com/api/videos/?key=25077191-8ef3e88a7eedef42519d4205e");
        } else {

            $this->respuesta = Http::get("https://pixabay.com/api/videos/?key=25077191-8ef3e88a7eedef42519d4205e&q=" . $this->termino);
        }

        $this->datos = $this->respuesta->json();

        if ($this->datos["hits"] == []) {
            $this->res = "0";
        } else {
            $this->res = "1";
        }

        $this->reset('termino');
    }

    public function render()
    {
        return view('livewire.show');
    }
}
