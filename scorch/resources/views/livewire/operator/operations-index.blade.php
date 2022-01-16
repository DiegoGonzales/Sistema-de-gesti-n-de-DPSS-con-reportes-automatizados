<div>

    <div class="container mx-auto bg-gray-50 mt-5 py-5 rounded">

        <h2 class="text-3xl font-bold pt-3 pb-7">Operaciones Registradas</h2>


        <div class="grid w-auto h-full mb-6">
            <div class="box">
                <a href="{{route('operator.multiform-operation.index')}}" 
                class="
                bg-transparent hover:bg-indigo-500 
                font-bold text-xs uppercase text-center tracking-widest text-gray-400 hover:text-white
                py-5 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
                transition float-right">

                    Nueva Operación
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

        <!--
        {{$selectedOperation}}-->


        <table class="table rounded border-collapse w-full text-sm bg-white shadow mt-6">
            <thead class="text-xs uppercase text-indigo-300 text-left">
                <tr>
                    <th class="p-3 w-1/7 text-center">ID</th>
                    <th class="p-3 w-1/7 ">Tipo de Operación</th>
                    <th class="p-3 w-1/7 ">Unidad Organizativa</th>
                    <th class="p-3 w-1/7 text-center">Estado</th>
                    <th class="py-3 px-1 w-1/7 ">F. de Operación</th>
                    <th class="py-3 px-1 w-1/7 ">F. Ult. Modif. </th>
                    <th class="p-3 w-1/7 text-transparent">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($operations as $operation)

                <tr class="border-t border-gray-100">
                    <td class="py-3 ">
                        <div class="text-center">{{$operation->id}}</div>
                    </td>
                    <td>
                        <div class="py-1 px-3">{{$operation->type->name}}</div>
                    </td>
                    <td>
                        <div class="py-1 px-3">{{$operation->ou->name}}</div>
                    </td>

                    @switch($operation->active)
                    @case(0)
                    <td class="text-center text-xs tracking-wider">
                        <div class="py-1 px-3"><span
                                class="bg-blue-500 text-white rounded-md uppercase px-2">Pendiente</span></div>
                    </td>
                    @break
                    @case(1)
                    <td class="text-center text-xs tracking-wider">
                        <div class="py-1 px-3"><span
                                class="bg-green-400 text-white rounded-md uppercase px-2 ">Aprobada</span></div>
                    </td>
                    @break
                    @case(2)
                    <td class="text-center text-xs tracking-wider">
                        <div class="py-1 px-3 border-l"><span
                                class="bg-gray-500 text-white rounded-md uppercase px-2">Anulada</span></div>
                    </td>
                    @break
                    @default
                    @endswitch

                    <td>
                        <div class="py-1 px-1text-center">
                            <span>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $operation->operation_date)->format('d/m/Y')}}</span>
                        </div>
                    </td>
                    <td>
                        <div class="py-1 px-1text-center">
                            <span>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                                $operation->updated_at)->format('d/m/Y')}}</span>
                        </div>
                    </td>
                    <td class="text-md text-gray-400">
                        <div class="flex">
                            <div class="item">
                                <a href="{{route('operator.operations.show', $operation)}}"
                                    class="hover:text-indigo-500">
                                    <i class="fas fa-glasses"></i>
                                </a>
                            </div>
                            <div class="item ml-2">
                                <a href="{{route('operator.operations.modify', $operation)}}"
                                    class="hover:text-indigo-500">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="item">
                                <div>
                                    <!-- Modal -->
                                    <div x-data="{ showModal : false }">
                                        <!-- Button -->
                                        <button @click="showModal = !showModal"
                                            class="ml-2 transition-colors duration-150 ease-linear focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo"><i
                                                class="fas fa-times"></i></button>

                                        <!-- Modal Background -->
                                        <div x-show="showModal"
                                            class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0"
                                            x-transition:enter="transition ease duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                            <!-- Modal -->
                                            <div x-show="showModal"
                                                class="bg-white rounded-xl shadow-2xl p-6 sm:w-2/6	 mx-10"
                                                @click.away="showModal = false"
                                                x-transition:enter="transition ease duration-100 transform"
                                                x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                                x-transition:leave="transition ease duration-100 transform"
                                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                <!-- Title -->
                                                <span class="font-bold block text-2xl mb-3">🍺 Anular Operación </span>
                                                <!-- Some beer 🍺 -->
                                                <p class="mb-5"></p>
                                                <p>¿Esta seguro que quiere anular la operación seleccionada?</p>
                                                <!-- Buttons -->
                                                <div class="text-right space-x-5 mt-5">
                                                    <button @click="showModal = !showModal"
                                                        class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Mejor
                                                        no</button>
                                                    <a wire:click="cancel({{$operation}})"
                                                        class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">🍺
                                                        Esto seguro</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!--
                        <a wire:click="select({{$operation}})" class="hover:text-indigo-500 ml-2">
                            <i class="fas fa-edit"></i>
                        </a>-->




                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="block mt-2 pb-4">{{$operations->links()}}</div>




    </div>