<div>
    <div class="container bg-gray-50 mt-5 py-5 rounded">
        <h2 class="text-3xl font-bold pt-3 pb-7">Generador de Reportes</h2>

        @if ($currentPage === 1)

        @foreach ($reportTypes as $type)
        <div class="flex-inline space-y-3 w-full ">
            <div class="item">
                <a class="block pl-3 py-3
                            border-transparent border-2 rounded hover:border-indigo-500
                            text-gray-400 font-normal hover:text-black hover:font-medium
                            hover:bg-white
                            shadow-md cursor-pointer  
                            transition duration-400 ease-in-out" wire:click="nextPage({{$type['id']}})">
                    {{$type['name']}}
                </a>
            </div>
            @endforeach
        </div>

        @elseif($currentPage === 2)
        @switch($selectedReportType)
        @case(1)
        <form method="GET" action="{{ route('operator.report.generated')}}" class="py-2">
            @csrf
            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="initial_date">Fecha
                    desde</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="initial_date" type="date" name="initial_date">
                </div>
            </div>

            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="final_date">Fecha
                    hasta</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="final_date" type="date" name="final_date">
                </div>
            </div>
            <!--Controles-->
            <div class="flex space-x-4 ">

                @if ($currentPage === 2)
                <button wire:click="backPage" type="button" class="
                bg-transparent hover:bg-black
                text-sm text-center tracking-wider text-gray-400 hover:text-white
                py-3 px-12 border border-gray-300 hover:border hover:border-black  rounded 
                transition items-center flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                    <span class="pl-2">Regresar</span>
                </button>
                @endif
                <button type="submit" class="
            bg-indigo-400  hover:bg-indigo-500 
            text-sm  font-medium text-center tracking-wider text-white 
            py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
            transition">
                    Generar reporte
                </button>
            </div>

            <!--Controles-->

        </form>
        @break









        @case(2)
        <form method="GET" action="{{ route('operator.report.avlbltybyou')}}">
            @csrf
            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="final_date">Seleccionar
                    Unidad Organizativa</label>
                <br>
                <select name="ou_id" class="placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md">
                    <option value="">Sin seleccionar...</option>
                    @foreach($allOU as $ou)
                    <option value="{{ $ou->id }}">{{ $ou->name }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide"
                    for="initial_date">Seleccionar fecha desde</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="initial_date" type="date" name="initial_date">
                </div>
            </div>

            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="final_date">Seleccionar
                    fecha hasta</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="final_date" type="date" name="final_date">
                </div>
            </div>


            <div class="flex space-x-4 ">

                @if ($currentPage === 2)
                <button wire:click="backPage" type="button" class="
                bg-transparent hover:bg-black
                text-sm text-center tracking-wider text-gray-400 hover:text-white
                py-3 px-12 border border-gray-300 hover:border hover:border-black  rounded 
                transition items-center flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                    <span class="pl-2">Regresar</span>
                </button>
                @endif

                <button type="submit" class="
                bg-indigo-400  hover:bg-indigo-500 
                text-sm  font-medium text-center tracking-wider text-white 
                py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
                transition">
                    Generar reporte
                </button>
            </div>


        </form>
        @break







        @case(3)

        <form method="GET" action="{{ route('operator.report.distgeneral')}}" class="py-2">
            @csrf
            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="initial_date">Fecha
                    desde</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="initial_date" type="date" name="initial_date">
                </div>
            </div>

            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="final_date">Fecha
                    hasta</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="final_date" type="date" name="final_date">
                </div>
            </div>
            <div class="flex space-x-4 ">

                @if ($currentPage === 2)
                <button wire:click="backPage" type="button" class="
                bg-transparent hover:bg-black
                text-sm text-center tracking-wider text-gray-400 hover:text-white
                py-3 px-12 border border-gray-300 hover:border hover:border-black  rounded 
                transition items-center flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                    <span class="pl-2">Regresar</span>
                </button>
                @endif
                <button type="submit" class="
            bg-indigo-400  hover:bg-indigo-500 
            text-sm  font-medium text-center tracking-wider text-white 
            py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
            transition">
                    Generar reporte
                </button>
            </div>
        </form>
        @break






        @case(4)
        <form method="GET" action="{{ route('operator.report.distbyou')}}">
            @csrf
            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="final_date">Seleccionar
                    Unidad Organizativa</label>
                <br>
                <select name="ou_id" class="placeholder-gray-500 focus:placeholder-white
                bg-indigo-50 focus:bg-white focus:outline-none
                border border-transparent rounded focus:border-indigo-500  
                focus:shadow-md">
                    <option value="">Sin seleccionar...</option>
                    @foreach($allOU as $ou)
                    <option value="{{ $ou->id }}">{{ $ou->name }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide"
                    for="initial_date">Seleccionar fecha desde</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="initial_date" type="date" name="initial_date">
                </div>
            </div>

            <div>
                <label class="py-2 text-xs uppercase font-bold text-gray-500 tracking-wide" for="final_date">Seleccionar
                    fecha hasta</label>
                <div>
                    <input class="py-1 px-3 
                    placeholder-gray-500 
                    bg-indigo-50 focus:bg-white focus:outline-none
                    border border-transparent rounded focus:border-indigo-500  
                    focus:shadow-md" id="final_date" type="date" name="final_date">
                </div>
            </div>

            <!--Controles-->
            <div class="flex space-x-4 ">

                @if ($currentPage === 2)
                <button wire:click="backPage" type="button" class="
                bg-transparent hover:bg-black
                text-sm text-center tracking-wider text-gray-400 hover:text-white
                py-3 px-12 border border-gray-300 hover:border hover:border-black  rounded 
                transition items-center flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                    <span class="pl-2">Regresar</span>
                </button>
                @endif
                <!--Controles-->

                <button type="submit" class="
            bg-indigo-400  hover:bg-indigo-500 
            text-sm  font-medium text-center tracking-wider text-white 
            py-3 px-12 border border-gray-300 hover:border hover:border-indigo-500  rounded 
            transition">
                    Generar reporte
                </button>
            </div>


        </form>
        @break
        @default

        @endswitch






    </div>



</div>


@endif

