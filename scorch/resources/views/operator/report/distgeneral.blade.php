<x-app-layout>
    <div class="container my-2 w-full flex flex-row justify-center items-center">
        <button class="
        bg-transparent hover:bg-black 
        font-bold text-xs uppercase text-center tracking-widest text-gray-600 hover:text-white
        py-3 px-12 border border-gray-600 hover:border hover:border-black  rounded 
        transition " onclick="printDiv('printableArea')">
            <div class="float-left mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path
                        d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path
                        d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
            </div>

            Exportar a PDF
        </button>
    </div>

    <div class="container flex-inline bg-white" id="printableArea">
        <div class="item pt-5">
            <h2 class="text-lg font-medium">Resumen de Distribución General</h2>
            @foreach ($operations as $o)
            <div
                class="grid overflow-hidden grid-lines grid-cols-10 grid-rows-2 gap-px gap-x-0 gap-y-0 grid-flow-col w-auto h-full bg-white py-3 pr-3 border-b">
                <div class="box row-start-1 row-end-4 flex items-center justify-center">
                    @switch($o->opeTypeID)
                    @case(1)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z" />
                    </svg>
                    @break
                    @case(2)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    @break
                    @case(3)
                    @case(4)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-x-octagon" viewBox="0 0 16 16">
                        <path
                            d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                    @break
                    @case(6)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                        <path
                            d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                        <path
                            d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                    </svg>
                    @break

                    @case(7)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                    @break
                    @case(8)
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-clipboard-x" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                    @break
                    @default
                    @endswitch

                </div>

                <div class="box row-start-1 row-end-4 col-span-10 text-gray-600">
                    <div class="flex-inline text-xs">
                        <div class="item w-auto">
                            <div class="text-base">{{$o->opeType}} para {{$o->opeOU}}</div>
                            <div class="text-sm font-bold tracking-wide text-purple-400">
                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$o->opeDate)->format('d/m/Y')}}
                            </div>
                            <div class="text-sm font-bold tracking-wide">{{$o->opeDvcsNum}} DPSS</div>
                        </div>
                        <div class="item w-auto h-auto mt-2">
                            <div class="flex">
                                <div class="item">
                                    <div>Solicitante</div>
                                    <div>Supervisor asignado</div>
                                    <div>Gestionado por</div>
                                </div>
                                <div class="item pl-6">
                                    <div>: {{$o->opePetitioner}}</div>
                                    <div>: {{$o->opeSupervisor}}</div>
                                    <div>: {{$o->opeDeliveredby}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="item w-auto h-auto mt-4">
                            <div class="flex-inline">
                                @if ($o->opeComment == null)
                                <div class="item text-xs font-bold uppercase tracking-wide text-gray-400 ">Sin
                                    información adicional</div>
                                @else
                                <div class="item text-xs font-bold uppercase tracking-wide text-gray-600 ">
                                    Comentarios</div>
                                <p class="item text-sm">{{$o->opeComment}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @endforeach
        </div>

        <div class="item mt-5">
            <h2 class="text-lg font-medium">Distribución Logistica</h2>
            <p class="text-sm mb-5">Las siguientes cifras muestran las cifras de distribución de DPSS por unidad organizativa hasta la
                fecha</p>
            <div class="grid overflow-hidden grid-cols-2 grid-rows-none gap-0 gap-x-5 gap-y-0 grid-flow-row w-auto">

                <div class="box row-span-3 px-4 py-3 bg-white rounded-md border border-gray-300">
                    <h2 class="w-full flex text-lg font-medium text-left  text-black mb-2">Antamina</h2>

                    <table class="ml-2 w-full">
                        <thead>
                            <tr class="text-xs font-normal tracking-wide text-gray-800 uppercase">
                                <th>Distribución</th>
                                <th>Entregados</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            @foreach ($allOU as $ou)
                            @if($ou->level == 1)
                            <tr class="text-gray-800 pt-5">
                                @foreach ($totalOU as $item)
                                @if ($ou->id == $item['ouID'])
                                <td>{{$item['ouName']}}</td>
                                <td class="text-center">{{$item['ouQuantity']}}</td>
                                @endif

                                @endforeach
                            </tr>
                            @foreach ($ou->child as $child2)
                            <tr class="text-gray-700">
                                <td class="pl-4">{{$child2->name}}</td>
                                @foreach ($totalOU as $item)
                                @if ($child2->id == $item['ouID'])
                                <td class="text-center">{{$item['ouQuantity']}}</td>
                                @endif
                                @endforeach

                            </tr>
                            @foreach ($child2->child as $child3)
                            <tr class="text-gray-600">
                                <td class="pl-7">{{$child3->name}}</td>
                                @foreach ($totalOU as $item)
                                @if ($child3->id == $item['ouID'])
                                <td class="text-center">{{$item['ouQuantity']}}</td>
                                @endif
                                @endforeach


                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="box row-span-1 col-start-2 bg-white rounded-md px-4 py-3  border border-gray-300">
                    <h2 class="w-full flex text-lg font-medium text-left  text-black mb-2">Socios Estrategicos SSEE
                    </h2>
                    <table class="w-full">
                        <thead>
                            <tr class="text-center text-xs uppercase text-gray-800">
                                <th>Distribución</th>
                                <th>Entregados</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs uppercase">
                            @foreach ($totalOU as $item)
                            @if ($item['ouLvl'] == 0 )
                            <tr>
                                <td>{{$item['ouName']}}</td>
                                <td class="text-center">{{$item['ouQuantity']}}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="box mt-6 bg-white rounded-md px-4 py-3  border border-gray-300">
                    <h2 class="w-full flex text-lg font-medium text-left  text-black mb-2">Brigada COVID</h2>
                    <table class="w-full">
                        <thead>
                            <tr class="text-center text-xs uppercase text-gray-800">
                                <th>Distribución</th>
                                <th>Entregados</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs uppercase">
                            @foreach ($totalOU as $item)
                            @if ($item['ouLvl'] == 4 )
                            <tr>
                                <td>{{$item['ouName']}}</td>
                                <td class="text-center">{{$item['ouQuantity']}}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>