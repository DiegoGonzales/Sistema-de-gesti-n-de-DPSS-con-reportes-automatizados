<div>
    <div>

        <h1>Distribución Total</h1>

        <div class="flex flex-col bg-white m-auto p-auto">
            <h1 class="text-2xl font-light px-10 py-5">Dispositivos según estado:</h1>
            <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
                <div class="flex flex-nowrap ml-10 ">
                    @foreach ($qxStatuses as $qxStatus)
                    <div class="inline-block">
                        <div
                            class=" px-6 py-6 bg-white w-96 h-33 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <h3 class="py-2 text-4xl font-bold font-mono">{{$qxStatus->total}}</h3>
                            <p class="text-xs">Dispositivos</p>
                            <div class="text-center mt-2 leading-none flex justify-between w-full">
                                <span class="inline-flex items-center leading-none text-sm">
                                    {{$qxStatus->description}}
                                </span>
                                <span class="inline-flex items-center leading-none text-sm">
                                    {{$qxStatus->cod}}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="inline-block">
                        <div
                            class=" px-6 py-6 bg-white w-96 h-33 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <h3 class="py-2 text-4xl font-bold font-mono">Graph</h3>
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <hr>
        <h2>Detalle</h2>
        @foreach ($total as $item)
        {{$item->operationID}}
        {{$item->operationType}}
        {{$item->ouName}}
        {{$item->operationPetitioner}}
        {{$item->deviceId}}
        {{$item->deviceCod}}
        {{$item->devicePhone}}
        {{$item->deviceImei}}
        {{$item->deviceStatusID}}
        {{$item->deviceStatus}}
        {{$item->deviceStatusDesc}}
        <br>
        @endforeach

        <h2>Detalle de dispositivos por OU</h2>
        <table class="table-fixed bg-white">
            <thead>
              <tr>
                <th class="w-1/6 py-6 border">Unidad Organizativa</th>
                <th class="w-1/6 py-6 border">Entregados</th>
                <th class="w-1/6 py-6 border">Baja por Perdida</th>
                <th class="w-1/6 py-6 border">Baja por daño</th>
                <th class="w-1/6 py-6 border">Salida a garantía</th>
              </tr> border
            </thead>
            <tbody>
            @foreach ($dvcsXou as $dvcXou)
            <tr class="text-center">
                <td class="w-1/6 py-4 border-b divide-y divide-light-blue-400 md:hover:bg-gray-300">{{$dvcXou->ouName}}</td>
                <td class="w-1/6 py-4 border-b divide-y divide-light-blue-400 md:hover:bg-gray-300">{{$dvcXou->ouENT}}</td>
                <td class="w-1/6 py-4 border-b divide-y divide-light-blue-400 md:hover:bg-gray-300">{{$dvcXou->ouBPR}}</td>
                <td class="w-1/6 py-4 border-b divide-y divide-light-blue-400 md:hover:bg-gray-300">{{$dvcXou->ouBDP}}</td>
                <td class="w-1/6 py-4 border-b divide-y divide-light-blue-400 md:hover:bg-gray-300">{{$dvcXou->ouSAG}}</td>
            </tr>
            @endforeach
              
            </tbody>
          </table>
        
    </div>


    <script>
        //var qxstatuses = @json($qxStatuses);
        const qxstatuses = JSON.parse('{!! json_encode($qxStatuses) !!}');
        //console.log(qxstatuses);

        var labels = qxstatuses.map(qxstatuses => qxstatuses.description).flat();
        var quantities = qxstatuses.map(qxstatuses => qxstatuses.total).flat();
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'My First Dataset',
                    data: quantities,
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
               
                }
            }
        });
           

        




           /*var labelz = qxstatuses.cod;
        console.log(labelz);
        
        const car = {type:"Fiat", model:"500", color:"white"};
        document.write(car.type);*/
    </script>

</div>