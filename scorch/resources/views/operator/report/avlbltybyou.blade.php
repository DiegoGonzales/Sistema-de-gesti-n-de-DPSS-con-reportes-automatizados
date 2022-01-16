<x-app-layout>
    <div class="container my-2 w-full flex flex-row justify-center items-center">
        <button class="
        bg-transparent hover:bg-black 
        font-bold text-xs uppercase text-center tracking-widest text-gray-600 hover:text-white
        py-3 px-12 border border-gray-600 hover:border hover:border-black  rounded 
        transition " onclick="printDiv('printableArea')">
        <div class="float-left mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
              </svg>
        </div>
       
        Exportar a PDF
        </button>
    </div>

    <div class="container flex-inline bg-white" id="printableArea">
            
        <div id="weekContainer" class="item pt-5">
            <h2 class="text-lg font-medium">Resumen de Disponibilidad</h2>
            <p class="text-sm">A continuación se mostraran la disponbilidad de activo y entregados correspondientes por semana</p>
            @foreach ($weekDays->groupBy('weekNum') as $week)
            <div id="week" class="mt-4 mb-6 text-xs">
                <h2 class="text-lg font-medium">Semana {{($week[0]->weekNum)}}</h2>
                <br>
                <div class="flex">

                    <div class="item w-72 truncate text-gray-400">
                        <div class="text-transparent text-sm font-semibold">Fecha</div>
                        <div class="text-transparent font-semibold">Fecha</div>
                        <div class="border-t py-1">{{$parentOU->name}}</div>
                        @foreach ($ouChilds as $childLvl2)
                        @if ($parentOU->id == $childLvl2['ouMasterOU'])
                        <div class="border-t py-1 pl-2">{{$childLvl2['ouName']}}</div>
                        @foreach ($ouChilds as $childLvl3)
                        @if ($childLvl2['ouID'] == $childLvl3['ouMasterOU'])
                        <div class="border-t py-1 pl-5">{{$childLvl3['ouName']}}</div>
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                    </div>
                    @foreach ($week as $day)
                    <div class="item w-44 text-gray-400 ">
                        <div id="dayDate" class="text-center text-sm font-semibold text-black">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                            $day->date)->format('d/m/Y')}}</div>
                        <div class="border-b text-center tracking-wide" style="font-size: 0.7rem">ACTIVOS / ENTREGADOS</div>
                        @foreach ($weekRecs as $rec)
                        @if ($rec->date == $day->date)
                        @php
                            $currentDate = $day->date;
                        @endphp
                            @if ($rec->ouId == $parentOU->id )
                        <div class="border-b h-34 py-1 text-center"><span id="parentOUConns">{{$rec->connected}}</span> / <span id="parentOUQuantity">{{$rec->quantity}}</span></div>
                                @foreach ($weekRecs as $recLvl2)
                                    @if ($recLvl2->ouMaster == $rec->ouId && $recLvl2->date == $currentDate)
                        <div class="border-b h-34 py-1 text-center">{{$recLvl2->connected}} / {{$recLvl2->quantity}}</div>
                                        @foreach ($weekRecs as $recLvl3)
                                            @if ($recLvl3->ouMaster == $recLvl2->ouId && $recLvl3->date == $currentDate)
                        <div class="border-b h-34 py-1 text-center">{{$recLvl3->connected}}  / {{$recLvl3->quantity}}</div>                        
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endif
                        @endforeach
                    
                    </div>
                    @endforeach


                </div>
                <br>
                <div id="wChart" class="w-1/2"></div>
            </div>
            @endforeach
        </div>







    </div>


</x-app-layout>
<script>
    var weeks = document.querySelectorAll("#week");
    var i = 0;
    const dayConnections = [];
    weeks.forEach(w => {
        /*Nombrando*/
        i++;
        w.setAttribute("id", "week"+i);
        
        //Conexiones del dia
        
        const dConns = w.querySelectorAll("#parentOUConns");
        const dQuantity = w.querySelectorAll("#parentOUQuantity");
        const dDate = w.querySelectorAll("#dayDate");

        const arr1 = [];
        dConns.forEach(dayConns => {
            arr1.push(dayConns.innerText);
        });
        const arr3 = [];
        dQuantity.forEach(dayQuantity => {
            arr3.push(dayQuantity.innerText);
        });
        const arr2 = [];
        dDate.forEach(dayDate => {
            arr2.push(dayDate.innerText);
        });
        
        var weekAvailabity = arr1.map(function(c,q){
            return (Math.round (c * 100) / arr3[q]).toFixed(2);
        });
        /*console.log(weekAvailabity);*/
        /*console.log(arr1);*/
        
        
        

        /*Create chart element*/
        var chartID = "weekChart"+i;
        var canvas = document.createElement("canvas");
        canvas.setAttribute("id", chartID);
        canvas.setAttribute("class", "w-auto max-h-full");
        canvas.style.height = "300px";
        w.querySelector("#wChart").appendChild(canvas);
        
        /*Chart*/
        var ctx = document.getElementById(chartID);
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: arr2,
                datasets: [{
                    label: '# de conexiones',
                    data: weekAvailabity,
                    backgroundColor: 'rgb(104, 117, 245)',
                    borderColor: 'rgb(104, 117, 245)',
                }]
            },
            plugins: [ChartDataLabels],
                options: {
                    plugins:{
                        legend:{
                            display: false
                        },
                        datalabels:{
                            color: 'black',
                            anchor: 'end',
                            align: 'top',
                            offset: 7,
                            
                            font:{
                                family: 'DM Sans',
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        y: {
                            max: 100,
                            min: 0
                        }
                    },
            }
        });
        /*Chart*/
    });
    /*End foreach*/


    function printDiv(divName) {


window.print();


}
    
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #printableArea,
        #printableArea * {
            visibility: visible;
        }

        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>