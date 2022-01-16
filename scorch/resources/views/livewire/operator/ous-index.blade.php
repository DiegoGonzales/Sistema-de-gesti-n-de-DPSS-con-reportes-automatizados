<div class="container mx-auto bg-gray-50 mt-5 py-5 rounded">
    <h2 class="text-3xl font-bold pt-3 pb-7">Unidades Organizativas</h2>
    <div class="grid w-auto h-full mb-6">
        <div class="box">
            <a href="{{route('operator.ous.create')}}"" 
            class="bg-transparent hover:bg-indigo-500 
            font-bold text-xs uppercase  text-center tracking-widest text-gray-400 hover:text-white
            py-5 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
            transition float-right">
      
                Nueva UO
            </a>
        </div>
    </div>


     <!-- Buscador -->
     <div class="w-full mx-auto overflow-hidden mb-3 shadow">
        <div class="md:flex">
            <div class="w-full">
                <div class="relative text-gray-400">
                    <i class="absolute fa fa-search top-5 left-4"></i>
                    <input type="text" wire:keydown="clean_page" wire:model="search" class="h-14 w-full px-12 
                        bg-transparent focus:bg-white
                        border-2 rounded-md border-transparent focus:border-indigo-500 
                        text-sm placeholder-gray-500
                        transition" name="" placeholder="Buscar...">
                </div>
            </div>
        </div>
    </div>
    <!-- Buscador -->

    <!-- Table -->
    @if($ous->count())
    <table class="table rounded border-collapse w-full text-sm bg-white shadow mt-6">
        <thead class="text-xs uppercase text-indigo-300 text-left">
            <tr class="text-center">
                <th class="p-3 w-1/7">ID</th>
                <th class="p-3 w-1/7 ">Nombre</th>
                <th class="p-3 w-1/7 ">Nivel</th>
                <th class="p-3 w-1/7">Reporta a</th>
                <th class="py-3 px-1 w-1/7 ">Estado</th>
                <th class="p-3 w-1/7 text-transparent">Opciones</th>
            </tr>
        </thead>



        <tbody>
            @foreach ($ous as $ou)
            <tr class="border-t border-gray-100">
                <td class="py-3 px-3">
                    <div class="text-center">{{$ou->id}}</div>
                </td>
                <td class="py-1 px-3">
                    <p class="">
                        {{$ou->name}}
                    </p>
                    <p class="text-gray-500 text-sm font-semibold tracking-wide">
                        {{$ou->ruc}}
                    </p>
                </td>
                <td class="px-6 py-4 text-center">
                    @switch($ou->level)
                    @case(0)
                    <p class="">
                        SSEE
                    </p>
                    @break
                    @case(1)
                    <p class="">
                        Vicepresidencia
                    </p>
                    @break
                    @case(2)
                    <p class="">
                        Gerencia
                    </p>
                    @break
                    @case(3)
                    <p class="">
                        Superintendencia
                    </p>
                    @break
                    @default

                    @endswitch
                </td>
                <td class="px-6 py-4 text-center">
                    {{$ou->master['name']}}
                </td>
                <td class="px-6 py-4 text-center">
                    @switch($ou->status)
                    @case(0)
                    <span class="font-semibold text-xs uppercase text-gray-800 bg-gray-500 font-semibold px-2 rounded-full">
                        Inactivo
                    </span>
                    @break
                    @case(1)
                    <span class="font-semibold text-xs uppercase text-green-800 bg-green-200 font-semibold px-2 rounded-full">
                        Publicado
                    </span>
                    @break

                    @default

                    @endswitch

                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{route('operator.ous.edit', $ou)}}" class="text-purple-800 hover:underline">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="px-6 py-4">{{$ous->links()}}</div>
    @else
    <div class="px-6 py-4">No se encuentra registro</div>
    @endif

</div>