<div class="flex flex-row pt-8">
    <div class="w-24 md:basis-60 bg-gray-900 pt-4 text-center min-h-screen mx-4">
        <h2 class="text-lg md:text-3xl text-blue-500 mb-6"><strong>Gifs, Images<br>&Video</strong></h2>

        @php
        $deshabilitado = "cursor-pointer w-full md:w-40 text-blue-500 text-xs md:text-2xl bg-gray-900 rounded-lg
        text-center inline-block align-middle border-2 border-blue-500 my-2 mt-8";
        $habilitado ="cursor-pointer w-full md:w-40 text-gray-900 text-xs md:text-2xl bg-blue-500 rounded-lg
        text-center inline-block align-middle border-2 border-gray-900 my-2 mt-8";
        @endphp

        <div class="{{ $tipoRes =='gifs'?  $deshabilitado : $habilitado }}" wire:click="search('gifs')">
            <strong>Gifs</strong>
        </div>
        <br>
        <div class="{{ $tipoRes =='imagenes'?  $deshabilitado : $habilitado }}" wire:click="search('imagenes')">
            <strong>Imágenes</strong>
        </div>
        <br>
        <div class="{{ $tipoRes =='videos'?  $deshabilitado : $habilitado }}" wire:click="search('videos')">
            <strong>Vídeos</strong>
        </div>
    </div>
    <div class="w-full">
        <div class="my-10 flex items-center ml-2">
            <div class="flex-1 mr-4">
                <input class="w-full h-6 md:h-10 pl-2 border-2 border-blue-500 bg-gray-900 text-blue-500" type="text"
                    wire:model.defer="termino" placeholder="Busca..">
            </div>
            <div class="cursor-pointer w-16 md:w-40 text-gray-900 text-l md:text-2xl bg-blue-500 rounded-lg text-center inline-block align-middle border-2 border-blue-900 mr-4"
                wire:click="buscar">
                <strong>Buscar</strong>
            </div>
        </div>
        <div>
            <div wire:loading wire:target="buscar" class="w-full">
                <div>
                    <img src="{{ asset('img/spinner.gif') }}" class="mx-auto">
                </div>
            </div>

            @if ($res == "1")
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mr-4 ml-2" wire:init="loadResults">

                @if ($tipoRes == "gifs")
                @foreach ($datos["data"] as $key => $item) <div class="rounded border-2 border-blue-500 p-2">
                    @php
                    $img = $datos["data"][$key]["images"]["downsized_medium"]["url"];
                    @endphp
                    <img src="{{ $img }}" alt="gif{{ $key }}">
                </div>
                @endforeach
                @endif

                @if ($tipoRes == "imagenes")
                @foreach ($datos["hits"] as $key => $item) <div class="rounded border-2 border-blue-500 p-2">
                    @php
                    $img = $datos["hits"][$key]["largeImageURL"];
                    @endphp
                    <img src="{{ $img }}" alt="gif{{ $key }}">
                </div>
                @endforeach
                @endif

                @if ($tipoRes == "videos")
                @foreach ($datos["hits"] as $key => $item) <div class="rounded border-2 border-blue-500 p-2">
                    @php
                    $ruta = $datos["hits"][$key]["videos"]["small"]["url"];
                    @endphp
                    <video controls id="{{ rand(1, 5000); }}">
                        <source src="{{ $ruta }}">
                    </video>
                </div>
                @endforeach
                @endif

                @elseif($res == "0")
                <div class="bg-blue-400 border border-l-8 border-blue-700 text-blue-700 p-4" role="alert">
                    <strong>No se han encontrado resultados con ese término..</strong>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>