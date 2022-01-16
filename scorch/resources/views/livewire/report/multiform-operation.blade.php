<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="container mx-auto bg-gray-50 mt-5 py-5 rounded">
        <div class="text-left mb-5 ">
            <h2 class="text-3xl font-bold py-8">{{$pages[$currentPage]['heading']}}</h2>
            <p class="mt-2 text-sm text-gray-400">{{$pages[$currentPage]['subheading']}}</p>
        </div>

        <div>
            @if (session()->has('message'))
            <div class="py-4 px-8 text-md mb-4 shadow rounded-md bg-green-300">
                <i class="mr-4 fas fa-check-circle"></i>
                {{ session('message') }}
            </div>
            @endif
        </div>


        @if ($currentPage === 1)
        <div class="w-5/5 mx-auto my-4">
            <div class="flex-inline space-y-3 w-full ">
                @foreach($opertypes as $operType)
                <div class="item">
                    <a class="block min-w-full 
                        pl-3 py-3
                        border-transparent border-2 rounded hover:border-indigo-500
                        text-gray-400 hover:text-black 
                        hover:bg-white
                        shadow-md cursor-pointer  
                        transition duration-400 ease-in-out" wire:click="select({{$operType}})">

                        <p class="font-medium">{{$operType->name}}</p>
                        <span class="text-sm">{{$operType->description}}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>




        @elseif($currentPage === 2)
        <div class="grid grid-cols-1 sm:grid-cols-5 ">
            <div class="grid col-span-2 mb-2">
                
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Fecha de Entrega</label>
                <input class="py-1 px-3 
                placeholder-gray-500 
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" 
                type="datetime-local"
                    wire:model="operation_date">
                @error('operation_date')
                <span class="text-xs text-red-500">Debes seleccionar una fecha</span>
                @enderror

                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Solicitante</label>
                <input
                    class="py-1 px-3 
                    placeholder-gray-500 focus:placeholder-white
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border-2 border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md"
                    type="" placeholder="Ingresar nombre" wire:model="petitioner">
                @error('petitioner')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror

                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Supervisor Encargado</label>
                <input
                class="py-1 px-3 
                placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border-2 border-transparent rounded focus:border-indigo-500  
                focus:shadow-md"
                    type="" placeholder="Ingresar nombre" wire:model="supervisor">
                @error('supervisor')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror

                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Responsable de Entrega</label>
                <input
                class="py-1 px-3 
                placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border-2 border-transparent rounded focus:border-indigo-500  
                focus:shadow-md"
                    type="" placeholder="Ingresar nombre" wire:model="deliveredby">
                @error('deliveredby')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror

                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Observaciones / Comentarios</label>

                <textarea name="" id=""
                    class="w-full min-h-[200px] max-h-[300px] h-28 
                    placeholder-gray-500 focus:placeholder-white
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md"
                    placeholder="Puede ingresar comentarios u/o observaciones" wire:model="comment">
                </textarea>

                <div class="mb-2">
                    <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Seleccionar Unidad Organizativa</label>
                    <select
                        class="placeholder-gray-500 focus:placeholder-white
                        bg-indigo-50 focus:bg-white focus:outline-none
                        border border-transparent rounded focus:border-indigo-500  
                        focus:shadow-md"
                        wire:model="ou_id">
                        <option value="">Sin seleccionar...</option>
                        @foreach($allOU as $ou)
                        <option value="{{ $ou->id }}">{{ $ou->name }}</option>
                        @endforeach
                    </select>
                    @error('ou_id')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror
         
                </div>
            </div>
        </div>








        @endif
        <!--Controles-->
        <div class="flex space-x-4 ">

            @if ($currentPage === 1)
            <div></div>
            @else
            <button wire:click="backPage" type="button"
                class="
                bg-transparent hover:bg-indigo-500 
                text-sm text-center tracking-wider text-gray-400 hover:text-white
                py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
                transition float-right">
                <div class="float-left mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                      </svg>
                </div>
                 Regresar
            </button>
            @endif

            @if ($currentPage === count($pages))
            <button type="button" wire:click="store"
            class="
            bg-indigo-400  hover:bg-indigo-500 
            text-sm  font-medium text-center tracking-wider text-white 
            py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
            transition float-right">
                Registrar y continuar
            </button>
            @endif
        </div>

        <!--Controles-->















    </div>
</div>