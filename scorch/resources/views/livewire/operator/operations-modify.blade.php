<div class="container mx-auto bg-gray-50 mt-5 py-5 rounded">
    <div>
        <div>
            <div>
                @if (session()->has('errormsg'))
                <div class="py-4 px-8 text-md mb-4 shadow rounded-md bg-green-300">
                    <i class="mr-4 fas fa-check-circle"></i>
                    {{ session('errormsg') }}
                </div>
                @endif
            </div>

            <!--Notificaciones-->
            <div x-data="{show: false}" x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                x-init="@this.on('updated', () => { show = true; setTimeout(() => { show = false;}, 4000)})"
                style="display:: none" class="py-4 px-8 text-md mb-4 shadow rounded-md bg-green-300">
                <i class="mr-4 fas fa-check-circle"></i>
                {{ session('message') }}
            </div>


            <!--Notif. Acta confirmada -->
            <div x-data="{show: false}" x-show="show"
                x-init="@this.on('confirmed', () => { show = true; setTimeout(() => { show = false;}, 2500)})"
                x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display:: none"
                class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0">
                <div x-show="show" x-transition:enter="transition ease duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease duration-100 transform"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-90 translate-y-1"
                    class="bg-white rounded-xl shadow-2xl p-6 sm:w-1/6	 mx-10">
                    <div class="mb-3">
                        <svg class="mx-auto h-32 w-32 text-green-400" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <circle cx="12" cy="12" r="9" />
                            <path d="M9 12l2 2l4 -4" /></svg>
                    </div>
                    <p class="text-2xl font-medium text-center mt-11">{{ session('successmsg') }}</p>
                </div>
            </div>
            <!--//Notif. Acta confirmada -->

        </div>

        <h1 class="text-3xl font-bold pt-3 pb-7">Editar Operacion
        @switch($operation->active)
        @case(0)
        <span class="place-items-center bg-blue-500 text-sm font-medium text-white rounded-lg px-2 ">En Revisión
        @break
        @case(1)
        <span class="bg-green-500 text-white rounded-md uppercase px-2">Confirmada
        @break
        @default
        @endswitch
    </span></h1>  



        <div class="grid overflow-hidden grid-lines grid-cols-10 grid-rows-2 gap-px gap-x-0 gap-y-0 grid-flow-col w-auto h-full 
        bg-white py-3 pr-3 mb-2
        rounded border border-gray-400
        shadow-lg">
   
            <div class="box row-start-1 row-end-4 col-span-10 px-4">
                <div class="flex">
                    <div class="item">
                        <div>N° de operación</div>
                        <div>Tipo </div>
                    </div>
                    <div class="item pl-6">
                        <div>: {{$operation->id}}</div>
                        <div>: {{$operation->type->name}}</div>
                    </div>
                </div>
            </div>
            <div class="box row-start-1 row-end-4 flex items-center justify-center px-2">
                @switch($operation->type->id)
                @case(1)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z" /></svg>
                    @break
                @case(2)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
                  </svg>
                    @break
                @case(3)
                @case(4)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                    <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                        @break
                @case(6)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                    <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                  </svg>
                    @break

                @case(7)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                  </svg>
                    @break
                @case(8)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clipboard-x" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                  </svg>
                        @break
                @default
            @endswitch
            </div>
        </div>
        
  


      

        <br />
        
        <!-- Modal -->
        @if ($operation->active == 0)
        <div x-data="{ showModal : false }" class="">
            <!-- Button -->
            <button @click="showModal = !showModal"
                class="
                focus:outline-none flex items-center py-3 px-12
                bg-indigo-400  hover:bg-indigo-500 
                text-sm  font-medium text-center tracking-wider text-white 
                border border-gray-300 hover:border hover:border-indigo-500 rounded">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Aprobar
            </button>
            <!-- Modal Background -->
            <div x-show="showModal"
                class="fixed text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0"
                x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <!-- Modal -->
                <div x-show="showModal" class="bg-white rounded-xl shadow-2xl p-6 sm:w-2/6	 mx-10"
                    @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease duration-100 transform"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                    <!-- Title -->
                    <span class="font-bold block text-2xl mb-3">Aprobar Operación</span>
                    <!-- Some beer 🍺 -->
                    <p>Asegurese que toda la información este correcta antes de aprobar la operación</p>
                    <p>¿Esta seguro que quiere aprobar la operación seleccionada?</p>
                    <!-- Buttons -->
                    <div class="text-right space-x-5 mt-5">
                        <button @click="showModal = !showModal"
                            class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                            Mejor no
                        </button>
                        <button wire:click="confirm({{$operation}})" @click="showModal = !showModal"
                            class="px-4 py-2 text-sm bg-white rounded-xl border transition-colors duration-150 ease-linear border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">
                            👍 Confirmo
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif



        <!--Información de Operación -->
        @if ($operation->id)
        
        <div class="py-2 px-4 mt-2 
        border  rounded-md">
            <h2 class="text-lg font-medium py-2">Información de Operación</h2>
            <form wire:submit.prevent="update" method="POST">
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Fecha de Entrega</label>
                <input wire:model="operation.operation_date" type="datetime"
                class="w-full py-1 px-3 
                placeholder-gray-500 
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" >


                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Fecha de Entrega</label>
                <input wire:model="operation.operation_date" type="datetime"
                class="w-full py-1 px-3 
                placeholder-gray-500 
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" >


                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Solicitante</label>
                <input wire:model="operation.petitioner" placeholder="Ingresar nombre completo"
                class="w-full py-1 px-3 
                placeholder-gray-500 
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md">
                @error('operation.petitioner')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror

                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Supervisor Encargado</label>
                <input
                class="w-full py-1 px-3 
                placeholder-gray-500 
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" type="" placeholder="Ingresar nombre completo" wire:model="operation.supervisor">
                @error('operation.supervisor')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror


                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Responsable de Entrega</label>
                <input
                class="w-full py-1 px-3 
                placeholder-gray-500 
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" type="" placeholder="Ingresar nombre completo" wire:model="operation.deliveredby">
                @error('operation.deliveredby')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror

                <label
                class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide">Observaciones/Comentarios</label>
                <textarea
                class="w-full min-h-[200px] max-h-[300px] h-28 
                placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" placeholder="Puede ingresar comentarios u/o observaciones" wire:model="operation.comment">
                </textarea>
                @error('operation.comment')
                <span class="text-xs text-red-500">{{$message}}</span>
                @enderror
                
                <label class="text-xs tracking-wider uppercase font-bold text-gray-500">Seleccionar Unidad Organizativa</label>
                <select class="w-full placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md" disabled>
                    <option value="">{{$operation->ou->name}}</option>
                    @foreach($allOU as $ou)
                    <option value="{{ $ou->id }}">{{ $ou->name }}</option>
                    @endforeach
                    </select>

                    <div class="flex mr-2 mt-2">
                        <div>

                            <button wire:click="update"
                            class="
                            bg-green-400  hover:bg-green-500 
                            text-sm  text-center tracking-wider font-medium text-white 
                            py-3 px-12 rounded 
                            transition float-right">
                                <i class="far fa-save mr-3"></i>Guardar
                            </button>

                        </div>

                    </div>
            </form>
        </div>

        @endif
    </div>


    <div class="py-2 px-4 mt-2 
    border rounded-md">
        <div class="grid overflow-hidden grid-cols-4 gap-0 gap-x-5 gap-y-0">
            @if ($operation->active == 0)

                <h2 class="text-lg font-medium py-2">Seleccionar dispositivos DPSS</h2>

            <div class="box col-start-1 col-span-2 ">
                <div class="flex bg-white rounded-md">
                    <div
                        class="flex w-full group py-3 rounded-md text-gray-400 transition duration-500 ease-in-out	focus-within:text-gray-900 ">
                        <span class="float-left">
                            <svg class="h-5 w-5 ml-4 mr-3 align-middle" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                        </span>
                        <input wire:keydown="clean_page" wire:model.debounce.500ms="search" placeholder="Buscar"
                            class="relative  appearance-none text-sm border-0 outline-none focus:ring-transparent">
                    </div>
                    <div class="flex ">
                        <span class="text-sm py-3 mr-2 text-right">Mostrar: </span>
                        <select wire:model="paginate" name="paginate" id="paginate"
                            class="text-xs text-white border-0 rounded-md outline-none bg-gray-600 focus:ring-transparent ">
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                    </div>

                </div>







                <!--Opciones-->
                <div class="flex ">

                    @if ($selDvcs)
                    <div
                        class="h-auto py-2.5 px-5 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        Ha seleccionado ({{count($selDvcs)}}) dispositivos
                    </div>
                    <button wire:click="addDevices"
                        class="py-2.5 px-5 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i>Añadir
                    </button>
                    <button wire:click="selectAll"
                        class="py-2.5 px-5 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        Seleccionar todo
                    </button>

                    @else
                    <div
                        class="h-auto py-2.5 px-5 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        🤷 Emm... no hay seleccionado
                    </div>
                    @endif
                </div>
                <!--Opciones-->


                <div class="filter flex">
                    <div x-data="{ showfilter : false }">
                        <!-- Button -->
                        <div class="group text-sm text-gray-400 hover:text-gray-700 ">
                            <button @click="showfilter = !showfilter"
                                class="flex items-center py-2.5 px-5 rounded-md border border-gray-400 group-hover:text-gray-700 group-hover:bg-gray-300 focus:outline-none transition duration-500 ease-in-out">
                                <svg class="h-5 w-5 " width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5" />
                                </svg>
                                Filtrar por rango
                            </button>
                        </div>

                        <!-- Modal Background -->

                        <!-- Modal -->
                        <div x-show="showfilter" x-transition:enter="transition ease duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-90 translate-y-1">

                            <div
                                class="group flex w-auto my-4 py-3 bg-white rounded-md text-gray-400 transition duration-500 ease-in-out	focus-within:text-gray-900">
                                <span>
                                    <svg class="h-5 w-5 ml-4 mr-3  " viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                </span>
                                <input wire:model.lazy="fFrom" wire:keydown="clean_page" type="text" placeholder="Desde"
                                    maxlength="8"
                                    class="appearance-none h-5 text-sm border-0 outline-none focus:ring-transparent">
                                <span>
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </span>
                                <input wire:model.lazy="fTo" wire:keydown="clean_page" type="text" placeholder="Hasta"
                                    maxlength="8"
                                    class="appearance-none h-5 text-sm border-0 outline-none focus:ring-transparent">
                            </div>


                        </div>

                    </div>
                </div>


                <div>
                    <table class="table-fixed text-xs text-gray-600">
                        <tr class="text-left uppercase h-9 bg-gray-300">
                            <th class="w-1/4 pl-3 rounded-l-lg">
                                <input
                                    class="form-checkbox h-5 w-5 pl-3 border-2  border-gray-400 text-black rounded-md checked:bg-blue-600 checked:border-transparent focus:outline-none"
                                    type="checkbox" wire:model="selectPage">
                            </th>
                            <th class="w-1/4">Codigo</th>
                            <th class="w-1/4">Telefono</th>
                            <th class="w-1/4">IMEI</th>
                            <th class="w-1/4 pr-3 rounded-r-lg ">Estado</th>
                        </tr>
                        @foreach($devices as $device)
                        <tr class="focus-within:text-blue-600 hover:bg-blue-400 h-8">
                            <td class="pl-3 rounded-l-lg">
                                <input
                                    class="form-checkbox h-5 w-5 border-2  border-gray-400 text-black rounded-md checked:bg-blue-600 checked:border-transparent focus:outline-none"
                                    type="checkbox" wire:model="selDvcs" value="{{$device->id}}">
                            </td>
                            <td>{{$device->cod}}</td>
                            <td>{{$device->phone_num}}</td>
                            <td>{{$device->imei}}</td>
                            <td class="pr-3 rounded-r-lg">{{$device->status->cod}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="block">{{$devices->links()}}</div>
                </div>


            </div>
            @endif







            <!--Dispositivos en la operación-->

            <div class="box col-start-3 col-span-2">
                <h2 class="text-lg mb-2">Dispositivos en operación<span
                        class="bg-gray-500 text-white text-xs ml-8 px-4 py-1.5 font-bold rounded-full">{{count($operDevices)}}</span>
                </h2>


                <div class="flex">
                    @if ($selOperDvcs)
                    <div
                        class="item w-auto h-auto py-2.5 px-5 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        Haz seleccionado ({{count($selOperDvcs)}}) dispositivos
                    </div>


                    <div
                        class="item w-auto h-auto py-2.5 px-3 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        <!-- Dropdown -->
                        <div class="relative" x-data="{ open: false }">

                            <a class="cursor-pointer" x-on:click="open = !open">
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <!-- Dropdown Body -->
                            <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl" x-show="open"
                                x-on:click.away="open = false">

                                <a class="transition-colors duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-blue-500 hover:text-white"
                                    wire:click="deleteOperDvcs" x-on:click="open = false">
                                    Quitar dispositivos</a>
                            </div>
                            <!-- // Dropdown Body -->
                        </div>
                        <!-- // Dropdown -->
                    </div>
                    @else
                    <div
                        class="item w-auto h-auto py-2.5 px-5 focus:outline-none text-sm rounded-md border text-white bg-blue-500 hover:bg-blue-400 flex items-center">
                        ...
                    </div>
                    @endif
                </div>

                <div class="overflow-y-auto h-auto" style="height: 740px;">
                    <table class="table-fixed text-xs">
                        <tr class="text-left uppercase h-8">
                            <th class="w-1/4"><input type="checkbox" wire:model="selectAllOperDvcs"></th>
                            <th class="w-1/4">Codigo</th>
                            <th class="w-1/4">IMEI</th>
                        </tr>
                        @foreach ($operDevices as $operDevice)
                        <tr class="focus-within:text-blue-600 hover:bg-blue-400 h-8">
                            <td><input
                                    class="form-tick appearance-none h-5 w-5 border-2 border-gray-300 border- rounded-md checked:bg-blue-600 checked:border-transparent focus:outline-none"
                                    type="checkbox" wire:model="selOperDvcs" value="{{$operDevice->id}}"></td>
                            <td>{{$operDevice->device->cod}}</td>
                            <td>{{$operDevice->device->imei}}</td>
                            <td>
                                <button wire:click="" class="text-sm"><i class="fas fa-minus"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>


            </div>



        </div>
    </div>
</div>





</div>
</div>