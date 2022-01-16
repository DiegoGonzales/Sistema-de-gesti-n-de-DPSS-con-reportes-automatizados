<div>
    <style>
        .bg-gradient {
            background: linear-gradient(270deg, #00ffbd, #cf94ff);
            background-size: 400% 400%;

            -webkit-animation: AnimationName 30s ease infinite;
            -moz-animation: AnimationName 30s ease infinite;
            animation: AnimationName 30s ease infinite;
        }

        @-webkit-keyframes AnimationName {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        @-moz-keyframes AnimationName {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        @keyframes AnimationName {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }
    </style>
    <div class="container bg-gradient rounded-lg">
        <div class="w-full my-3 py-8">
            <h1 class="text-3xl font-bold ">Reportes de Disponibilidad</h1>
        </div>

        @auth
        @if (Auth::user()->role == 0)
        <div class="pb-5">
            <!--Opciones -->
            <div class="">
                <a href="{{route('operator.availability.create')}}">
                    <div
                        class="px-6 py-6 
                        bg-white bg-opacity-25 hover:bg-opacity-100
                        text-white hover:text-black
                         rounded-md border-2 border-white
                         shadow-md hover:shadow-xl 
                         transition duration-300 ease-in-out">
                        <p class="text-left font-medium">Registrar un corte de Disponibilidad</p>
                        <div class="flex justify-between ">
                            <span class="inline-flex items-center leading-none text-sm">
                                Importa un .xlsx de AntaSalud
                            </span>
                            <div class="inline-flex items-center leading-none text-4xl">
                                <i class="fas fa-file-import"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
           
        @endauth



        

            <!--Listado de Cortes de Disponibilidad -->

            <div>
                <table class="table rounded border-collapse w-full text-sm bg-white shadow mt-6">
                    <thead class="text-xs uppercase text-gray-500 text-left">
                        <tr>
                            <th class="p-3 w-1/4 text-center">N°</th>
                            <th class="p-3 w-1/4 ">Estado</th>
                            <th class="py-3 px-1 w-1/4 ">Fecha</th>
                            <th class="py-3 px-1 w-1/4 ">Hora</th>
                            <th class="p-3 w-1/4 text-transparent">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                        <tr class="border-t border-gray-100 ">
                            <td class="px-3 py-3 text-center">
                                <div>{{$record->id}}</div>
                            </td>
                            <td class=" text-xs tracking-wider">
                                @switch($record->active )
                                @case(0)
                                    <div class="py-1 px-3"><span
                                            class="bg-gray-800 text-white rounded-md uppercase px-2">Pendiente</span></div>
                                @break
                                @case(1)
                                    <div class="py-1 px-3"><span
                                            class="bg-green-400 text-white rounded-md uppercase px-2 ">Publicado</span></div>
                                @break
                                @default
                                @endswitch
                            </td>
                            <td>
                                <div class="">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->date)->format('d/m/Y')}}</div>
                            </td>
                            <td>
                                <div class="">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->date)->format('h:i a')}}</div>
                            </td>
                            <td class="py-3">
                                <div class="flex space-x-2">
                                    <div class="item">
                                        <a href="{{route('operator.availability.show', $record)}}" class="hover:text-indigo-500 transition-colors ease-linear">
                                            <i class="fas fa-glasses"></i>
                                        </a>
                                    </div>
                                    @auth
                                    @if (Auth::user()->role == 0)
                                    <!-- Modal -->
                                    <div x-data="{ showModal : false }" class="item">
                                        <!-- Button -->
                                        <button @click="showModal = !showModal" class="hover:text-indigo-500 transition-colors  focus:border-transparent ease-linear"><i class="far fa-eye"></i></button>
                        
                                        <!-- Modal Background -->
                                        <div x-show="showModal" class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                            <!-- Modal -->
                                            <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-2/6	 mx-10" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                                                <!-- Title -->
                                                <span class="font-bold block text-2xl mb-3">¿Desear publicar el corte seleccionado?</span>
                                                <!-- Some beer 🍺 -->
                                                <p class="mb-5"></p>
                                                <p>Al ser publicado este corte sera visible para los supervisores</p>
                                                <!-- Buttons -->
                                                <div class="text-right space-x-5 mt-5">
                                                    <button @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Aun no</button>
                                                    <a wire:click="publish({{$record}})" class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo"><i class="fas fa-check-double"></i> Estoy seguro</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endauth
                                    
                        
                                </div>

                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--Listado de Cortes de Disponibilidad -->
            <div class="block mt-2 pb-4">{{$records->links()}}</div>
        </div>
        


    </div>
</div>