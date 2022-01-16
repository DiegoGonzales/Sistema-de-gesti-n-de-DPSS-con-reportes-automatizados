<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <!--Device Status-->
        <div>
            <h1>Estado de dispositivos</h1>
            <span>Este modulo se encarga de establecer el status dispositivos</span>
        </div>
        <!--Listado de estados-->
        <div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden md:max-w-2xl">


            @foreach ($device_states as $device_status)
            <div>
                <div class="max-w-md py-4 px-8 block bg-white rounded-md">
                    <!--Editar Status-->
                    @if ($selectedStatus->id == $device_status->id)
                    <div>


                        <div class="flex items-center">
                            <label class="w-32">Codigo:</label>
                            <input wire:model="selectedStatus.cod" class="form-input w-full">
                        </div>
                        @error('selectedStatus.cod')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror


                        <div class="flex items-center">
                            <label class="w-32">Descripción:</label>
                            <input wire:model="selectedStatus.description" class="form-input w-full">
                        </div>
                        @error('selectedStatus.description')
                        <span>{{$message}}</span>
                        @enderror


                        <div class="mt-4 justify-end">
                            <button
                                class="bg-white  text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow hover:bg-gray-100"
                                wire:click="cancel">Cancelar</button>
                            <button
                                class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                                wire:click="update">Actualizar</button>
                        </div>
                        <!--Editar Status-->

                    </div>
                    @else
                    <!--Listado de Device_Status-->
                    <span class="text-xs text-gray-400 text-right tracking-wide	">ID.{{$device_status->id}}</span>
                    <h1>{{$device_status->cod}}</h1>
                    <span>{{$device_status->description}}</span>
                    <br>
                    <div class="inline-flex float-right	">
                        <a class="cursor-pointer" wire:click="edit({{$device_status}})"><i class="far fa-edit"></i></a>
                        <!-- modal delete -->
                        <div x-data="{ open: false }">
                            <!-- Button (blue), duh! -->
                            <a class="cursor-pointer" x-on:click="open = true"><i class="far fa-trash-alt"></i></a>
                            <!-- Dialog (full screen) -->
                            <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full"
                                style="background-color: rgba(0,0,0,.5);"
                                x-show.transition.in.duration.400ms.out.duration.50ms="open">
                                <!-- A basic modal dialog with title, body and one button to close -->
                                <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                                    @click.away="open = false">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                            ¿Desea eliminar el siguiente elemento?
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm leading-5 text-gray-500">🤔</p>
                                        </div>
                                    </div>

                                    <!-- Cancelar o Confirmar.  --->
                                    <div class="mt-5 sm:mt-6">
                                        <span class="flex w-full rounded-md shadow-sm">
                                            <button @click="open = false"
                                                class="inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                                Mejor no
                                            </button>
                                            <button @click="open = false" wire:click="destroy({{$device_status}})"
                                                class="inline-flex justify-center w-full px-4 py-2  text-white bg-blue-500 rounded hover:bg-blue-700">
                                                Si, eliminar!
                                            </button>
                                        </span>
                                    </div>
                                    <!-- Cancelar o Confirmar.  --->
                                </div>
                            </div>
                        </div>
                        <!-- modal delete -->



                    </div>

                </div>
                @endif
                @endforeach


            </div>
        </div>
        <!--Listado de estados-->



        <!--Formulario Crear nuevo estado -->
        <div x-data="{open: false}">
            <div class="w-full text-center mx-auto">
                <button x-show.transition.out.duration.50ms="!open" x-on:click="open=true" type="button"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                    Crear nuevo estado
                </button>

                <div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden md:max-w-2xl mt-3"
                    x-show.transition.in.duration.400ms="open">

                    <h1 class="text-xl font-bold">Crear nuevo estado de disp.</h1>

                    <div class="flex items-center">
                        <label class="w-32">Codigo:</label>
                        <input wire:model='cod' class="form-input w-full">
                    </div>
                    @error('cod')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror


                    <div class="flex items-center">
                        <label class="w-32">Descripción:</label>
                        <input wire:model='description' class="form-input w-full">
                    </div>
                    @error('description')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror

                    <div class="mt-4 justify-end">
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            x-on:click="open=false">Cancelar</button>
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            wire:click="store">Crear</button>
                    </div>

                </div>
            </div>
        </div>
        <!--Formulario Crear nuevo estado -->
    </div>
    <!--Device Status-->

    <!--Device Model-->
    <div>
        <h1>Modelos de dispositivos</h1>
        <span>Este modulo se encarga de modelos dispositivos</span>

        <!--Listado de estados-->
        <div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden md:max-w-2xl">
            @foreach ($device_models as $device_model)

            <div>
                <div class="max-w-md py-4 px-8 block bg-white rounded-md">
                    <!--Editar Modelo-->
                    @if ($selectedModel->id==$device_model->id)
                    <div class="flex items-center">
                        <label class="w-32">Marca</label>
                        <input wire:model='selectedModel.brand' class="form-input w-full">
                    </div>
                    @error('selectedModel.brand')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror
                    <div class="flex items-center">
                        <label class="w-32">Modelo:</label>
                        <input wire:model='selectedModel.model' class="form-input w-full">
                    </div>
                    @error('selectedModel.model')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror

                    <div class="mt-4 justify-end">
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            wire:click="cancel">Cancelar</button>
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            wire:click="updateModel">Actualizar</button>
                    </div>
                    @else
                    <span class="text-xs text-gray-400 text-right tracking-wide	">ID.{{$device_model->id}}</span>
                    <h1>{{$device_model->model}}</h1>
                    <span>{{$device_model->brand}}</span>

                    <div class="inline-flex">
                        <a class="cursor-pointer" wire:click="editModel({{$device_model}})"><i class="far fa-edit"></i></a>
                        <!-- modal delete -->
                        <div x-data="{ open: false }">
                            <!-- Button (blue), duh! -->
                            <a class="cursor-pointer" x-on:click="open = true"><i class="far fa-trash-alt"></i></a>
                            <!-- Dialog (full screen) -->
                            <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full"
                                style="background-color: rgba(0,0,0,.5);"
                                x-show.transition.in.duration.400ms.out.duration.50ms="open">
                                <!-- A basic modal dialog with title, body and one button to close -->
                                <div class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                                    @click.away="open = false">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                                            ¿Desea eliminar el siguiente elemento?
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm leading-5 text-gray-500">🤔</p>
                                        </div>
                                    </div>

                                    <!-- Cancelar o Confirmar.  --->
                                    <div class="mt-5 sm:mt-6">
                                        <span class="flex w-full rounded-md shadow-sm">
                                            <button @click="open = false"
                                                class="inline-flex justify-center w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
                                                Mejor no
                                            </button>
                                            <button @click="open = false" wire:click="destroyModel({{$device_model}})"
                                                class="inline-flex justify-center w-full px-4 py-2  text-white bg-blue-500 rounded hover:bg-blue-700">
                                                Si, eliminar!
                                            </button>
                                        </span>
                                    </div>
                                    <!-- Cancelar o Confirmar.  --->
                                </div>
                            </div>
                        </div>
                        <!-- modal delete -->
                    </div>
                    @endif
                    <!--Listado de Device_Model-->


                </div>
            </div>
            @endforeach
        </div>
        <!--Listado de estados-->
        <!--Formulario Crear nuevo estado -->
        <div x-data="{open: false}">
            <div class="w-full text-center mx-auto">
                <button x-show.transition.out.duration.50ms="!open" x-on:click="open=true" type="button"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                    Registrar nuevo modelo
                </button>
                {{$newModel}}
                <div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden md:max-w-2xl mt-3"
                    x-show.transition.in.duration.400ms="open">

                    <h1 class="text-xl font-bold">Crear nuevo estado de disp.</h1>

                    <div class="flex items-center">
                        <label class="w-32">Marca</label>
                        <input wire:model='deviceBrand' class="form-input w-full">
                    </div>
                    @error('deviceBrand')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror
                    <div class="flex items-center">
                        <label class="w-32">Modelo:</label>
                        <input wire:model='deviceModel' class="form-input w-full">
                    </div>
                    @error('deviceModel')
                    <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror

                    <div class="mt-4 justify-end">
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            x-on:click="open=false">Cancelar</button>
                        <button
                            class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                            wire:click="store_newModel">Crear</button>
                    </div>

                </div>
            </div>
        </div>
        <!--Formulario Crear nuevo estado -->

    </div>

    <!--Device Model-->

</div>