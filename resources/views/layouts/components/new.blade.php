@foreach($new as $n)
<div class="col-md-3 col-sm-4 col-xs-6">
    <div class="product-item">
        <div class="pi-img-wrapper">
            <a href="#"><img src="{{$n['newImgPath']}}" class="img-responsive" alt="{{$n['newImgAlt']}}"></a>
        </div>
        <h3><a href="#">{{$n['newProductName']}}</a></h3>
        <div class="pi-price">{{$n['newPrice']}} RSD</div>
        <a href="javascript:;" class="btn btn-default add2cart">Dodaj u korpu</a>
    </div>
</div>
    @endforeach