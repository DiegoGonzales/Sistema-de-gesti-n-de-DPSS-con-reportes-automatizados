@foreach ($allOU as $ou)
    @foreach ($totalOU as $item)
        @if ($item['ouMasterID'] == $ou->id)
            <td >{{$item['ouName']}}</td>
            <td class="text-center">{{$item['ouQuantity']}}</td>
            <td class="text-center">0.00</td>
            <td class="text-center"></td>
            <td class="text-center"></td>
        @endif
    @endforeach
@endforeach