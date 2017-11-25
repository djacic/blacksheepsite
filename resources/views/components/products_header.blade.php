@foreach($headers as $header)
<div class="title-wrapper">
    <div class="container"><div class="container-inner">
            <h1><span>{{$header['subsubcategorySelectedElement']}}</span> {{$header['subcategorySelectedElement']}}</h1>
            <em>Preko {{$header['productCount']}} proizvoda u ovoj kategoriji</em>
        </div></div>
</div>
    @endforeach