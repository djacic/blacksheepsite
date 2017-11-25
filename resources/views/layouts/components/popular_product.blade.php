@foreach($latestProducts as $latest)
    <div>
        <div class="product-item">
            <div class="pi-img-wrapper">
                <img src="{{ asset('assets/pages/img/products/' . $latest['picture']['file']) }}" class="img-responsive" alt="{{ $latest['picture']['alt'] }}">
                <div>
                    <a href="{{ asset('assets/pages/img/products/' . $latest['picture']['file']) }}" class="btn btn-default fancybox-button">Uvećaj</a>
                    <a href="#product-pop-up" onclick="getProductDetails({{ $latest['id'] }})" class="btn btn-default fancybox-fast-view">Pogledaj</a>
                </div>
            </div>
            <h3><a href="#">{{ $latest['name']}} </a></h3>
            <div class="pi-price">{{$latest['price']}} RSD</div>
            <form action="{{ url("/order/place") }}" method="post">
                <input type="hidden" name="id" value="{{ $latest['id'] }}">
                <input type="submit" name="order" class="btn btn-default add2cart" value="Dodaj u korpu">
            </form>
        </div>
    </div>
@endforeach

