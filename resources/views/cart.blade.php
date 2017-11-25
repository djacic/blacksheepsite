@extends('layouts.app')
@section('content')
<div class="main">
    <div class="container">
        <div class="row margin-bottom-40">
            <div class="col-md-12 col-sm-12">
                <h1>Vaša korpa</h1>
                <div class="goods-page">
                    <div class="goods-data clearfix">
                        <div class="table-wrapper-responsive">
                             @component('components.cart_article')@endcomponent
                            <a class="btn btn-default" href="{{ url("/products") }}">Nastavite kupovinu <i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-primary" href="{{ url("/checkout") }}">Završite kupovinu <i class="fa fa-check"></i></a>
                        </div>
                    </div>
                </div>
            <div class="row margin-bottom-40">
        </div>
     </div>
    </div>
    </div>
</div>
@endsection