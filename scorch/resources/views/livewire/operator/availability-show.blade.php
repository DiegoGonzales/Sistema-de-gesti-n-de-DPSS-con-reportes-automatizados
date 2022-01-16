<div>
    <div class="container">

        <div class="w-full">
            <div class="p-2 font-sans text-xl font-medium text-black">Monitoreo de Disponibilidad de DPSS</div>
        </div>

        <div>
            <div class="grid overflow-hidden grid-cols-6 grid-rows-none gap-0 gap-x-5 gap-y-0 grid-flow-row ">
                <div class="box rounded-md row-start-1 row-span-3 col-start-1 col-span-2 bg-white px-4">
                    <div>
                        <h2 class="text-xl font-medium text-left text-black mt-2">Resumen Logistico</h2>
                        <div class="text-xs text-right tracking-wider text-gray-300">*Por estado de dispositivo</div>
                    </div>

                    <div>
                        <table class="w-full">
                            <tbody class="text-sm text-gray-400 ">
                                <tr class="">
                                    <td class="border-solid py-2 pl-1 border-b">Total DPSS asignados al proyecto</td>
                                    <td class="border-solid py-2 px-1 border-b text-right text-black">
                                        {{$totalAsignados}}
                                    </td>
                                </tr>
                                @foreach ($qxStatus as $item)
                                <tr class="">
                                    <td class="border-solid py-2 pl-1 border-b">{{$item->description}}</td>
                                    <td class="border-solid py-2 px-1 border-b text-right text-black">{{$item->count}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class=" mt-3 justify-center items-center">
                        <canvas id="myChart" class="justify-center items-center"></canvas>
                    </div>



                </div>




                <div class="box col-start-3 col-end-7 ">

                    <div class="w-full pb-2">
                        <div class="text-xl font-medium text-left text-black">Resumen Corte Actual AntaSalud/ Sophos
                        </div>
                        <div class="tracking-wide text-gray-400">
                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->date)->format('d/m/Y')}},
                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->date)->format('h:i a')}}</div>
                    </div>

                    <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">
                        @foreach ($weekRecords as $item)
                        @if ($item['id'] == $record->id)
                        <div class="w-full lg:w-1/4">
                            <div
                                class="widget w-full p-4 rounded-md bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                <div class="flex flex-row items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-xs uppercase font-medium tracking-wide text-gray-500">
                                            Activos
                                        </div>
                                        <div class="text-xl font-bold">
                                            {{$item['connected']}}
                                        </div>
                                    </div>


                                    <svg class="stroke-current text-gray-500" fill="none" height="24"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                                        </path>
                                        <circle cx="9" cy="7" r="4">
                                        </circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87">
                                        </path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/4">
                            <div
                                class="widget w-full p-4 rounded-md bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                <div class="flex flex-row items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-xs uppercase font-medium tracking-wide text-gray-500">
                                            No Activos
                                        </div>
                                        <div class="text-xl font-bold">
                                            {{$record->inactives}}
                                        </div>
                                    </div>
                                    <svg class="stroke-current text-gray-500" fill="none" height="24"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12">
                                        </polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/4">
                            <div
                                class="widget w-full p-4 rounded-md bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                <div class="flex flex-row items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-xs uppercase font-medium tracking-wide text-gray-500">
                                            Apagados
                                        </div>
                                        <div class="text-xl font-bold">
                                            {{$item['disconnected']}}
                                        </div>
                                    </div>
                                    <svg class="stroke-current text-gray-500" fill="none" height="24"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6">
                                        </path>
                                        <polyline points="15 3 21 3 21 9">
                                        </polyline>
                                        <line x1="10" x2="21" y1="14" y2="3">
                                        </line>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/4">
                            <div
                                class="widget w-full p-4 rounded-md bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                <div class="flex flex-row items-center justify-between">
                                    <div class="flex flex-col">
                                        <div class="text-xs uppercase font-medium tracking-wide text-gray-500">
                                            Autoevaluaciones
                                        </div>
                                        <div class="text-xl font-bold">
                                            {{$record->assessments}}<span class="text-sm">/{{$item['connected']}}</span>
                                        </div>
                                    </div>

                                    <svg class="stroke-current text-gray-500" fill="none" height="24"
                                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" viewBox="0 0 24 24" width="24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="10">
                                        </circle>
                                        <polyline points="12 6 12 12 16 14">
                                        </polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>







                    
                    <div class="w-full flex px-4 py-3 text-lg font-medium text-left  text-black rounded-t-md bg-white">Resumen Semanal</div>
                    <div class="flex w-full text-sm px-4 bg-white ">
                        
                        <div class="item w-32 text-gray-400">
                            <div class="text-transparent">Fecha</div>
                            <div class="text-transparent">Hora</div>
                            <div class="border-b border-t h-34 py-1">Distribuidos</div>
                            <div class="border-b h-34 py-1">Activos</div>
                            <div class="border-b h-34 py-1">No Activos</div>
                            <div class="border-b h-34 py-1">Disponibilidad</div>
                            <div class="border-b h-34 py-1">Antamina</div>
                            <div class="border-b h-34 py-1">SSEE</div>
                        </div>
                        @foreach ($weekRecords as $weekDay)
                        <div class="item w-32 text-center" style="width: 10ch">
                            <h6 class="h-34 text-gray-400">
                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $weekDay['date'])->format('d/m/Y h:i a')}}
                            </h6>
                            <h6 class="border-b border-t h-34 py-1">{{$weekDay['distributed']}}</h6>
                            <h6 class="border-b h-34 py-1 ">{{$weekDay['connected']}}</h6>
                            <h6 class="border-b h-34 py-1 ">{{$weekDay['disconnected']}}</h6>
                            <h6 class="border-b h-34 py-1 font-medium">{{$weekDay['percentage']}}&#37;</h6>
                            <h6 class="border-b h-34 py-1 font-medium">{{$weekDay['antamina']}}</h6>
                            <h6 class="border-b h-34 py-1 font-medium">{{$weekDay['ssee']}}</h6>
                        </div>
                        @endforeach

                    </div>

                    <div class="w-full bg-white px-2 py-4 rounded-b-md">
                        <canvas id="weekConns" width="400" height="100"></canvas>
                    </div>

                </div>




            </div>

        </div>






        <!--Detalle distribución logistica por Antamina y SSEE-->
        <h3 class="mt-4 mb-2 text-2xl font-bold">Detalle de Activos/Entregados</h3>
        <div class="grid overflow-hidden grid-cols-2 grid-rows-none gap-0 gap-x-5 gap-y-0 grid-flow-row w-auto">

            <div class="box row-span-3 px-4 py-3 bg-white rounded-md">
                <h2 class="w-full flex text-lg font-medium text-left  text-black mb-2">Antamina</h2>

                <table class="ml-2 w-full">
                    <thead>
                        <tr class="text-xs font-normal tracking-wide text-gray-800 uppercase">
                            <th>Distribución</th>
                            <th>Entregados</th>
                            <th>%</th>
                            <th>Activos</th>
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
                            <td class="text-center">{{$item['ouPercentage']}}&#37;</td>
                            <td class="text-center">{{$item['ouConnections']}}</td>
                            @endif

                            @endforeach
                        </tr>
                        @foreach ($ou->child as $child2)
                        <tr class="text-gray-700">
                            <td class="pl-4">{{$child2->name}}</td>
                            @foreach ($totalOU as $item)
                            @if ($child2->id == $item['ouID'])
                            <td class="text-center">{{$item['ouQuantity']}}</td>
                            <td class="text-center">{{$item['ouPercentage']}}&#37;</td>
                            <td class="text-center">{{$item['ouConnections']}}</td>
                            @endif
                            @endforeach

                        </tr>
                        @foreach ($child2->child as $child3)
                        <tr class="text-gray-600">
                            <td class="pl-7">{{$child3->name}}</td>
                            @foreach ($totalOU as $item)
                            @if ($child3->id == $item['ouID'])
                            <td class="text-center">{{$item['ouQuantity']}}</td>
                            <td class="text-center">{{$item['ouPercentage']}}&#37;</td>
                            <td class="text-center">{{$item['ouConnections']}}</td>
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
            <div class="box row-span-1 col-start-2 bg-white rounded-md px-4 py-3">
                <h2 class="w-full flex text-lg font-medium text-left  text-black mb-2">Socios Estrategicos SSEE</h2>
                <table class="w-full">
                    <thead>
                        <tr class="text-center text-xs uppercase text-gray-800">
                            <th>Distribución</th>
                            <th>Entregados</th>
                            <th>%</th>
                            <th>Activos</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs uppercase">
                        @foreach ($totalOU as $item)
                        @if ($item['ouLvl'] == 0 )
                        <tr>
                            <td>{{$item['ouName']}}</td>
                            <td class="text-center">{{$item['ouQuantity']}}</td>
                            <td class="text-center">{{$item['ouPercentage']}}</td>
                            <td class="text-center">{{$item['ouConnections']}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="box mt-6 bg-white rounded-md px-4 py-3">
                <h2 class="w-full flex text-lg font-medium text-left  text-black mb-2">Brigada COVID</h2>
                <table class="w-full">
                    <thead>
                        <tr class="text-center text-xs uppercase text-gray-800">
                            <th>Distribución</th>
                            <th>Entregados</th>
                            <th>%</th>
                            <th>Activos</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs uppercase">
                        @foreach ($totalOU as $item)
                        @if ($item['ouLvl'] == 4 )
                        <tr>
                            <td>{{$item['ouName']}}</td>
                            <td class="text-center">{{$item['ouQuantity']}}</td>
                            <td class="text-center">{{$item['ouPercentage']}}</td>
                            <td class="text-center">{{$item['ouConnections']}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>











    </div>






    <script>
        //var qxStatus = @json($qxStatus);
        const qxstatus = JSON.parse('{!! json_encode($qxStatus) !!}');
        //console.log(qxstatuses);

        var labels = qxstatus.map(qxstatus => qxstatus.description).flat();
        var quantities = qxstatus.map(qxstatus => qxstatus.count).flat();
        
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
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
                    borderWidth: 0,
                    datalabels:{
                        color: 'black'
                    }
                }]
            },
            options:{
                plugins:{
                    legend:{
                        display: false
                    }
                },
                scales:{
                    y: {
                        beginAtZero: true
                    }
                }
            },
            plugins: [ChartDataLabels],
                options: {
                    // ...
                }
        });

        



        const weekDays = JSON.parse('{!! json_encode($weekRecords) !!}');
        //console.log(qxstatuses);

        var labels2 = weekDays.map(weekDays => weekDays.date).flat();
        var totalConns = weekDays.map(weekDays => weekDays.connected).flat();
        var antaminaConns = weekDays.map(weekDays => weekDays.antamina).flat();
        var sseeConns = weekDays.map(weekDays => weekDays.ssee).flat();

        const colors = {
            purple: {
                default: "rgba(149, 76, 233, 1)",
                half: "rgba(149, 76, 233, 0.5)",
                quarter: "rgba(149, 76, 233, 0.25)",
                zero: "rgba(149, 76, 233, 0)"
            },
            indigo: {
                default: "rgba(80, 102, 120, 1)",
                quarter: "rgba(80, 102, 120, 0.25)"
            }
            };

        gradient = ctx.createLinearGradient(0, 25, 0, 300);
        gradient.addColorStop(0, colors.purple.half);
        gradient.addColorStop(0.35, colors.purple.quarter);
        gradient.addColorStop(1, colors.purple.zero);

        
        const data2 = {
        labels: labels2,
        datasets: [{
            label: 'Total',
            data: totalConns,


            fill: true,
            backgroundColor: gradient,
            pointBackgroundColor: colors.purple.default,
            borderColor: colors.purple.default,
            borderWidth: 2,
            pointRadius: 3,
            
            // Change options for ALL labels of THIS CHART
            datalabels:{
                color: 'black',
                anchor: 'end',
                align: 'top',
                offset: 7,
                font:{
                    size: 14,
                    weight: 'bold'
                }
            }
   
        },{
            label: 'Antamina',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: antaminaConns,
            datalabels:{
                display: false
            }
        },
        {
            label: 'SSEE',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: sseeConns,
            datalabels:{
                display: false
            }
        }]
        };


        var ctx2 = document.getElementById('weekConns').getContext('2d');
        var weekConnsChart = new Chart(ctx2, {
            type: 'line',
            data: data2,
            plugins: [ChartDataLabels],
                options: {
                    plugins:{
                        legend:{
                            display: false
                        },
                        datalabels:{
                            font:{
                                family: 'DM Sans'
                            }
                        }
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 800,
                        }
                    },
                }
        });
           
           /*var labelz = qxstatuses.cod;
        console.log(labelz);
        
        const car = {type:"Fiat", model:"500", color:"white"};
        document.write(car.type);*/
    </script>
</div>