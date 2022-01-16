<x-app-layout>
    <div class="container bg-white flex-inline mt-5 py-5 rounded">
        
        <div class="item py-12 mb-12 rounded border border-gray-400">
            <div class="container grid overflow-hidden grid-cols-3 grid-rows-none gap-px gap-x-6 gap-y-0 grid-flow-col w-auto h-full">
                <div class="box col-start-1 col-end-1">
                    <figure>
                        <svg class="svg-icon h-60 w-full" viewBox="0 0 20 20">
                            <path
                                d="M13.372,1.781H6.628c-0.696,0-1.265,0.569-1.265,1.265v13.91c0,0.695,0.569,1.265,1.265,1.265h6.744c0.695,0,1.265-0.569,1.265-1.265V3.045C14.637,2.35,14.067,1.781,13.372,1.781 M13.794,16.955c0,0.228-0.194,0.421-0.422,0.421H6.628c-0.228,0-0.421-0.193-0.421-0.421v-0.843h7.587V16.955z M13.794,15.269H6.207V4.731h7.587V15.269z M13.794,3.888H6.207V3.045c0-0.228,0.194-0.421,0.421-0.421h6.744c0.228,0,0.422,0.194,0.422,0.421V3.888z">
                            </path>
                        </svg>
                    </figure>
                </div>

                <div class="box col-start-2 col-end-4 text-sm">
                    <div class="flex-inline space-y-3 ">
                        <div class="item">
                            <span class="text-xs uppercase tracking-widest">Estado Actual</span>
                            <br>
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
                        </div>
                        <div class="item">
                            <div class="text-xs uppercase tracking-widest">Codigo</div>
                            <div class="text-sm font-medium">{{$device->cod}}</div>
                        </div>

                        <div class="item">
                            <div class="text-xs uppercase tracking-widest">Marca y Modelo</div>
                            <div class="text-sm font-medium">{{$device->model->brand}} {{$device->model->model}}</div>
                        </div>

                        <div class="item">
                            <div class="text-xs uppercase tracking-widest">Número Telefonico</div>
                            <div class="text-sm font-medium">{{$device->phone_num}}</div>
                        </div>

                        <div class="item">
                            <div class="text-xs uppercase tracking-widest">IMEI</div>
                            <div class="text-sm font-medium">{{$device->imei}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="item flex-inline px-6 py-3 rounded border border-gray-400"><!-- linea de tiempo TRAZABILIDAD -->
 
                <div class="item text-lg font-medium">Trazabilidad</div>
                
                <div class="item relative w-full">
 
                        @foreach ($history as $item)
                            <div class="flex-inline items-center mb-1 text-sm">
   
                                <div class="item">
                                    <div class="grid overflow-hidden grid-lines grid-cols-10 grid-rows-2 gap-px gap-x-0 gap-y-0 grid-flow-col w-auto h-full bg-white py-3 pr-3 border-b">
                                    @switch($item->opeTypeID)
                                    @case(1)
                                    
                                        <div class="box row-start-1 row-end-4 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z" />
                                        </svg>
                                        </div>
                                        <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                                            <div class="text-xs">{{$item->opeType}}</div>
                                            <div class="text-xs font-bold tracking-wide text-purple-400">
                                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->opeDate)->format('d/m/Y')}}
                                            </div>
                                            <div>Entregado a {{$item->ouName}} por {{$item->opeDeliveredby}}</div>
                                            <div>{{$item->opeComment}}</div>
                                        </div>
                                   
                                  
                                    @break
                                    @case(2)
                                        <div class="box row-start-1 row-end-4 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                        </div>
                                        <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                                            <div class="text-xs">{{$item->opeType}}</div>
                                            <div class="text-xs font-bold tracking-wide text-purple-400">
                                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->opeDate)->format('d/m/Y')}}
                                            </div>
                                            <div>Devuelto por {{$item->ouName}} registrado por {{$item->opeDeliveredby}}</div>
                                            <div>{{$item->opeComment}}</div>
                                        </div>
                                    @break
                                    @case(3)
                                    @case(4)
                                        <div class="box row-start-1 row-end-4 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                                class="bi bi-x-octagon" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </div>
                                        <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                                            <div class="text-xs">{{$item->opeType}}</div>
                                            <div class="text-xs font-bold tracking-wide text-purple-400">
                                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->opeDate)->format('d/m/Y')}}
                                            </div>
                                            <div>Incidente reportado por {{$item->ouName}} registrado por {{$item->opeDeliveredby}}</div>
                                            <div>{{$item->opeComment}}</div>
                                        </div>
                                    @break

                                    @case(6)
                                        <div class="box row-start-1 row-end-4 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                                class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                                                <path
                                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                            </svg>
                                        </div>
                                        <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                                            <div class="text-xs">{{$item->opeType}}</div>
                                            <div class="text-xs font-bold tracking-wide text-purple-400">
                                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->opeDate)->format('d/m/Y')}}
                                            </div>
                                            Comunicado por {{$item->opeSupervisor}} y enviado a garantía por
                                            {{$item->opeDeliveredby}} debido a {{$item->opeComment}}
                                        </div>
                                    
                                    @break
                                    @case(7)
                                    <div class="box row-start-1 row-end-4 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                            <path
                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                            <path
                                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                        </svg>
                                    </div>
                                    <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                                        <div class="text-xs">{{$item->opeType}}</div>
                                        <div class="text-xs font-bold tracking-wide text-purple-400">
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->opeDate)->format('d/m/Y')}}
                                        </div>
                                        <div class="text-sm ">Razón {{$item->opeComment}}</div>
                                    @break
                                    @case(8)
                                    <div class="box row-start-1 row-end-4 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-clipboard-x" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z" />
                                            <path
                                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                            <path
                                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                        </svg>
                                    </div>
                                    <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                                        <div class="text-xs">{{$item->opeType}}</div>
                                        <div class="text-xs font-bold tracking-wide text-purple-400">
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->opeDate)->format('d/m/Y')}}
                                        </div>
                                        <div class="text-sm ">Razón {{$item->opeComment}}</div>
                                    @break
                                    @endswitch
                                    </div>
                                </div>                            
                            </div>


                        @endforeach
                </div>
               

        </div><!-- linea de tiempo TRAZABILIDAD -->
        
    </div>
</x-app-layout>