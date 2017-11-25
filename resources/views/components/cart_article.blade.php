@if(session('orderItems'))
    <table summary="Shopping cart">
        <tr>
            <th class="goods-page-image">Slika</th>
            <th class="goods-page-description">Opis</th>
            <th class="goods-page-quantity">Količina</th>
            <th class="goods-page-quantity">Boja</th>
            <th class="goods-page-price">Cena po komadu</th>
            <th class="goods-page-total" colspan="2">Ukupna</th>
        </tr>
        @foreach(session('orderItems') as $orderItem)
            <tr>
                <td class="goods-page-image">
                    <a href="javascript:;"><img src="{{ asset("/assets/pages/img/products/" . $orderItem['item']->picture->file)}}"  alt="{{ $orderItem['item']->picture->alt }}"></a>
                </td>
                <td class="goods-page-description">
                    <h3><a href="javascript:;">{{ $orderItem['item']->name }}</a></h3>
                    <em>{{ $orderItem['item']->description }}</em>
                </td>
                <td class="goods-page-quantity">
                    <div class="product-quantity">
                        <input id="{{ $orderItem['item']->id }}" type="text" onchange="refreshQuantity(this)" value="{{ $orderItem['amount'] }}" readonly class="form-control input-sm">
                    </div>
                </td>
                <td class="goods-page-price">
                    @if(isset($orderItem['color_id']))
                       @if($orderItem['color_id'] != "0")
                            <div style="border:1px solid #000; width:20px; height: 20px; background-color:{{ $orderItem['color_id'] }}; margin-top:8px;"></div>
                       @else
                           <strong>{{ "Nema" }}</strong>
                       @endif
                    @else
                        <strong>{{ "Nema" }}</strong>
                    @endif
                </td>
                <td class="goods-page-price">
                    <strong>{{ $orderItem['item']->prices[0]->price }}<span>RSD</span></strong>
                </td>
                <td class="goods-page-total">
                    <strong>{{ $orderItem['item']->prices[0]->price * $orderItem['amount'] }}<span>RSD</span></strong>
                </td>
                <td class="del-goods-col">
                    <a class="del-goods" href="{{ url("/order/delete/" . $orderItem['item']->id) }}">&nbsp;</a>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    </div>

@else
    <p class="lead">Vasa korpa je prazna.</p>
@endif

<script>
    function refreshQuantity(element) {
        var url = window.location.href.split("?")[0] + "?refresh=1&item=" + element.id + "&qnt=" + element.value;
        window.location.href = url;
    }
</script>
