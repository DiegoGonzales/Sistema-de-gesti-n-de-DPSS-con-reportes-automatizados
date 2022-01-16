<div>
    <div class="container mx-auto bg-gray-50 mt-5 py-5 rounded">
        <h2 class="text-3xl font-bold pt-3 pb-7">Dispositivos DPSS</h2>
        <div>
            <div class="max-w-7x1 mx-auto space-x-2 flex">
               <div class="item py-2 mr-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="fill-current text-gray-400 " viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                  </svg>
               </div>
                <!-- Dropdown -->
                <div class="item relative" x-data="{ open: false }">
                    <button
                        class="px-4 py-2 block
                        font-bold text-xs uppercase text-center tracking-widest text-gray-400 hover:text-indigo-500
                        border border-gray-300 hover:border hover:border-indigo-500  rounded
                        overflow-hidden focus:outline-none"
                        x-on:click="open = !open">
                        Modelo <i class="fas fa-angle-down ml-2"></i>
                    </button>
                    <!-- Dropdown Body -->
                    <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl text-sm" x-show="open"
                        x-on:click.away="open = false">
                        @foreach ($dvcs_model as $dev_model)
                        <a href=""
                            class="
                            block px-4 
                            text-normal text-gray-900 hover:text-white 
                            rounded bg-transparent hover:bg-indigo-500 
                            transition-colors duration-100"
                            wire:click="$set('model_id', {{$dev_model->id}})" x-on:click="open = false">
                            {{$dev_model->model}}</a>

                            @endforeach


                    </div>
                    <!-- // Dropdown Body -->
                </div>
                <!-- // Dropdown -->

                <div class="item relative" x-data="{ open: false }">
                    <button
                        class="px-4 py-2 block 
                        font-bold text-xs uppercase text-center tracking-widest text-gray-400 hover:text-indigo-500
                        border border-gray-300 hover:border hover:border-indigo-500 rounded
                        bg-transparent 
                        overflow-hidden focus:outline-none"
                        x-on:click="open = !open">
                        Estado<i class="fas fa-angle-down ml-2"></i>
                    </button>
                    <!-- Dropdown Body -->
                    <div class="absolute right-0 w-52 mt-2 py-2 bg-white border rounded shadow-xl" x-show="open"
                        x-on:click.away="open = false">
                        @foreach ($dvcs_status as $dev_status)
                        <a 
                        class="block px-4 
                            text-normal text-gray-900 hover:text-white 
                            rounded bg-transparent hover:bg-indigo-500 
                            transition-colors duration-100"
                            wire:click="$set('status_id', {{$dev_status->id}})" x-on:click="open = false">
                            {{$dev_status->description}}</a>
                        @endforeach

                    </div>
                    <!-- // Dropdown Body -->
                </div>
                <!-- // Dropdown -->

                <div class="item">
                    <button 
                    class="px-4 py-2 block 
                    font-bold text-xs uppercase text-center tracking-widest text-gray-400 hover:text-indigo-500
                    border border-gray-300 hover:border hover:border-indigo-500 rounded
                    bg-transparent 
                    overflow-hidden focus:outline-none"
                        wire:click="resetFilters">
                        <div class="float-left pr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/></svg>
                        </div>
                        
                        Reiniciar filtros
                    </button>
    
                   </div>
            </div>
        </div>


        <!--Devices LISTADO-->
        <div>
            <!-- component -->
            <div>
                <table class="table rounded border-collapse w-full text-sm bg-white shadow mt-6">
                    <thead class="text-xs uppercase text-left text-indigo-300">
                        <tr>
                            <th class="py-3 px-6 w-1/6">ID</th>
                            <th class="py-3 px-6 w-1/6">Codigo</th>
                            <th class="py-3 px-6 w-1/6">Telf</th>
                            <th class="py-3 px-6 w-1/6">IMEI</th>
                            <th class="py-3 px-6 w-1/6">Estado</th>
                            <th class="py-3 px-6 w-1/6 text-transparent">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $device)
                        
                        <tr class="border-t border-gray-100 hover:bg-indigo-50">
                            <td class="py-3 px-6 whitespace-nowrap text-center">
                                <div class="flex items-center">
                                    <span>{{$device->id}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center">
                                    <span>{{$device->cod}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center">
                                    <span>{{$device->phone_num}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center">
                                    <span>{{$device->imei}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-white">
                                @switch($device->status_id)
                                    @case(1)
                                            <span class="bg-green-400 py-1 px-3 rounded-full text-xs">{{$device->status->description}}</span>
                                        @break
                                    @case(2)
                                            <span class="bg-blue-400 py-1 px-3 rounded-full text-xs">Entregado</span>
                                        @break
                                    @case(3)
                                            <span class="bg-gray-500 py-1 px-3 rounded-full text-xs">{{$device->status->description}}</span>
                                        @break
                                    @case(4)
                                            <span class="bg-red-600 py-1 px-3 rounded-full text-xs">{{$device->status->description}}</span>
                                    @break
                                    @case(5)
                                            <span class="bg-yellow-300 py-1 px-3 rounded-full text-xs">{{$device->status->description}}</span>
                                    @break
                                    @case(6)
                                            <span class="bg-indigo-600 py-1 px-3 rounded-full text-xs">{{$device->status->description}}</span>
                                    @break
                                    @case(7)
                                            <span class="bg-black py-1 px-3 rounded-full text-xs">{{$device->status->description}}</span>
                                    @break
                                    @default
                                        
                                @endswitch
                                
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a href="{{route('operator.devices.show', $device)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="max-w-7xl my-5 mx-auto px-4 sm:px-6 lg:px-8">{{$devices->links()}}</div>

        </div>
        <!--Devices LISTADO-->
    </div>
</div>