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

    <div class="container mx-auto bg-white mt-3" id="printableArea">



        <div class="py-5 px-2 border-b border-dashed">
            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">ID de operación</span>
                <h1 class="text-lg">{{$operation->id}}</h1>
            </div>
            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Tipo de operación</span>
                <h1 class="text-lg">{{$operation->type->description}}</h1>
            </div>
            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Fecha de Creación</span>
                <h1 class="text-lg">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$operation->operation_date)->format('d/m/Y')}}</h1>
            </div>

            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Unidad Organizativa</span>
                <h1 class="text-lg">{{$operation->ou->name}}</h1>
            </div>
            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Solicitante</span>
                <h1 class="text-lg">{{$operation->petitioner}}</h1>
            </div>
            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Supervisor Encargado</span>
                <h1 class="text-lg">{{$operation->supervisor}}</h1>
            </div>

            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Responsable de Entrega</span>
                <h1 class="text-lg">{{$operation->deliveredby}}</h1>
            </div>


            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Comentarios/Observaciones</span>
                <h1 class="text-lg">{{$operation->comment}}</h1>
            </div>



            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">Estado de Acta</span>
                @switch($operation->active)
                @case(0)
                <p class="text-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-stopwatch" viewBox="0 0 16 16">
                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z" />
                        <path
                            d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z" />
                    </svg> Pendiente</p>
                @break
                @case(1)
                <p class="text-lg"><i class="far fa-check-circle"></i> Confirmada</p>
                @break
                @case(2)
                <p class="text-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                    </svg></i> Anulada</p>
                @break
                @default
                @endswitch
            </div>

            <div class="mb-2">
                <span class="text-xs tracking-wider uppercase font-bold text-gray-500">N° de Dispostivos</span>
                <h1 class="text-lg">{{$operDevices->count()}}</h1>
            </div>
        </div>



        <div class="py-5 px-2 w-7/8">
            <h2 class="text-lg mb-2">Dispositivos Registrados</h2>
            <table class="table border-collapse w-full text-sm bg-white mt-6">
                <thead class="text-xs uppercase text-gray-500 text-left border-b border-gray-200">
                    <tr>
                        <th>Codigo de DPSS</th>
                        <th>Num. Telefonico</th>
                        <th>IMEI</th>
                        <th>Marca / Modelo</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach ($operDevices as $operDevice)
                    <tr>
                        <td>{{$operDevice->device->cod}}</td>
                        <td>{{$operDevice->device->phone_num}}</td>
                        <td>{{$operDevice->device->imei}}</td>
                        <td>{{$operDevice->device->model->brand}} {{$operDevice->device->model->model}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

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