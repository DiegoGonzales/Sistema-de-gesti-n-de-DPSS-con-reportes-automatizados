<div>

    <h2>Detalle de dispositivos por OU</h2>

    <h2>SSEE</h2>
    <table class="">
        <thead>
            <tr class="text-center">
                <th>Unidad Organizativa</th>
                <th>Entregados</th>
                <th>Baja por Perdida</th>
                <th>Baja por daño</th>
                <th>Salida a garantía</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($allOU as $ou)
            <tr>
                
                    @if ($ou->level == 0)
                    <td>{{$ou->name}}</td>
                        @foreach ($quantity as $q)
                            @if ($ou->id == $q->ouID)
                            <td>{{$q->ouENT}}</td>
                            <td>{{$q->ouBPR}}</td>
                            <td>{{$q->ouBDP}}</td>
                            <td>{{$q->ouSAG}}</td>
                            @endif
                        @endforeach
                    @endif
                
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Antamina</h2>
    <table class="">
        <thead>
            <tr class="text-center">
                <th>Unidad Organizativa</th>
                <th>Entregados</th>
                <th>Baja por Perdida</th>
                <th>Baja por daño</th>
                <th>Salida a garantía</th>
            </tr> 
        </thead>
        <tbody>
            
                
            
                @foreach ($allOU as $ou)
                    @if($ou->level == 1)
                    <tr>
                        <td>{{$ou->name}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                        @foreach ($ou->child as $child2)
                        <tr>
                            <td class="pl-4">{{$child2->name}}</td>
                            @foreach ($quantity as $q)
                                    @if ($child2->id == $q->ouID)
                                    <td>{{$q->ouENT}}</td>
                                    <td>{{$q->ouBPR}}</td>
                                    <td>{{$q->ouBDP}}</td>
                                    <td>{{$q->ouSAG}}</td>
                                    @endif
                            @endforeach
                            
                        </tr>
                            @foreach ($child2->child as $child3)
                            <tr>
                                    <td class="pl-7">{{$child3->name}}</td>
                                @foreach ($quantity as $q)
                                    @if ($child3->id == $q->ouID)
                                    <td>{{$q->ouENT}}</td>
                                    <td>{{$q->ouBPR}}</td>
                                    <td>{{$q->ouBDP}}</td>
                                    <td>{{$q->ouSAG}}</td>
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