@extends('layouts.app')
@section('slider')
@component("components.main_slider") @endcomponent
@endsection
@section('content')
    <div class="main">
        <div class="container">
            <div class="row margin-bottom-40">
                <div class="col-md-12 sale-product">
                    <h2>Najnoviji proizvodi</h2>
                    <!-- <div class="owl-carousel owl-carousel5"> -->
                        @foreach($data['products'] as $product)
                                @component('components.product', ["product" => $product, "col" => "col-md-3"])@endcomponent
                        @endforeach
                    <!-- </div> -->
                </div>
            </div>
            <div class="row margin-bottom-40 ">
            @component('components.sidebar')@endcomponent
            <div class="row margin-bottom-35 ">
                <div class="col-md-6 two-items-bottom-items">
                    <div class="owl-carousel owl-carousel2">
                        {{--@component('components.product',$data['latestProducts'])@endcomponent--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @stop
