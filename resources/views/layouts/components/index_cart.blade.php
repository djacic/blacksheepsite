
<div class="top-cart-info">
    <?php
        $total = 0;
        if (Session::has("orderItems")) {
            foreach(Session::get("orderItems") as $item) {
                $total += $item['item']->prices[0]->price * $item['amount'];
            }
        }
    ?>
    <a href="{{ url("/cart") }}" class="top-cart-info-count">Korpa ( {{ count(Session::get("orderItems")) }} )</a>
    <a href="{{ url("/cart") }}" class="top-cart-info-value">{{ $total }} RSD</a>
</div>
<i class="fa fa-shopping-cart"></i>
<div class="top-cart-content-wrapper">
    <div class="top-cart-content">
        <ul class="scroller" style="height: 100%">
            @if(Session::get("orderItems"))
                @foreach(Session::get("orderItems") as $pr)
                    <li>
                        <a href=""><img src="{{ asset("assets/pages/img/products/" . $pr['item']->picture->file) }}" alt="{{ $pr['item']->picture->alt }}" width="37" height="34"></a>
                        <span class="cart-content-count">x {{ $pr['amount'] }}</span>
                        <strong><a href="{{ url("/cart") }}">{{ $pr['item']->name }}</a></strong>
                        <em>{{ $pr['item']->prices[0]->price * $pr['amount'] }} RSD</em>
                        <a href="{{ url("/order/delete/" . $pr['item']->id ) }}" class="del-goods">&nbsp;</a>
                    </li>
                @endforeach
                <div class="text-right">
                    <a href="{{ url("/cart") }}" class="btn btn-default">Otvori korpu</a>
                    <a href="{{ url("/checkout") }}" class="btn btn-primary">Završi kupovinu</a>
                </div>
            @else
                <p class="text-center">Korpa je prazna.</p>
            @endif
        </ul>


    </div>
</div>
