<table class="table">
    <thead>
    <th>ID</th>
    <th>Datum</th>
    <th>Broj artikala</th>
    <th>Cena</th>
    <th>Status</th>
    </thead>
    <tbody>

@foreach($details as $detail)
    <tr>
            <td>{{$detail['id']}}</td>
            <td>{{$detail['date']}}</td>
            <td>{{$detail['quantity']}}</td>
            <td>{{$detail['price']}} RSD</td>
            <td>
            @switch($detail['status'])
                @case('delivered')
                <p style="color:green">Dostavljeno</p>
                @break
                @case('pending')
                <p style="color:orange">Nije potvrdjeno</p>
                @break
                @case('courier')
                <p style="color:blue">Kod kurira</p>
                @break
                @default
                @endswitch
            </td>
        </tr>

    @endforeach
    </tbody>
</table>