@extends('layouts.app')
@section('content')
<div class="main">
    <div class="container">
        <div class="row margin-bottom-40">
            <div class="col-md-12 col-sm-12">
                <h2>Proizvodi na akciji</h2>
                @foreach($data['products'] as $product)
                    <div class="col-md-2">
                        @component('components.product', ["product" => $product, "col" => "null"])@endcomponent
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection