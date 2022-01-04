<div class="flex flex-row pt-8">
    <div class="basis-24 md:basis-60 text-center mr-6 min-h-screen border-r-2 border-blue-500">
        <div class="basis-24 md:basis-60 bg-gray-900 text-center mr-2 pt-4 min-h-screen">
            <h2 class="text-xl md:text-3xl text-blue-500 mb-6 px-2"><strong>Gifs, Images<br>&Video</strong></h2>
            <hr class="text-blue-500">
            <div class="cursor-pointer w-16 md:w-40 text-blue-500 text-l md:text-2xl bg-gray-900 rounded-lg text-center inline-block align-middle border-2 border-blue-500 my-2 mt-8"
                wire:click="search('gifs')">
                <strong>Gifs</strong>
            </div>
            <br>
            <div class="cursor-pointer w-16 md:w-40 text-blue-500 text-l md:text-2xl bg-gray-900 rounded-lg text-center inline-block align-middle border-2 border-blue-500 my-2"
                wire:click="search('imagenes')">
                <strong>Imágenes</strong>
            </div>
            <br>
            <div class="cursor-pointer w-16 md:w-40 text-blue-500 text-l md:text-2xl bg-gray-900 rounded-lg text-center inline-block align-middle border-2 border-blue-500 my-2"
                wire:click="search('videos')">
                <strong>Vídeos</strong>
            </div>

        </div>
    </div>
    <div class="flex-1 mr-4">
        <div class="my-10 flex items-center">
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
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3" wire:init="loadResults">

                @if ($tipoRes == "gifs")
                @foreach ($datos["data"] as $key => $item) <div class="rounded border-2 border-blue-500 p-2">
                    @php
                    $img = $datos["data"][$key]["images"]["downsized_medium"]["url"];
                    @endphp
                    <img src="{{ $img }}">
                </div>
                @endforeach
                @endif

                @if ($tipoRes == "imagenes")
                @foreach ($datos["hits"] as $key => $item) <div class="rounded border-2 border-blue-500 p-2">
                    @php
                    $img = $datos["hits"][$key]["largeImageURL"];
                    @endphp
                    <img src="{{ $img }}">
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